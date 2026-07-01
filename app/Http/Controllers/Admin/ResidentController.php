<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    // 1. Saare residents ki list dikhane ke liye (manage-residents.blade.php)
    public function index()
    {
        $residents = Resident::latest()->get();
        return view('admin.manage-residents', compact('residents'));
    }

    // 2. Add Resident ka form dikhane ke liye (Aapki file: add-resident.blade.php)
    public function create()
    {
        return view('admin.add-resident');
    }

    // 3. Form ka data database mein save karne ka logic
    public function store(Request $request)
    {
        // Validation: Taake koi input khali na raye aur exact data types save hon
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'room_number' => 'required|string',
            'date_of_admission' => 'required|date',
            'medical_condition' => 'required|string',
            'bp_systolic' => 'required|integer',
            'bp_diastolic' => 'required|integer',
            'sugar_level' => 'required|numeric',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string',
        ]);

        // Database mein data insert karne ki command
        Resident::create($request->all());

        // Data save hone ke baad wapas list wale page par bhejna aur success message dena
        return redirect()->route('admin.manage_residents')->with('success', 'Resident added successfully!');
    }
    // 4. Edit form dikhane ke liye
    public function edit($id)
    {
        $resident = Resident::findOrFail($id);
        return view('admin.edit-resident', compact('resident'));
    }

    // 5. Data update karne ke liye
    public function update(Request $request, $id)
    {
        $resident = Resident::findOrFail($id);

        $request->validate([
            'name'                    => 'required|string|max:255',
            'age'                     => 'required|integer',
            'gender'                  => 'required|string',
            'room_number'             => 'required|string',
            'date_of_admission'       => 'required|date',
            'medical_condition'       => 'required|string',
            'bp_systolic'             => 'required|integer',
            'bp_diastolic'            => 'required|integer',
            'sugar_level'             => 'required|numeric',
            'emergency_contact_name'  => 'required|string',
            'emergency_contact_phone' => 'required|string',
        ]);

        $resident->update($request->all());

        return redirect()->route('admin.manage_residents')
            ->with('success', 'Resident updated successfully!');
    }

    // 6. Delete karne ke liye
    public function destroy($id)
    {
        $resident = Resident::findOrFail($id);
        $resident->delete();

        return redirect()->route('admin.manage_residents')
            ->with('success', 'Resident deleted successfully!');
    }
}
