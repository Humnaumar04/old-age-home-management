<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Resident;
use App\Models\Staff;
use App\Models\Volunteer;

class AuthController extends Controller
{
    // 1. Login Screen dikhane ke liye
    public function showLogin()
    {
        $residentsCount = Resident::count();
        $staffCount = Staff::count();
        $volunteersCount = Volunteer::count();

        return view('auth.login', compact('residentsCount', 'staffCount', 'volunteersCount'));
    }

    // 2. Login Logic
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:staff,resident,donor,family,volunteer'
        ]);

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {

            $user = Auth::user();

            if (strtolower($user->role) !== strtolower($request->role)) {
                Auth::logout();
                return back()->withErrors(['email' => 'Selected role does not match our records.'])->withInput($request->only('role'));
            }

            if (strtolower($user->status) !== 'approved') {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account is still pending Admin approval.'])->withInput($request->only('role'));
            }

            $request->session()->regenerate();

            $userRole = strtolower($user->role);

            switch ($userRole) {
                case 'staff':
                    return redirect()->route('staff.dashboard');
                case 'resident':
                    return redirect()->route('resident.dashboard');
                case 'donor':
                    return redirect()->route('donor.dashboard');
                case 'family':
                    return redirect()->route('family.dashboard');
                case 'volunteer':
                    return redirect()->route('volunteer.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('role'));
    }

    // 3. Logout Logic
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }

    // 4. Register Screen dikhane ke liye
    public function showRegister()
    {
        return view('auth.register');
    }

    // 5. Register Logic (FIXED)
    public function registerSubmit(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'type' => 'required|string|in:Donor,Family,Volunteer',
            // VALIDATION FIX: Agar Family select hoga toh relative_name residents table me 'name' column me exist karna lazmi hai
            'relative_name' => [
                'nullable',
                'required_if:type,Family',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->type === 'Family') {
                        $exists = Resident::where('name', $value)->exists();
                        if (!$exists) {
                            $fail('The provided resident name was not found in our records.');
                        }
                    }
                },
            ],
        ], [
            'relative_name.required_if' => 'Please enter the resident name who is your relative.',
        ]);

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cnic' => $request->cnic,
            'address' => $request->address,
            'relative_name' => $request->relative_name,
            'password' => Hash::make($request->password),
            'role' => strtolower($request->type),
            'status' => 'pending', // Account status pending rahega jab tak Admin approve na kare
        ]);

        if (strtolower($request->type) === 'volunteer') {
            Volunteer::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'hours_this_month' => 0,
                'sessions_attended' => 0,
                'tasks_completed' => 0,
                'residents_helped' => 0,
            ]);
        }

        return redirect()->back()->with('success', 'Your registration request has been submitted! Waiting for Admin approval.');
    }
}
