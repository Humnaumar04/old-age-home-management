@extends('layouts.admin')
@section('content')

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-[#1E4C56] mb-1">Add New Staff Member</h1>
                <p class="text-sm text-gray-500">Enter the full details to register a new staff member</p>
            </div>
            <!-- Back Button -->
            <a href="{{ route('admin.manage_staff') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl font-medium text-sm transition">
                ← Back
            </a>
        </div>

        <!-- Form Card Container -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 max-w-5xl">
            <form action="{{ route('admin.add_staff.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Row 1: Full Name & Designation -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required placeholder="Dr. Raheela Siddiqui" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Designation / Role <span class="text-red-500">*</span></label>
                        <select name="designation" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30 text-gray-500">
                            <option value="">-- Select --</option>
                            <option value="Medical Officer">Medical Officer</option>
                            <option value="Head Nurse">Head Nurse</option>
                            <option value="Caretaker">Caretaker</option>
                            <option value="Cook">Cook</option>
                        </select>
                    </div>
                </div>

                <!-- Row 2: CNIC & Phone -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">CNIC Number <span class="text-red-500">*</span></label>
                        <input type="text" name="cnic" required placeholder="42201-1234567-1" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Phone Number <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" required placeholder="0321-1234567" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                </div>

                <!-- Row 3: Email & Shift Timing -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" placeholder="staff@home.pk" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Shift Timing <span class="text-red-500">*</span></label>
                        <select name="shift" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30 text-gray-500">
                            <option value="">-- Select --</option>
                            <option value="Morning">Morning</option>
                            <option value="Evening">Evening</option>
                            <option value="Night">Night</option>
                        </select>
                    </div>
                </div>

                <!-- Row 4: Date of Joining & Monthly Salary -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Date of Joining <span class="text-red-500">*</span></label>
                        <input type="date" name="date_of_joining" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30 text-gray-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Monthly Salary (PKR) <span class="text-red-500">*</span></label>
                        <input type="number" name="salary" required placeholder="45000" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                </div>

                <!-- Row 5: Residential Address -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Residential Address</label>
                    <textarea name="address" rows="3" placeholder="Full home address..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30 resize-none"></textarea>
                </div>

                <!-- Row 6: Emergency Contact Name & Phone -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Emergency Contact Name</label>
                        <input type="text" name="emergency_name" placeholder="Next of kin name" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Emergency Contact Phone</label>
                        <input type="text" name="emergency_phone" placeholder="0300-1234567" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                </div>

                <!-- Row 7: Temporary Password & Confirm Password -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Temporary Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password" required placeholder="Assign a password" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Confirm Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation" required placeholder="Repeat password" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-3 pt-4">
                    <button type="submit" class="bg-[#1E4C56] hover:bg-[#15353d] text-white px-6 py-2.5 rounded-xl font-semibold shadow-sm transition">
                        Add Staff Member
                    </button>
                    <a href="{{ route('admin.manage_staff') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-6 py-2.5 rounded-xl font-semibold transition flex items-center justify-center">
                        Cancel
                    </a>
                </div>

            </form>
        </div>

    @endsection