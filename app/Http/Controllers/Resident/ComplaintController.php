<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint; // Model ko import karna zaroori hai
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function create()
    {
        return view('resident.submit-complaint'); // Form dikhane ke liye
    }

    public function store(Request $request)
    {
        // 1. Data Validate karna
        $request->validate([
            'category' => 'required',
            'subject' => 'required',
            'description' => 'required',
        ]);

        // 2. Database mein save karna
        Complaint::create([
            'user_id' => Auth::id(), // Login user ki ID
            'category' => $request->category,
            'subject' => $request->subject,
            'description' => $request->description,
            'resolution' => $request->resolution,
            'urgency' => $request->urgency,
        ]);

        // 3. Wapis redirect karna success message ke sath
        return back()->with('success', 'Your complaint has been submitted successfully!');
    }
    public function index()
    {
        // Sirf login kiye huye resident ki complaints nikalna
        $complaints = Complaint::where('user_id', Auth::id())->latest()->get();

        return view('resident.my-complaints', compact('complaints'));
    }
}
