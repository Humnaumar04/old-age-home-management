<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. Login Screen dikhane ke liye
    public function showLogin()
    {
        return view('auth.login'); // auth/login.blade.php file khulegi
    }

    // 2. Login Logic (Asal Kaam)
    public function login(Request $request)
    {
        // Inputs ko validate karna ke email aur password khali na hon
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required' // Figma screen se jo role select hoga
        ]);

        // Check karna ke kya email aur password database se match hote hain
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {

            $user = Auth::user();

            // Ek extra check: Case-insensitive check taake 'Staff' aur 'staff' ka rola na ho
            if (strtolower($user->role) !== strtolower($request->role)) {
                Auth::logout();
                return back()->withErrors(['email' => 'Selected role does not match our records.']);
            }

            $request->session()->regenerate();

            // Role ko lowercase karlein taake switch case match ho jaye
            $userRole = strtolower($user->role);

            // --- ROLE BASED REDIRECTION (Asal Logic Fixed) ---
            switch ($userRole) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
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

        // Agar password ya email galat ho
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
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
        return view('auth.register'); // auth/register.blade.php file khulegi
    }

    // 5. Register Logic (Naya User Database mein Save karne ke liye)
    public function registerSubmit(Request $request)
    {
        // 1. Inputs ko validate karna
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'type' => 'required|string',
            'relative_name' => 'required_if:type,Family',
        ]);

        // 2. Database (users table) mein data save karna
        \App\Models\User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cnic' => $request->cnic,
            'address' => $request->address,
            'relative_name' => $request->relative_name,
            'password' => Hash::make($request->password),
            'role' => strtolower($request->type), // donor, family, volunteer
            'status' => 'pending',
        ]);

        // 3. Wapas bhej kar success message dikhana
        return redirect()->back()->with('success', 'Your registration request has been submitted! Waiting for Admin approval.');
    }
}
