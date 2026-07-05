<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admit New Resident - Old Age Home</title>
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

    <!-- SIDEBAR -->
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
                <a href="{{ route('admin.manage_staff') }}" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>👥</span> <span>Manage Staff</span>
                </a>
                <a href="{{ route('admin.manage_residents') }}" class="flex items-center space-x-3 bg-[#2A6673] px-4 p-3 rounded-xl font-medium transition">
                    <span>👤</span> <span>Manage Residents</span>
                </a>
                <a href="/admin/manage-complaints" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>📋</span> <span>Manage Complaints & Requests</span>
                </a>
                <a href="#" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>📋</span> <span>Approvals & Reports</span>
                </a>
            </nav>
        </div>

        <div>
            <a href="#" class="flex items-center space-x-3 hover:bg-red-900 px-4 p-3 rounded-xl font-medium transition text-red-200">
                <span>🚪</span> <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 overflow-y-auto p-8">

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-[#1E4C56] mb-1">Admit New Resident</h1>
                <p class="text-sm text-gray-500">Fill in all details to register a new resident at the Old Age Home</p>
            </div>
            <!-- Back Button -->
            <a href="{{ route('admin.manage_residents') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl font-medium text-sm transition">
                ← Back
            </a>
        </div>

        <!-- Form Top Banner Container -->
        <div class="max-w-5xl mb-6 bg-[#1E4C56] text-white p-4 rounded-2xl flex items-center space-x-4 shadow-sm">
            <div class="p-2.5 bg-[#2A6673] rounded-xl text-xl">👤+</div>
            <div>
                <h3 class="font-bold text-base">Resident Admission Form</h3>
                <p class="text-xs text-teal-200">All fields marked with <span class="text-red-400">*</span> are required</p>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 max-w-5xl">
            <form action="{{ route('admin.residents.store') }}" method="POST" class="space-y-6">
                @csrf
                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-xl mb-4 text-xs">
                    <strong>Validation Error:</strong>
                    <ul class="list-disc pl-4 mt-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- SECTION 1: PERSONAL INFORMATION -->
                <div>
                    <h3 class="text-xs font-bold text-[#2A6673] tracking-wider uppercase mb-4 flex items-center space-x-2">
                        <span>👤</span> <span>Personal Information</span>
                    </h3>
                    <hr class="mb-6 border-gray-100">

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" required placeholder="e.g. Muhammad Aslam" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                        </div>

                        <!-- NYE FIELDS: LOGIN CREDENTIALS -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" required placeholder="resident@example.com" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                                <input type="password" name="password" required placeholder="****" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                            </div>
                        </div>
                        <!-- END OF NEW FIELDS -->

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Age <span class="text-red-500">*</span></label>
                                <input type="number" name="age" required placeholder="e.g. 75" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Gender <span class="text-red-500">*</span></label>
                                <select name="gender" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30 text-gray-500">
                                    <option value="">-- Select --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Room Number <span class="text-red-500">*</span></label>
                                <input type="text" name="room_number" required placeholder="e.g. A-201" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Date of Admission <span class="text-red-500">*</span></label>
                                <input type="date" name="date_of_admission" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30 text-gray-500">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: MEDICAL INFORMATION -->
                <div>
                    <h3 class="text-xs font-bold text-[#2A6673] tracking-wider uppercase mb-4 flex items-center space-x-2">
                        <span>⚕️</span> <span>Medical Information</span>
                    </h3>
                    <hr class="mb-6 border-gray-100">

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Medical Condition <span class="text-red-500">*</span></label>
                            <select name="medical_condition" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30 text-gray-500">
                                <option value="">-- Select --</option>
                                <option value="Stable">Stable</option>
                                <option value="Critical">Critical</option>
                                <option value="Recovering">Recovering</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Blood Pressure (BP) <span class="text-red-500">*</span></label>
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="bp_systolic" required placeholder="Systolic (e.g. 130)" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                                    <span class="text-gray-400 font-medium">/</span>
                                    <input type="text" name="bp_diastolic" required placeholder="Diastolic (e.g. 85)" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                                    <span class="text-xs text-gray-400 pl-1">mmHg</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Sugar Level <span class="text-red-500">*</span></label>
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="sugar_level" required placeholder="e.g. 6.2" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                                    <span class="text-xs text-gray-400 whitespace-nowrap">mmol/L</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: EMERGENCY CONTACT -->
                <div>
                    <h3 class="text-xs font-bold text-[#2A6673] tracking-wider uppercase mb-4 flex items-center space-x-2">
                        <span>📞</span> <span>Emergency Contact</span>
                    </h3>
                    <hr class="mb-6 border-gray-100">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Emergency Contact Name <span class="text-red-500">*</span></label>
                            <input type="text" name="emergency_contact_name" required placeholder="e.g. Fatima Aslam (Daughter)" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Phone Number <span class="text-red-500">*</span></label>
                            <input type="text" name="emergency_contact_phone" required placeholder="e.g. 0300-1234567" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-3 pt-4 border-t border-gray-50">
                    <button type="submit" class="bg-[#1E4C56] hover:bg-[#15353d] text-white px-6 py-2.5 rounded-xl font-semibold shadow-sm transition flex items-center space-x-2">
                        <span>✓</span> <span>Submit Admission</span>
                    </button>
                    <a href="{{ route('admin.manage_residents') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-6 py-2.5 rounded-xl font-semibold transition flex items-center justify-center">
                        Cancel
                    </a>
                </div>

            </form>
        </div>

    </main>

</body>

</html>