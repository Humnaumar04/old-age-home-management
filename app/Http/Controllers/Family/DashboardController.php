<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Resident;
use App\Models\DailyActivity;

class DashboardController extends Controller
{
    public function index()
    {
        $familyUserId = Auth::id();

        // Resident dhoondein jo is family user se linked hai
        $resident = Resident::where('family_user_id', $familyUserId)->first();

        if (!$resident) {
            return "No resident linked with this family account yet. Please contact admin.";
        }

        // Aaj ki date ki activities fetch karein
        $activities = DailyActivity::where('resident_id', $resident->id)
            ->latest('id')
            ->first();

        // --- Yahan humne latest health vitals fetch kar liye hain ---
        $latestVitals = DB::table('health_logs')
            ->where('resident_id', $resident->id)
            ->latest('created_at')
            ->first();

        return view('family.dashboard', compact('resident', 'activities', 'latestVitals'));
    }
}
