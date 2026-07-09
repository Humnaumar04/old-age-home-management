<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit a Complaint - Old Age Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F8F6F0] text-gray-800 flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#1E4C56] text-white flex flex-col justify-between p-6 flex-shrink-0 h-full overflow-y-auto">
        <div>
            <!-- Header/Logo Context -->
            <div class="flex items-center space-x-3 mb-8">
                <div class="p-2 bg-[#D1884F] rounded-xl text-white">❤️</div>
                <div>
                    <h2 class="font-bold text-lg leading-tight">Old Age Home</h2>
                    <p class="text-xs text-teal-200">Management System</p>
                </div>
            </div>

            <!-- Profile Info Panel (Resident context from image) -->
            <div class="flex items-center space-x-3 mb-8 bg-[#255A66] p-3 rounded-xl">
                <div class="w-10 h-10 rounded-full bg-teal-700 flex items-center justify-center font-bold">MA</div>
                <div>
                    <h4 class="font-semibold text-sm">{{ auth()->user()->name ?? 'Muhammad Aslam' }}</h4>
                    <p class="text-xs text-teal-300">Resident</p>
                </div>
            </div>

            <!-- Resident Navigation Links -->
            <nav class="space-y-2 mb-6">
                <!-- "My Profile" ka link update karein -->
                <a href="{{ route('resident.dashboard') }}" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>👤</span> <span>My Profile</span>
                </a>
                <!-- Active Tab: Submit Complaint -->
                <a href="/resident/submit-complaint" class="flex items-center space-x-3 bg-[#2A6673] px-4 p-3 rounded-xl font-medium transition text-white">
                    <span>💬</span> <span>Submit Complaint</span>
                </a>
                <a href="{{ route('resident.request-help') }}" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>🔔</span> <span>Request Help</span>
                </a>
            </nav>
        </div>

        <!-- LOGOUT BUTTON (Scroll responsive) -->
        <div class="mt-auto pt-4 border-t border-teal-800/50">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex items-center space-x-3 hover:bg-red-900 px-4 p-3 rounded-xl font-medium transition text-red-200">
                <span>🚪</span> <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 overflow-y-auto p-8 md:p-12">

        <!-- Page Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-[#1E4C56]">Submit a Complaint</h1>
                <p class="text-sm text-gray-500 mt-1">Share any concern — your voice matters and will be addressed</p>
            </div>

            <!-- My Complaints Button -->
            <a href="{{ route('resident.complaints') }}"
                class="flex items-center space-x-2 bg-white border border-[#1E4C56] text-[#1E4C56] px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-[#1E4C56] hover:text-white transition shadow-sm">
                <span>📋</span> <span>My Complaints</span>
            </a>
        </div>
        <!-- Success Message Box -->
        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-semibold flex items-center">
            <span class="mr-2">✅</span> {{ session('success') }}
        </div>
        @endif

        <!-- FORM CONTAINER FROM FIGMA -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm max-w-3xl p-8">
            <form action="{{ route('complaint.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Complaint Category Dropdown -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Complaint Category <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select name="category" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm bg-white focus:outline-none focus:border-[#1E4C56] appearance-none cursor-pointer text-gray-600">
                            <option value="" disabled selected>-- Select --</option>
                            <option value="Food Quality">Food Quality</option>
                            <option value="Room Maintenance">Room Maintenance</option>
                            <option value="Staff Behavior">Staff Behavior</option>
                            <option value="Medical Service">Medical Service</option>
                            <option value="Other">Other</option>
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400 text-xs">▼</span>
                    </div>
                </div>

                <!-- Subject / Title Input -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Subject / Title <span class="text-red-500">*</span></label>
                    <input type="text" name="subject" required placeholder="Short description of your complaint"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#1E4C56] placeholder-gray-400">
                </div>

                <!-- Detailed Description Textarea -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Detailed Description <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="4" required placeholder="Please describe the issue in detail — include date, time, and names if relevant..."
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#1E4C56] placeholder-gray-400 resize-none"></textarea>
                </div>

                <!-- Desired Resolution Input -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Desired Resolution</label>
                    <input type="text" name="resolution" placeholder="What outcome would resolve this for you?"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#1E4C56] placeholder-gray-400">
                </div>

                <!-- Urgency Level Dropdown -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Urgency</label>
                    <div class="relative">
                        <select name="urgency" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm bg-white focus:outline-none focus:border-[#1E4C56] appearance-none cursor-pointer text-gray-600">
                            <option value="" disabled selected>-- Select --</option>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400 text-xs">▼</span>
                    </div>
                </div>

                <!-- Action Button Actions Layer -->
                <div class="flex items-center space-x-3 pt-4">
                    <button type="submit" class="px-6 py-3 bg-[#1E4C56] hover:bg-[#255A66] text-white font-semibold rounded-xl text-sm transition shadow-sm flex items-center space-x-2">
                        <span>💬</span> <span>Submit Complaint</span>
                    </button>
                    <button type="reset" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold rounded-xl text-sm transition">
                        Clear Form
                    </button>
                </div>
            </form>

            <!-- Bottom Disclaimer Meta Info from Figma -->
            <p class="mt-6 text-xs text-gray-400 text-center sm:text-left">
                Your complaint will be reviewed by the Admin within 24–48 hours. You will receive a response.
            </p>
        </div>
    </main>

</body>

</html>