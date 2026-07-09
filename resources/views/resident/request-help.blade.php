<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Help - Old Age Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            <div class="flex items-center space-x-3 mb-8">
                <div class="p-2 bg-[#D1884F] rounded-xl text-white">❤️</div>
                <div>
                    <h2 class="font-bold text-lg leading-tight">Old Age Home</h2>
                    <p class="text-xs text-teal-200">Management System</p>
                </div>
            </div>

            <div class="flex items-center space-x-3 mb-8 bg-[#255A66] p-3 rounded-xl">
                <div class="w-10 h-10 rounded-full bg-teal-700 flex items-center justify-center font-bold">MA</div>
                <div>
                    <h4 class="font-semibold text-sm">{{ auth()->user()->name ?? 'Muhammad Aslam' }}</h4>
                    <p class="text-xs text-teal-300">Resident</p>
                </div>
            </div>

            <nav class="space-y-2 mb-6">
                <a href="{{ route('resident.dashboard') }}" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>👤</span> <span>My Profile</span>
                </a>
                <a href="{{ route('resident.submit-complaint') }}" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>💬</span> <span>Submit Complaint</span>
                </a>
                <!-- Active Tab -->
                <a href="/resident/request-help" class="flex items-center space-x-3 bg-[#2A6673] px-4 p-3 rounded-xl font-medium transition text-white">
                    <span>🔔</span> <span>Request Help</span>
                </a>
            </nav>
        </div>

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
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-[#1E4C56]">Request Assistance</h1>
                <p class="text-sm text-gray-500 mt-1">Need help? Select the type of assistance you require.</p>
            </div>
            <a href="{{ route('resident.my-requests') }}" 
            class="flex items-center space-x-2 bg-white border border-[#1E4C56] text-[#1E4C56] px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-[#1E4C56] hover:text-white transition shadow-sm">
                📜 My Requests
            </a>
        </div>
        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-xl">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm max-w-3xl p-8">
            <form action="{{ route('help.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Help Type -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Assistance Type <span class="text-red-500">*</span></label>
                    <select name="help_type" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm bg-white focus:outline-none focus:border-[#1E4C56]">
                        <option value="" disabled selected>-- Select Type --</option>
                        <option value="Medical">Medical Help</option>
                        <option value="Personal">Personal Care</option>
                        <option value="Emergency">Urgent/Emergency</option>
                        <option value="Maintenance">Room Maintenance</option>
                    </select>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="4" required placeholder="Describe what you need help with..."
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#1E4C56]"></textarea>
                </div>

                <!-- Submit -->
                <button type="submit" class="px-6 py-3 bg-[#1E4C56] hover:bg-[#255A66] text-white font-semibold rounded-xl text-sm transition shadow-sm">
                    Send Request
                </button>
            </form>
        </div>
    </main>

</body>

</html>