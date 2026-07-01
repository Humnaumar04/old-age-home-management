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
        // 1. Pehle users table mein login account banayein
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // Password encrypt hona lazmi hai
            'role'     => 'staff', // Login ke liye role 'staff' set ho raha hai
        ]);

        // 2. Phir staff table mein details aur 'user_id' link karein
        \App\Models\Staff::create([
            'user_id'         => $user->id, // Yahan 'users' table ki id aa jayegi
            'name'            => $request->name,
            'designation'     => $request->designation,
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
            'name' => 'required|string|max:255',
            'designation' => 'required|string',
            'phone' => 'required|string',
            'shift' => 'required|string',
        ]);

        $staff->update($request->all());

        return redirect()->route('admin.manage_staff')->with('success', 'Staff member updated successfully!');
    }
}
