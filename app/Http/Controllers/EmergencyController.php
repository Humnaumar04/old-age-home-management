<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resident;
use App\Models\EmergencyReport;

class EmergencyController extends Controller
{
    public function index()
    {
        // Yeh Staff ke liye hai
        $residents = Resident::all();
        return view('staff.report-emergency', compact('residents'));
    }

    public function showReports()
    {
        // Pending reports saari dikhayega + Resolved reports sirf last 30 days ki dikhayega
        $reports = EmergencyReport::where('status', 'Pending')
            ->orWhere(function ($query) {
                $query->where('status', 'Resolved')
                    ->where('created_at', '>=', now()->subDays(30));
            })
            ->orderByRaw("FIELD(status, 'Pending', 'Resolved')")
            ->latest()
            ->get();

        return view('admin.emergency_reports', compact('reports'));
    }

    // Data save karne ke liye
    public function store(Request $request)
    {
        $request->validate([
            'resident_id'    => 'required',
            'emergency_type' => 'required',
            'severity_level' => 'required',
            'incident_time'  => 'required',
            'description'    => 'required',
        ]);

        EmergencyReport::create([
            'resident_id'         => $request->resident_id,
            'staff_id'            => Auth::id(),
            'emergency_type'      => $request->emergency_type,
            'severity_level'      => $request->severity_level,
            'incident_time'       => $request->incident_time,
            'description'         => $request->description,
            'action_taken'        => $request->action_taken,
            'other_staff_present' => $request->other_staff_present,
            'status'              => 'Pending', // New emergency status will default to Pending
        ]);

        return redirect()->back()->with('success', 'Emergency reported successfully. Admin has been notified!');
    }

    // Emergency ko Resolve mark karne ke liye (Naya Function)
    public function resolve($id)
    {
        $report = EmergencyReport::findOrFail($id);
        $report->status = 'Resolved';
        $report->save();

        return redirect()->back()->with('success', 'Emergency marked as resolved successfully!');
    }

    public function getRoom($id)
    {
        // Resident ko dhoondna database mein
        $resident = Resident::find($id);

        if ($resident) {
            // Agar resident mil jaye to uska room number JSON format mein wapas bhejna
            return response()->json(['room_number' => $resident->room_number]);
        }

        return response()->json(['room_number' => 'N/A']);
    }
}
