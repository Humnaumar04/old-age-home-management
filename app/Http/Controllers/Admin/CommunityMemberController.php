<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Donation;
use App\Models\Resident;
use App\Models\Volunteer;

class CommunityMemberController extends Controller
{
    public function index()
    {
        $donors = User::where('role', 'donor')
            ->where('status', 'approved')
            ->orderBy('name')
            ->get()
            ->map(function ($donor) {
                $donations = Donation::where('user_id', $donor->id)->get();
                $donor->donation_count = $donations->count();
                $donor->donation_types = $donations->pluck('donation_type')->filter()->unique()->implode(', ') ?: 'N/A';
                return $donor;
            });

        $family = User::where('role', 'family')
            ->where('status', 'approved')
            ->orderBy('name')
            ->get()
            ->map(function ($member) {
                $resident = Resident::where('family_user_id', $member->id)->first();
                $member->linked_resident = $resident
                    ? $resident->name . ' (Room ' . $resident->room_number . ')'
                    : 'Not linked yet';
                return $member;
            });

        $volunteers = User::where('role', 'volunteer')
            ->where('status', 'approved')
            ->orderBy('name')
            ->get()
            ->map(function ($user) {
                $volunteer = Volunteer::where('user_id', $user->id)->first();
                $user->tasks_completed = $volunteer->tasks_completed ?? 0;
                $user->hours_this_month = $volunteer->hours_this_month ?? 0;
                return $user;
            });

        return view('admin.community-members', compact('donors', 'family', 'volunteers'));
    }

    // Reset-password form for a donor, family, or volunteer account
    public function showResetPassword($id)
    {
        $user = User::findOrFail($id);
        return view('admin.reset-password', compact('user'));
    }

    // Actually update the password
    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'password' => $request->password, // 'password' cast as 'hashed' on User model, so this is hashed automatically
        ]);

        return redirect()->route('admin.community_members')
            ->with('success', 'Password reset successfully for ' . $user->name . '.');
    }
}
