<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Admin Login Screen dikhane ke liye
    public function showLogin()
    {
        return view('admin.login');
    }

    // 2. Admin Login Logic
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {

            $user = Auth::user();

            // Sirf admin role hi is route se login kar sakta hai
            if (strtolower($user->role) !== 'admin') {
                Auth::logout();
                return back()->withErrors(['email' => 'These credentials do not match an admin account.']);
            }

            // Status check (agar admin bhi approval flow mein hai tou)
            if (strtolower($user->status) !== 'approved') {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account is still pending approval.']);
            }

            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
