<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Models\VolunteerTask;

class VolunteerManagementController extends Controller
{
    public function index()
    {
        // Relationship ke sath volunteers fetch karna
        $volunteers = Volunteer::with('user')->get();

        return view('admin.volunteer-management', compact('volunteers'));
    }

    public function assignTask(Request $request)
    {
        $request->validate([
            'volunteer_id' => 'nullable|exists:volunteers,id',
            'title' => 'required|string|max:255',
            'time_slot' => 'required|string',
            'date' => 'required|date',
        ]);

        // Agar volunteer_id khali hai (yani "All Volunteers" select kiya gaya hai)
        if (empty($request->volunteer_id)) {
            $volunteers = Volunteer::all();

            if ($volunteers->isEmpty()) {
                return back()->with('error', 'No volunteers found.');
            }

            // Har volunteer ko task assign karein aur sath mein common mark kar dein
            foreach ($volunteers as $volunteer) {
                VolunteerTask::create([
                    'volunteer_id' => $volunteer->id,
                    'title' => $request->title . ' (Common)', // Yahan pata chal jaye ga ke yeh common task hai
                    'time_slot' => $request->time_slot,
                    'date' => $request->date,
                    'status' => 'Pending',
                ]);
            }
        } else {
            // Agar koi aik specific volunteer select kiya gaya hai
            VolunteerTask::create([
                'volunteer_id' => $request->volunteer_id,
                'title' => $request->title,
                'time_slot' => $request->time_slot,
                'date' => $request->date,
                'status' => 'Pending',
            ]);
        }

        return back()->with('success', 'Task successfully added to the schedule!');
    }
}
