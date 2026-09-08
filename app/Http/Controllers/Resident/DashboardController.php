<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Resident;
use App\Models\DailyActivity;

class DashboardController extends Controller
{
    public function index()
    {
        // Login user ka resident profile dhundein
        $resident = Resident::where('user_id', Auth::id())->first();

        // Agar resident profile nahi mili toh handle karein
        if (!$resident) {
            return redirect()->back()->with('error', 'Profile not found.');
        }

        // Aaj ki date ki activities fetch karein
        $activities = DailyActivity::where('resident_id', $resident->id)
            ->latest('id')
            ->first();
        // --- Yahan resident ke liye bhi latest health vitals fetch kar liye hain ---
        $latestVitals = DB::table('health_logs')
            ->where('resident_id', $resident->id)
            ->latest('created_at')
            ->first();

        return view('resident.dashboard', compact('resident', 'activities', 'latestVitals'));
    }
}
