<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resident;

class EmergencyController extends Controller
{
    public function index()
    {
        // Yeh Staff ke liye hai
        $residents = \App\Models\Resident::all();
        return view('staff.report-emergency', compact('residents'));
    }

    public function showReports()
    {
        // Yeh Admin ke liye hai
        $reports = \App\Models\EmergencyReport::latest()->get();
        return view('admin.emergency_reports', compact('reports'));
    }


    // 2. Aap ka purana function: Data save karne ke liye
    public function store(Request $request)
    {
        $request->validate([
            'resident_id' => 'required',
            'emergency_type' => 'required',
            'severity_level' => 'required',
            'incident_time' => 'required',
            'description' => 'required',
        ]);

        \App\Models\EmergencyReport::create([
            'resident_id'    => $request->resident_id,
            'staff_id'       => Auth::id(),
            'emergency_type' => $request->emergency_type,
            'severity_level' => $request->severity_level,
            'incident_time'  => $request->incident_time,
            'description'    => $request->description,
            'action_taken'   => $request->action_taken,
            'other_staff_present' => $request->other_staff_present,
        ]);

        return redirect()->back()->with('success', 'Emergency reported successfully. Admin has been notified!');
    }
    public function getRoom($id)
    {
        // Resident ko dhoondna database mein
        $resident = \App\Models\Resident::find($id);

        if ($resident) {
            // Agar resident mil jaye to uska room number JSON format mein wapas bhejna
            return response()->json(['room_number' => $resident->room_number]);
        }

        return response()->json(['room_number' => 'N/A']);
    }
}
