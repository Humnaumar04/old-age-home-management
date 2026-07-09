<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - Old Age Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                <a href="#" class="flex items-center space-x-3 bg-[#2A6673] px-4 p-3 rounded-xl font-medium transition">
                    <span>📊</span> <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
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

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-[#1E4C56]">Staff Dashboard</h1>
            <p class="text-sm text-gray-500 mt-1">Overview — Resident Health Records</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center space-x-4">
                <div class="p-4 bg-[#2D5A66] text-white rounded-xl text-xl">👥</div>
                <div>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $totalResidents }}</h3>
                    <p class="text-sm font-medium text-gray-500">Total Residents</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center space-x-4">
                <div class="p-4 bg-[#108A56] text-white rounded-xl text-xl">📈</div>
                <div>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $updatedToday }}</h3>
                    <p class="text-sm font-medium text-gray-500">Updated Today</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center space-x-4">
                <div class="p-4 bg-[#E53E3E] text-white rounded-xl text-xl">⚠️</div>
                <div>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $criticalCases }}</h3>
                    <p class="text-sm font-medium text-gray-500">Critical Cases</p>
                </div>
            </div>

        </div>

        <!-- 3. ALL RESIDENTS TABLE AREA (With Live Search Feature) -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col" x-data="{ search: '' }">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-4 border-b border-gray-100 gap-4 mb-4">
                <h2 class="text-lg font-bold text-[#1E4C56]">All Residents</h2>
                <div class="relative w-full sm:w-64">
                    <!-- Search Input bound to AlpineJS variable -->
                    <input type="text"
                        x-model="search"
                        placeholder="Search resident..."
                        class="w-full pl-4 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs font-semibold uppercase tracking-wider text-gray-400 border-b border-gray-100 bg-gray-50/50">
                            <th class="py-3 px-4">Name</th>
                            <th class="py-3 px-4">Room</th>
                            <th class="py-3 px-4">Condition</th>
                            <th class="py-3 px-4">BP</th>
                            <th class="py-3 px-4">Last Updated</th>
                            <th class="py-3 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                        @forelse($residents as $resident)
                        <!-- Table row gets filtered instantly based on type -->
                        <tr class="hover:bg-gray-50/50 transition"
                            x-show="'{{ strtolower($resident->name) }}'.includes(search.toLowerCase()) || '{{ strtolower($resident->room_number ?? '') }}'.includes(search.toLowerCase())">
                            <td class="py-4 px-4 font-semibold text-gray-800">{{ $resident->name }}</td>
                            <td class="py-4 px-4 text-gray-500">Room {{ $resident->room_number ?? 'N/A' }}</td>
                            <td class="py-4 px-4">
                                @if(strtolower($resident->medical_condition ?? '') == 'critical')
                                <span class="px-2.5 py-1 bg-red-50 text-red-700 rounded-full text-xs font-semibold">Critical</span>
                                @else
                                <span class="px-2.5 py-1 bg-green-50 text-green-700 rounded-full text-xs font-semibold">{{ $resident->medical_condition ?? 'Stable' }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-gray-500">
                                @if($resident->bp_systolic && $resident->bp_diastolic)
                                {{ $resident->bp_systolic }}/{{ $resident->bp_diastolic }}
                                @else
                                N/A
                                @endif
                            </td>
                            <td class="py-4 px-4 text-gray-400">
                                {{ $resident->updated_at ? $resident->updated_at->diffForHumans() : 'N/A' }}
                            </td>
                            <td class="py-4 px-4">
                                <a href="{{ route('staff.update_health', $resident->id) }}" class="text-[#D1884F] font-bold hover:underline text-xs">
                                    Update Health →
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-sm text-gray-400 py-6 text-center">
                                ✨ No residents registered in the database yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>

</html>