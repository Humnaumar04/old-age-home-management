@extends('layouts.admin')
@section('content')

        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-[#1E4C56] mb-1">Edit Staff Member</h1>
                <p class="text-sm text-gray-500">Update the details of {{ $staff->name }}</p>
            </div>
            <a href="{{ route('admin.manage_staff') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl font-medium text-sm transition">
                ← Back
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 max-w-5xl">
            <form action="{{ route('admin.manage_staff.update', $staff->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Row 1: Full Name & Designation -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ $staff->name }}" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Designation / Role <span class="text-red-500">*</span></label>
                        <select name="designation" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                            <option value="Medical Officer" {{ $staff->designation == 'Medical Officer' ? 'selected' : '' }}>Medical Officer</option>
                            <option value="Head Nurse" {{ $staff->designation == 'Head Nurse' ? 'selected' : '' }}>Head Nurse</option>
                            <option value="Caretaker" {{ $staff->designation == 'Caretaker' ? 'selected' : '' }}>Caretaker</option>
                            <option value="Cook" {{ $staff->designation == 'Cook' ? 'selected' : '' }}>Cook</option>
                        </select>
                    </div>
                </div>

                <!-- Row 2: CNIC & Phone -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">CNIC Number <span class="text-red-500">*</span></label>
                        <input type="text" name="cnic" value="{{ $staff->cnic }}" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Phone Number <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" value="{{ $staff->phone }}" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                </div>

                <!-- Row 3: Email & Shift -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" value="{{ $staff->email }}" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Shift Timing <span class="text-red-500">*</span></label>
                        <select name="shift" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                            <option value="Morning" {{ $staff->shift == 'Morning' ? 'selected' : '' }}>Morning</option>
                            <option value="Evening" {{ $staff->shift == 'Evening' ? 'selected' : '' }}>Evening</option>
                            <option value="Night" {{ $staff->shift == 'Night' ? 'selected' : '' }}>Night</option>
                        </select>
                    </div>
                </div>

                <!-- Row 4: Date of Joining & Salary -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Date of Joining <span class="text-red-500">*</span></label>
                        <input type="date" name="date_of_joining" value="{{ $staff->date_of_joining }}" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Monthly Salary (PKR) <span class="text-red-500">*</span></label>
                        <input type="number" name="salary" value="{{ $staff->salary }}" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                </div>

                <!-- Row 5: Address -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Residential Address</label>
                    <textarea name="address" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30 resize-none">{{ $staff->address }}</textarea>
                </div>

                <!-- Row 6: Emergency Contact -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Emergency Contact Name</label>
                        <input type="text" name="emergency_name" value="{{ $staff->emergency_name }}" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Emergency Contact Phone</label>
                        <input type="text" name="emergency_phone" value="{{ $staff->emergency_phone }}" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                </div>

                <!-- Row 7: Password (Optional on Edit) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">New Password <span class="text-gray-400 font-normal">(Leave blank to keep current)</span></label>
                        <input type="password" name="password" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex space-x-3 pt-4">
                    <button type="submit" class="bg-[#1E4C56] hover:bg-[#15353d] text-white px-6 py-2.5 rounded-xl font-semibold shadow-sm transition">
                        Update Staff Member
                    </button>
                    <a href="{{ route('admin.manage_staff') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-6 py-2.5 rounded-xl font-semibold transition flex items-center justify-center">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    @endsection