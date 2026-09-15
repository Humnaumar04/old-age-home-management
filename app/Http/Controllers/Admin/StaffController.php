<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    // 1. Manage Staff ka Table Page Dikhane ke liye
    public function index()
    {
        $staffMembers = Staff::latest()->get();
        return view('admin.manage-staff', compact('staffMembers'));
    }

    // 2. Add Staff Ka Form Page Dikhane ke liye
    public function create()
    {
        return view('admin.add-staff');
    }

    // 3. Form ka data Database mein Save karne ke liye
    public function store(Request $request)
    {
        // 0. Pehle validation — taake duplicate email ya missing password 500 error na dein
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|string|min:6|confirmed',
            'cnic'             => 'nullable|string|max:20',
            'phone'            => 'nullable|string|max:20',
            'shift'            => 'required|string',
            'date_of_joining'  => 'nullable|date',
            'salary'           => 'nullable|numeric',
            'address'          => 'nullable|string',
            'emergency_name'   => 'nullable|string|max:255',
            'emergency_phone'  => 'nullable|string|max:20',
        ]);

        // 1. Pehle users table mein login account banayein
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // Password encrypt hona lazmi hai
            'role'     => 'staff', // Login ke liye role 'staff' set ho raha hai
            'status' => 'approved',
        ]);

        // 2. Phir staff table mein details aur 'user_id' link karein (Designation hata di gayi hai)
        \App\Models\Staff::create([
            'user_id'         => $user->id, // Yahan 'users' table ki id aa jayegi
            'name'            => $request->name,
            'cnic'            => $request->cnic,
            'phone'           => $request->phone,
            'email'           => $request->email,
            'shift'           => $request->shift,
            'date_of_joining' => $request->date_of_joining,
            'salary'          => $request->salary,
            'address'         => $request->address,
            'emergency_name'  => $request->emergency_name,
            'emergency_phone' => $request->emergency_phone,
            'status'          => 'Active',
        ]);

        return redirect()->route('admin.manage_staff')->with('success', 'Staff added successfully!');
    }

    // Edit Form ka page dikhane ke liye
    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('admin.edit-staff', compact('staff'));
    }

    // Data update karne ke liye
    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'required|string',
            'shift'    => 'required|string',
            'email'    => 'nullable|email|unique:users,email,' . $staff->user_id,
            'password' => 'nullable|string|min:6|confirmed',
            'cnic'     => 'nullable|string|max:20',
            'date_of_joining' => 'nullable|date',
            'salary'   => 'nullable|numeric',
            'address'  => 'nullable|string',
            'emergency_name'  => 'nullable|string|max:255',
            'emergency_phone' => 'nullable|string|max:20',
        ]);

        // 1. Staff table ka data update karein
        $staff->update($request->except('designation'));

        // 2. Agar staff ke sath user account linked hai, toh users table mein bhi naam aur email update karein
        if ($staff->user_id) {
            $user = User::find($staff->user_id);
            if ($user) {
                $user->update([
                    'name'  => $request->name,
                    'email' => $request->filled('email') ? $request->email : $user->email, // Agar email diya hai toh update ho jaye
                    'password' => $request->filled('password') ? $request->password : $user->password, // Sirf tab update ho jab naya password diya ho, warna purana hi rahe
                    'cnic'            => $request->cnic,
                    'phone'           => $request->phone,
                    'shift'           => $request->shift,
                    'date_of_joining' => $request->date_of_joining,
                    'salary'          => $request->salary,
                    'address'         => $request->address,
                    'emergency_name'  => $request->emergency_name,
                    'emergency_phone' => $request->emergency_phone,
                ]);
            }
        }

        return redirect()->route('admin.manage_staff')->with('success', 'Staff member updated successfully!');
    }
}
