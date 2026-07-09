<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F8F6F0] flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#1E4C56] text-white flex flex-col justify-between p-6 flex-shrink-0">
        <div>
            <div class="flex items-center space-x-3 mb-8">
                <div class="p-2 bg-[#D1884F] rounded-xl">❤️</div>
                <div>
                    <h2 class="font-bold text-lg">Old Age Home</h2>
                    <p class="text-xs text-teal-200">Management System</p>
                </div>
            </div>

            <nav class="space-y-2 mb-6">
                <a href="#" class="flex items-center space-x-3 bg-[#2A6673] px-4 p-3 rounded-xl font-medium transition text-white">
                    <span>👤</span> <span>My Profile</span>
                </a>

                <a href="/resident/submit-complaint" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>💬</span> <span>Submit Complaint</span>
                </a>
                <a href="{{ route('resident.request-help') }}" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>🔔</span> <span>Request Help</span>
                </a>
            </nav>
        </div>
        <div>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex items-center space-x-3 hover:bg-red-900 px-4 p-3 rounded-xl font-medium transition text-red-200">
                <span>🚪</span> <span>Logout</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 overflow-y-auto p-8">
        <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- PROFILE CARD -->
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full mx-auto mb-6 flex items-center justify-center text-3xl">👤</div>
                <h2 class="text-xl font-bold text-[#1E4C56]">{{ $resident->name }}</h2>
                <p class="text-gray-500 text-sm">Room {{ $resident->room_number }} • Age {{ $resident->age }}</p>
                <span class="inline-block mt-3 px-4 py-1 bg-green-100 text-green-700 text-xs rounded-full font-bold">Stable</span>

                <div class="mt-8 space-y-4 text-sm text-left border-t pt-8">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Admitted</span>
                        <span class="font-bold">{{ $resident->date_of_admission }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Family</span>
                        <span class="font-bold text-right">{{ $resident->emergency_contact_name }}</span>
                    </div>
                    <!-- Doctor Name Added Here -->
                    <div class="flex justify-between">
                        <span class="text-gray-500">Doctor</span>
                        <span class="font-bold text-right">{{ $resident->doctor_name ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- VITALS & ACTIVITIES -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Vitals -->
                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                    <h3 class="font-bold text-[#1E4C56] mb-6">Today's Health Vitals</h3>
                    <div class="grid grid-cols-3 gap-6">
                        <div class="bg-[#F8F6F0] p-5 rounded-2xl text-center">
                            <p class="text-lg font-bold text-[#1E4C56]">{{ $resident->bp_systolic }}/{{ $resident->bp_diastolic }}</p>
                            <p class="text-[10px] text-gray-500 font-bold uppercase mt-1">Blood Pressure</p>
                        </div>
                        <div class="bg-[#F8F6F0] p-5 rounded-2xl text-center">
                            <p class="text-lg font-bold text-[#1E4C56]">{{ $resident->sugar_level }}</p>
                            <p class="text-[10px] text-gray-500 font-bold uppercase mt-1">Blood Sugar</p>
                        </div>
                        <div class="bg-[#F8F6F0] p-5 rounded-2xl text-center">
                            <p class="text-lg font-bold text-[#1E4C56]">98.4°F</p>
                            <p class="text-[10px] text-gray-500 font-bold uppercase mt-1">Temperature</p>
                        </div>
                    </div>
                </div>

                <!-- Activities -->
                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                    <h3 class="font-bold text-[#1E4C56] mb-6">Daily Activities</h3>
                    <div class="grid grid-cols-4 gap-4">
                        <!-- Breakfast -->
                        <div class="bg-green-50 border border-green-200 p-4 rounded-xl text-center">
                            <p class="font-bold text-sm text-[#1E4C56]">Breakfast</p>
                            <p class="text-[10px] font-bold uppercase mt-1 text-green-700">{{ $activities->breakfast ?? 'Pending' }}</p>
                        </div>

                        <!-- Morning Walk -->
                        <div class="bg-red-50 border border-red-200 p-4 rounded-xl text-center">
                            <p class="font-bold text-sm text-[#1E4C56]">Morning Walk</p>
                            <p class="text-[10px] font-bold uppercase mt-1 text-red-700">{{ $activities->morning_walk ?? 'Pending' }}</p>
                        </div>

                        <!-- Medication -->
                        <div class="bg-green-50 border border-green-200 p-4 rounded-xl text-center">
                            <p class="font-bold text-sm text-[#1E4C56]">Medication</p>
                            <p class="text-[10px] font-bold uppercase mt-1 text-green-700">{{ $activities->medication_taken ?? 'Pending' }}</p>
                        </div>

                        <!-- Lunch -->
                        <div class="bg-green-50 border border-green-200 p-4 rounded-xl text-center">
                            <p class="font-bold text-sm text-[#1E4C56]">Lunch</p>
                            <p class="text-[10px] font-bold uppercase mt-1 text-green-700">{{ $activities->lunch ?? 'Pending' }}</p>
                        </div>

                        <!-- Physiotherapy -->
                        <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-xl text-center">
                            <p class="font-bold text-sm text-[#1E4C56]">Physio</p>
                            <p class="text-[10px] font-bold uppercase mt-1 text-yellow-700">{{ $activities->physical_therapy ?? 'Pending' }}</p>
                        </div>

                        <!-- Dinner -->
                        <div class="bg-gray-50 border border-gray-200 p-4 rounded-xl text-center">
                            <p class="font-bold text-sm text-[#1E4C56]">Dinner</p>
                            <p class="text-[10px] font-bold uppercase mt-1 text-gray-500">{{ $activities->dinner ?? 'Pending' }}</p>
                        </div>

                        <!-- Sleep -->
                        <div class="bg-gray-50 border border-gray-200 p-4 rounded-xl text-center">
                            <p class="font-bold text-sm text-[#1E4C56]">Sleep</p>
                            <p class="text-[10px] font-bold uppercase mt-1 text-gray-500">{{ $activities->sleep_routine ?? 'Pending' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>