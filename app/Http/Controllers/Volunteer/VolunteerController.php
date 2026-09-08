<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Volunteer;
use App\Models\VolunteerTask;
use App\Models\Resident;

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
                    // Pending tasks hamesha dikhein, lekin Completed tasks sirf pichlay 24 ghante tak dikhein
                    $q->where('status', 'Pending')
                        ->orWhere(function ($subQ) {
                            $subQ->where('status', 'Completed')
                                ->where('updated_at', '>=', now()->subHours(24));
                        });
                })
                ->get();
        }

        // 4. Residents jinko attention chahiye
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

        // 2. Status update kar ke save karein (updated_at time bhi automatically update ho jayega)
        $task->status = 'Completed';
        $task->save();

        // 3. Agar task ke sath volunteer_id attached hai, tabhi stats update honge
        if ($task->volunteer_id) {
            $volunteer = Volunteer::where('id', $task->volunteer_id)->first();
            if ($volunteer) {
                $volunteer->increment('tasks_completed');
                $volunteer->increment('hours_this_month', 1);
                $volunteer->increment('sessions_attended', 1);
                $volunteer->increment('residents_helped', 1);
            }
        } else {
            // Agar Common Task tha, toh current logged-in volunteer ke stats barha sakte hain
            $userId = Auth::id();
            $volunteer = Volunteer::where('user_id', $userId)->first();
            if ($volunteer) {
                $volunteer->increment('tasks_completed');
                $volunteer->increment('hours_this_month', 1);
            }
        }

        return back()->with('success', 'Task marked as completed successfully and stats updated!');
    }
}
