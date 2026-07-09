<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Health - Old Age Home</title>
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

            <!-- Is behtareen aur dynamic code ko paste kar dein -->
            <div class="flex items-center space-x-3 mb-8 bg-[#255A66] p-3 rounded-xl">
                <div class="w-10 h-10 rounded-full bg-teal-700 flex items-center justify-center font-bold uppercase text-sm">
                    {{ substr(auth()->user()->name ?? 'Staff', 0, 2) }}
                </div>
                <div>
                    <h4 class="font-semibold text-sm">{{ auth()->user()->name ?? 'Staff Member' }}</h4>
                    <p class="text-xs text-teal-300">Staff Member</p>
                </div>
            </div>
            <nav class="space-y-2">
                <a href="{{ route('staff.dashboard') }}" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>📊</span> <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-3 bg-[#2A6673] px-4 p-3 rounded-xl font-medium transition">
                    <span>🩺</span> <span>Update Health</span>
                </a>
                <a href="/staff/report-emergency" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>🚨</span> <span>Report Emergency</span>
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

    <main class="flex-1 overflow-y-auto p-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-[#1E4C56]">Update Health — <span class="text-gray-800">{{ $resident->name ?? 'Muhammad Aslam' }}</span></h1>
                <p class="text-sm text-gray-500 mt-1">
                    Room {{ $resident->room_number ?? 'A-239' }} &bull;
                    Condition:
                    @if(strtolower($resident->medical_condition ?? '') == 'critical')
                    <span class="px-2 py-0.5 bg-red-50 text-red-700 rounded-full text-xs font-semibold">Critical</span>
                    @else
                    <span class="px-2 py-0.5 bg-green-50 text-green-700 rounded-full text-xs font-semibold">{{ $resident->medical_condition ?? 'Stable' }}</span>
                    @endif
                </p>
            </div>
            <a href="{{ route('staff.dashboard') }}" class="px-4 py-2 border border-gray-200 rounded-xl text-xs font-bold text-gray-700 bg-white hover:bg-gray-50 transition shadow-sm">
                &larr; Back to Dashboard
            </a>
        </div>

        <form action="{{ route('staff.save_health', $resident->id) }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <div class="flex items-center space-x-2 border-b border-gray-100 pb-4 mb-6">
                        <span class="text-lg">🌡️</span>
                        <h2 class="text-base font-bold text-[#1E4C56]">Vital Signs</h2>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2">Blood Pressure (mmHg)</label>
                            <div class="grid grid-cols-2 gap-3">
                                <input type="number" name="bp_systolic" placeholder="Systolic" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition" required>
                                <input type="number" name="bp_diastolic" placeholder="Diastolic" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2">Blood Sugar (mmol/L)</label>
                            <input type="text" name="sugar_level" placeholder="e.g., 6.2" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition" required>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2">Body Temperature (&deg;F)</label>
                            <input type="text" name="body_temperature" placeholder="e.g., 98.4" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition" required>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2">Pulse Rate (bpm)</label>
                            <input type="number" name="pulse_rate" placeholder="e.g., 72" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition" required>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2">Oxygen Saturation (%)</label>
                            <input type="number" name="oxygen_saturation" placeholder="e.g., 98" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition" required>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2">Overall Condition</label>
                            <select name="medical_condition" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition" required>
                                <option value="">-- Select --</option>
                                <option value="Stable">Stable</option>
                                <option value="Critical">Critical</option>
                                <option value="Under Observation">Under Observation</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-2 border-b border-gray-100 pb-4 mb-6">
                            <span class="text-lg">📉</span>
                            <h2 class="text-base font-bold text-[#1E4C56]">Daily Activities</h2>
                        </div>

                        <div class="space-y-4">
                            @php
                            $activities = [
                            'act_breakfast' => 'Breakfast',
                            'act_morning_walk' => 'Morning Walk',
                            'act_lunch' => 'Lunch',
                            'act_medication' => 'Medication Taken',
                            'act_physical_therapy' => 'Physical Therapy',
                            'act_dinner' => 'Dinner',
                            'act_sleep_routine' => 'Sleep Routine'
                            ];
                            @endphp

                            @foreach($activities as $key => $label)
                            <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                                <span class="text-xs font-medium text-gray-700">{{ $label }}</span>
                                <div class="flex items-center space-x-4">
                                    <label class="inline-flex items-center space-x-1.5 cursor-pointer text-xs text-gray-600">
                                        <input type="radio" name="{{ $key }}" value="Done" class="accent-[#1E4C56]" required>
                                        <span>Done</span>
                                    </label>
                                    <label class="inline-flex items-center space-x-1.5 cursor-pointer text-xs text-gray-600">
                                        <input type="radio" name="{{ $key }}" value="Skipped" class="accent-[#1E4C56]">
                                        <span>Skipped</span>
                                    </label>
                                    <label class="inline-flex items-center space-x-1.5 cursor-pointer text-xs text-gray-600">
                                        <input type="radio" name="{{ $key }}" value="Partial" class="accent-[#1E4C56]">
                                        <span>Partial</span>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            <label class="block text-xs font-semibold text-gray-600 mb-2">Staff Notes</label>
                            <textarea name="staff_notes" rows="3" placeholder="Any observations about the resident today..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition"></textarea>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4 mt-8 pt-4 border-t border-gray-100">
                        <button type="submit" class="px-5 py-2.5 bg-[#D1884F] text-white rounded-xl text-xs font-bold shadow-sm hover:bg-[#b8733b] transition cursor-pointer">
                            ✓ Save Health Record
                        </button>
                        <a href="{{ route('staff.dashboard') }}" class="text-xs font-bold text-gray-400 hover:text-gray-600 transition">
                            Cancel
                        </a>
                    </div>
                </div>

            </div>
        </form>
    </main>

</body>

</html>