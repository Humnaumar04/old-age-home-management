<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HelpRequest;
use Illuminate\Support\Facades\Auth;

class HelpRequestController extends Controller
{
    // Naya method: Resident ki apni requests show karne ke liye
    public function myRequests()
    {
        // Sirf login user ki requests fetch karein
        $myRequests = HelpRequest::where('user_id', Auth::id())->latest()->get();

        return view('resident.my-requests', compact('myRequests'));
    }

    public function store(Request $request)
    {
        // 1. Validation
        $request->validate([
            'help_type' => 'required',
            'description' => 'required',
        ]);

        // 2. Database mein data save karna
        HelpRequest::create([
            'user_id' => Auth::id(),
            'help_type' => $request->help_type,
            'description' => $request->description,
            'status' => 'Pending',
        ]);

        // 3. Success message
        return back()->with('success', 'Your help request has been sent successfully!');
    }
}
