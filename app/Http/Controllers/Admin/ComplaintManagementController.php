<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\HelpRequest;
use Illuminate\Http\Request;

class ComplaintManagementController extends Controller
{
    public function index()
    {
        // 1. Sirf 'Pending' complaints dikhayein
        $complaints = Complaint::where('status', '!=', 'Resolved')->latest()->get();

        // 2. Sirf 'Pending' requests dikhayein
        $helpRequests = HelpRequest::where('status', 'Pending')->latest()->get();

        // 3. Stats ko bhi sirf pending records ke mutabiq count karein
        $totalComplaints = Complaint::where('status', '!=', 'Resolved')->count();
        $highUrgency = Complaint::where('status', '!=', 'Resolved')
            ->where('urgency', 'High')->count();

        $totalRequests = HelpRequest::where('status', 'Pending')->count();
        $urgentRequests = HelpRequest::where('status', 'Pending')
            ->where('help_type', 'Emergency')->count();

        return view('admin.manage-complaints', compact(
            'complaints',
            'helpRequests',
            'totalComplaints',
            'highUrgency',
            'totalRequests',
            'urgentRequests'
        ));
    }

    public function show($id)
    {
        $complaint = Complaint::with('user')->findOrFail($id);
        return response()->json($complaint);
    }

    public function resolve($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->status = 'Resolved'; // Database mein update
        $complaint->save();

        return response()->json(['message' => 'Complaint Resolved Successfully!']);
    }

    public function updateRequest(Request $request, $id)
    {
        $helpRequest = HelpRequest::findOrFail($id);
        $helpRequest->status = $request->status; // Approved ya Rejected
        $helpRequest->save();

        return back()->with('message', 'Request status updated!');
    }
}
