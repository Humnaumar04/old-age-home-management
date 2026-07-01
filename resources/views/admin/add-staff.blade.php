<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Staff Member - Old Age Home</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F8F6F0] text-gray-800 flex h-screen overflow-hidden">

    <!-- 1. SIDEBAR -->
    <aside class="w-64 bg-[#1E4C56] text-white flex flex-col justify-between p-6 flex-shrink-0">
        <div>
            <!-- Logo Section -->
            <div class="flex items-center space-x-3 mb-8">
                <div class="p-2 bg-[#D1884F] rounded-xl text-white">❤️</div>
                <div>
                    <h2 class="font-bold text-lg leading-tight">Old Age Home</h2>
                    <p class="text-xs text-teal-200">Management System</p>
                </div>
            </div>

            <!-- Profile Info -->
            <div class="flex items-center space-x-3 mb-8 bg-[#255A66] p-3 rounded-xl">
                <div class="w-10 h-10 rounded-full bg-teal-700 flex items-center justify-center font-bold">UG</div>
                <div>
                    <h4 class="font-semibold text-sm">{{ auth()->user()->name ?? 'Usman Ghani' }}</h4>
                    <p class="text-xs text-teal-300">Administrator</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>📊</span> <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.manage_staff') }}" class="flex items-center space-x-3 bg-[#2A6673] px-4 p-3 rounded-xl font-medium transition">
                    <span>👥</span> <span>Manage Staff</span>
                </a>
                <a href="{{ route('admin.manage_residents') }}" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>👤</span> <span>Manage Residents</span>
                </a>
                <a href="#" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>📋</span> <span>Approvals & Reports</span>
                </a>
            </nav>
        </div>

        <!-- Logout Link -->
        <div>
            <a href="#" class="flex items-center space-x-3 hover:bg-red-900 px-4 p-3 rounded-xl font-medium transition text-red-200">
                <span>🚪</span> <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- 2. MAIN CONTENT AREA -->
    <main class="flex-1 overflow-y-auto p-8">

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

    </main>

</body>

</html>