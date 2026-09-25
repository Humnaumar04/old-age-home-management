<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::latest()->get();
        return view('admin.manage-residents', compact('residents'));
    }

    public function create()
    {
        // Sirf family role wale users ki list fetch karein
        $familyUsers = User::where('role', 'family')->get();
        return view('admin.add-resident', compact('familyUsers'));
    }

    public function store(Request $request)
    {
        // 1. Sabhi fields ki validation (Age min:60 check ke sath)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'age' => 'required|integer|min:60', // Umar kam az kam 60 saal honi chahiye
            'gender' => 'required|string',
            'room_number' => 'required|string',
            'date_of_admission' => 'required|date',
            'medical_condition' => 'required|string',
            'bp_systolic' => 'required|integer',
            'bp_diastolic' => 'required|integer',
            'sugar_level' => 'required|numeric',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string',
            'doctor_name' => 'nullable|string|max:255',
            'family_user_id' => 'nullable|exists:users,id',
        ], [
            'age.min' => 'Old age home admission requires the resident to be at least 60 years old.'
        ]);

        // 2. Resident ka apna User account banana
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'resident',
        ]);

        // 3. Resident table mein record save karna
        Resident::create([
            'user_id' => $user->id, // Naye resident ki apni ID
            'family_user_id' => $request->family_user_id, // Dropdown se select kiya gaya family user
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'room_number' => $request->room_number,
            'date_of_admission' => $request->date_of_admission,
            'medical_condition' => $request->medical_condition,
            'bp_systolic' => $request->bp_systolic,
            'bp_diastolic' => $request->bp_diastolic,
            'sugar_level' => $request->sugar_level,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'doctor_name' => $request->doctor_name,
        ]);

        return redirect()->route('admin.manage_residents')->with('success', 'Resident added successfully!');
    }

    public function edit($id)
    {
        $resident = Resident::findOrFail($id);
        // Sirf family role wale users ki list edit view ke liye fetch karein
        $familyUsers = User::where('role', 'family')->get();
        return view('admin.edit-resident', compact('resident', 'familyUsers'));
    }

    public function update(Request $request, $id)
    {
        $resident = Resident::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:60',
            'gender' => 'required|string',
            'room_number' => 'required|string',
            'date_of_admission' => 'required|date',
            'medical_condition' => 'required|string',
            'bp_systolic' => 'required|integer',
            'bp_diastolic' => 'required|integer',
            'sugar_level' => 'required|numeric',
            'emergency_contact_name' => 'required|string',
            'emergency_contact_phone' => 'required|string',
            'doctor_name' => 'nullable|string|max:255',
            'family_user_id' => 'nullable|exists:users,id',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'age.min' => 'Old age home admission requires the resident to be at least 60 years old.'
        ]);

        $resident->update($request->except(['password', 'password_confirmation']));

        // Agar admin ne naya password diya hai, to sirf tab resident ka login password update karo
        if ($request->filled('password') && $resident->user_id) {
            User::where('id', $resident->user_id)->update([
                'password' => $request->password, // 'hashed' cast se automatically hash ho jayega
            ]);
        }

        return redirect()->route('admin.manage_residents')
            ->with('success', 'Resident updated successfully!');
    }

    public function destroy($id)
    {
        $resident = Resident::findOrFail($id);

        if ($resident->user_id) {
            User::where('id', $resident->user_id)->delete();
        }

        $resident->delete();

        return redirect()->route('admin.manage_residents')
            ->with('success', 'Resident and their account deleted successfully!');
    }
}
