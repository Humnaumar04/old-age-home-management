<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Login user ka resident profile dhundein
        $resident = \App\Models\Resident::where('user_id', \Illuminate\Support\Facades\Auth::id())->first();

        // Agar resident profile nahi mili toh handle karein
        if (!$resident) {
            return redirect()->back()->with('error', 'Profile not found.');
        }

        // Aaj ki date ki activities fetch karein
        $activities = \App\Models\DailyActivity::where('resident_id', $resident->id)
            ->where('date', date('Y-m-d')) // Aaj ki date
            ->first();
        // Agar resident record nahi mila, toh user ko batayein ya redirect karein
        if (!$resident) {
            return "Resident profile not found for this account. Please contact admin.";
        }

        return view('resident.dashboard', compact('resident', 'activities'));
    }
}
