<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Emergency - Old Age Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F8F6F0] text-gray-800 flex h-screen overflow-hidden">

    <aside class="w-64 bg-[#1E4C56] text-white flex flex-col justify-between p-6 flex-shrink-0">
        <div>
            <div class="flex items-center space-x-3 mb-8">
                <div class="p-2 bg-[#D1884F] rounded-xl text-white">❤️</div>
                <div>
                    <h2 class="font-bold text-lg leading-tight">Old Age Home</h2>
                    <p class="text-xs text-teal-200">Management System</p>
                </div>
            </div>

            <div class="flex items-center space-x-3 mb-8 bg-[#255A66] p-3 rounded-xl">
                <div class="w-10 h-10 rounded-full bg-teal-700 flex items-center justify-center font-bold uppercase text-sm">
                    {{ substr(auth()->user()->name ?? 'ST', 0, 2) }}
                </div>
                <div>
                    <h4 class="font-semibold text-sm">{{ auth()->user()->name ?? 'Staff Member' }}</h4>
                    <p class="text-xs text-teal-300">Staff Member</p>
                </div>
            </div>

            <nav class="space-y-2">
                <a href="/staff/dashboard" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>📊</span> <span>Dashboard</span>
                </a>

                <a href="/staff/dashboard" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>🩺</span> <span>Update Health</span>
                </a>

                <a href="#" class="flex items-center space-x-3 bg-[#2A6673] px-4 p-3 rounded-xl font-medium transition">
                    <span>🚨</span> <span>Report Emergency</span>
                </a>
            </nav>
        </div>

        <div>
            <a href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex items-center space-x-3 hover:bg-red-900 px-4 p-3 rounded-xl font-medium transition text-red-200">
                <span>🚪</span> <span>Logout</span>
            </a>

            <form id="logout-form" action="/logout" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </aside>

    <main class="flex-1 overflow-y-auto p-8">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#1E4C56]">Report Emergency</h1>
            <p class="text-sm text-gray-500 mt-1">Immediately alert the admin and medical team about a critical situation</p>
        </div>

        <div class="bg-red-50 border border-red-100 rounded-2xl p-4 flex items-start space-x-3 mb-6">
            <span class="text-red-600 text-lg">⚠️</span>
            <p class="text-xs text-red-700 font-medium leading-relaxed">
                This form is for urgent situations only. For life-threatening emergencies, call <span class="font-bold underline">Rescue 1122</span> immediately.
            </p>
        </div>

        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-2xl text-xs font-semibold mb-6">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('emergency.store') }}" method="POST" class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">Resident Name <span class="text-red-500">*</span></label>
                    <select name="resident_id" id="resident_select" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition" required>
                        <option value="">-- Select --</option>
                        @foreach($residents as $resident)
                        <option value="{{ $resident->id }}">{{ $resident->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">Room Number</label>
                    <input type="text" id="room_no" placeholder="Auto-filled from resident" class="w-full px-4 py-2.5 bg-gray-100/70 border border-gray-200 rounded-xl text-xs text-gray-500 outline-none cursor-not-allowed" readonly>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">Emergency Type <span class="text-red-500">*</span></label>
                    <select name="emergency_type" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition" required>
                        <option value="">-- Select --</option>
                        <option value="Medical Attack">Medical Attack / Illness</option>
                        <option value="Severe Fall">Severe Fall / Injury</option>
                        <option value="Cardiac Arrest">Cardiac Arrest</option>
                        <option value="Unresponsive">Unresponsive / Fainted</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">Severity Level <span class="text-red-500">*</span></label>
                    <select name="severity_level" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition" required>
                        <option value="">-- Select --</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                        <option value="Critical">Critical</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">Date & Time of Incident <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="incident_time" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">Reporting Staff (Auto-filled)</label>
                    <input type="text" value="{{ auth()->user()->name ?? 'Staff Member' }}" class="w-full px-4 py-2.5 bg-gray-100/70 border border-gray-200 rounded-xl text-xs text-gray-400 outline-none cursor-not-allowed" readonly>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-2">Detailed Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" placeholder="What exactly happened? Include symptoms, time of onset, and any witnesses..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition" required></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">Action Already Taken</label>
                    <textarea name="action_taken" rows="3" placeholder="First aid given, medications administered, family notified..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">Other Staff Present</label>
                    <textarea name="other_staff_present" rows="3" placeholder="Names of witnesses or helpers..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition"></textarea>
                </div>
            </div>

            <div class="flex items-center space-x-4 pt-4 border-t border-gray-100">
                <button type="submit" class="px-5 py-2.5 bg-red-600 text-white rounded-xl text-xs font-bold shadow-sm hover:bg-red-700 transition flex items-center space-x-1">
                    <span>🚨</span> <span>Submit Emergency Report</span>
                </button>
                <button type="button" class="px-4 py-2.5 border border-gray-200 rounded-xl text-xs font-medium text-gray-600 hover:bg-gray-50 transition">
                    Save as Draft
                </button>
            </div>
        </form>
    </main>

    <script>
        document.getElementById('resident_select').addEventListener('change', function() {
            let residentId = this.value;
            let roomInput = document.getElementById('room_no');

            if (residentId) {
                roomInput.value = "Loading...";

                // Backend AJAX API endpoint se data fetch karna
                fetch(`/staff/get-resident-room/${residentId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Room number field mein response fill karna
                        roomInput.value = data.room_number ? data.room_number : 'No Room Assigned';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        roomInput.value = 'Error fetching room';
                    });
            } else {
                roomInput.value = '';
            }
        });
    </script>
</body>

</html>