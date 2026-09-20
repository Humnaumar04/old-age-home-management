<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Volunteer;
use App\Models\VolunteerTask;
use App\Models\Resident;
use Carbon\Carbon;

class VolunteerController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();
        $authUser = Auth::user();
        $userName = $authUser->name ?? 'Volunteer';

        // 1. Current logged-in volunteer fetch karna
        $volunteer = Volunteer::where('user_id', $userId)->first() ?? (object)[
            'id' => 0,
            'name' => $userName,
            'hours_this_month' => 24,
            'sessions_attended' => 12,
            'tasks_completed' => 18,
            'residents_helped' => 31
        ];

        if (isset($volunteer->name) && $authUser && empty($volunteer->name)) {
            $volunteer->name = $authUser->name;
        }

        // 2. Common tasks aur is volunteer ke personal tasks fetch karna (24 hours hide logic ke sath)
        $tasks = collect();
        if ($volunteer && isset($volunteer->id)) {
            $volunteerId = $volunteer->id > 0 ? $volunteer->id : null;

            $tasks = VolunteerTask::where(function ($query) use ($volunteerId) {
                $query->whereNull('volunteer_id'); // Sab ke liye common tasks
                if ($volunteerId) {
                    $query->orWhere('volunteer_id', $volunteerId); // Is volunteer ke apne personal tasks
                }
            })
                ->where(function ($q) {
                    // Pending/Expired tasks base date se fetch karein, aur Completed tasks 24 ghante tak dikhein
                    $q->where('status', 'Pending')
                        ->orWhere(function ($subQ) {
                            $subQ->where('status', 'Completed')
                                ->where('updated_at', '>=', now()->subHours(24));
                        });
                })
                ->get();
        }

        // 3. Residents jinko attention chahiye
        $attentionResidents = Resident::whereIn('medical_condition', ['Critical', 'Recovering'])->get();

        return view('volunteer.dashboard', compact('volunteer', 'tasks', 'attentionResidents'));
    }

    public function completeTask($id)
    {
        // Agar dummy task ho (id == 0) toh seedha back bhej dein
        if ($id == 0) {
            return back()->with('success', 'Task marked as completed!');
        }

        // 1. Task ko dhoondhein
        $task = VolunteerTask::findOrFail($id);

        // Security check: yeh task ya to "common" honi chahiye (volunteer_id null)
        // ya phir isi logged-in volunteer ko assign honi chahiye — warna koi bhi
        // authenticated volunteer sirf URL mein ID badal kar kisi doosre volunteer
        // ki task complete kar sakta tha aur uske stats bhi galat badha sakta tha.
        $currentVolunteer = Volunteer::where('user_id', Auth::id())->first();

        if ($task->volunteer_id !== null && (!$currentVolunteer || $task->volunteer_id != $currentVolunteer->id)) {
            abort(403, 'You are not authorized to complete this task.');
        }

        if ($task->status !== 'Completed') {
            // 2. Status update kar ke save karein
            $task->status = 'Completed';
            $task->save();

            // 3. Dynamic Task Duration (Hours) Calculation Logic
            $hoursToAdd = 1; // Default fallback

            if (!empty($task->time_slot)) {
                // Check karein agar time_slot string mein range di hui hai (e.g., "12:00 PM - 2:00 PM")
                if (str_contains($task->time_slot, '-')) {
                    $parts = explode('-', $task->time_slot);
                    $startTimeStr = trim($parts[0]);
                    $endTimeStr = trim(end($parts));

                    try {
                        $start = Carbon::parse($startTimeStr);
                        $end = Carbon::parse($endTimeStr);

                        // Midnight crossover handling
                        if ($end->lt($start)) {
                            $end->addDay();
                        }

                        $diffInMinutes = $start->diffInMinutes($end);
                        $calculatedHours = round($diffInMinutes / 60, 2);

                        if ($calculatedHours > 0) {
                            $hoursToAdd = $calculatedHours;
                        }
                    } catch (\Exception $e) {
                        $hoursToAdd = 1;
                    }
                }
            } elseif (isset($task->start_time) && isset($task->end_time)) {
                try {
                    $start = Carbon::parse($task->start_time);
                    $end = Carbon::parse($task->end_time);
                    if ($end->lt($start)) {
                        $end->addDay();
                    }
                    $hoursToAdd = round($start->diffInMinutes($end) / 60, 2);
                } catch (\Exception $e) {
                    $hoursToAdd = 1;
                }
            }

            // 4. Relevant Volunteer record fetch kar ke accurate values increment karein
            $volunteer = null;
            if ($task->volunteer_id) {
                $volunteer = Volunteer::where('id', $task->volunteer_id)->first();
            } else {
                $volunteer = Volunteer::where('user_id', Auth::id())->first();
            }

            if ($volunteer) {
                $volunteer->increment('tasks_completed');
                $volunteer->increment('hours_this_month', $hoursToAdd);
                $volunteer->increment('sessions_attended');
                $volunteer->increment('residents_helped');
            }
        }

        return back()->with('success', 'Task marked as completed successfully and stats updated!');
    }
}
