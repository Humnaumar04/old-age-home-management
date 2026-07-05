<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Residents - Old Age Home</title>
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
                <a href="#" class="flex items-center space-x-3 bg-[#2A6673] px-4 p-3 rounded-xl font-medium transition">
                    <span>👤</span> <span>Manage Residents</span>
                </a>
                <a href="/admin/manage-complaints" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>📋</span> <span>Manage Complaints & Requests</span>
                </a>
                <a href="{{ route('admin.approvals') }}" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>📋</span> <span>Approvals & Reports</span>
                </a>
            </nav>
        </div>

        <!-- Logout Link -->
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

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 overflow-y-auto p-8">

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-[#1E4C56] mb-1">Manage Residents</h1>
                <p class="text-sm text-gray-500">All admitted elderly residents — view, update, or discharge</p>
            </div>
            <!-- Admit Resident Button -->
            <a href="{{ route('admin.add_resident') }}" class="bg-[#1E4C56] hover:bg-[#15353d] text-white px-5 py-2.5 rounded-xl font-semibold flex items-center space-x-2 shadow-sm transition">
                <span>➕</span> <span>Admit Resident</span>
            </a>
        </div>

        <!-- Residents Table Card (Figma Design Matches Here) -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#F3EFE6] text-gray-600 text-sm font-semibold uppercase tracking-wider">
                        <th class="p-4 text-center w-16">#</th>
                        <th class="p-4">Name</th>
                        <th class="p-4 text-center">Age</th>
                        <th class="p-4">Room</th>
                        <th class="p-4">Condition</th>
                        <th class="p-4">BP</th>
                        <th class="p-4">Sugar</th>
                        <th class="p-4">Admitted</th>
                        <th class="p-4 text-center w-40">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-xs text-gray-600 divide-y divide-gray-50/50">
                    @forelse($residents as $index => $resident)
                    <tr class="hover:bg-gray-50/40 transition">
                        <td class="px-6 py-4 text-center text-gray-400 font-medium">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-bold text-gray-800">{{ $resident->name }}</td>
                        <td class="px-6 py-4 font-medium text-gray-500">{{ $resident->age }}</td>
                        <td class="px-6 py-4 font-medium text-gray-500">{{ $resident->room_number }}</td>
                        <td class="px-6 py-4">
                            @if($resident->medical_condition == 'Stable')
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-[#E8F8F5] text-[#2ECC71]">Stable</span>
                            @elseif($resident->medical_condition == 'Critical')
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-[#FDEDEC] text-[#E74C3C]">Critical</span>
                            @else
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-[#FEF5E7] text-[#F39C12]">{{ $resident->medical_condition }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-400">{{ $resident->bp_systolic }}/{{ $resident->bp_diastolic }}</td>
                        <td class="px-6 py-4 font-medium text-gray-400">{{ $resident->sugar_level }}</td>
                        <td class="px-6 py-4 font-medium text-gray-400">{{ $resident->date_of_admission }}</td>
                        <td class="px-6 py-4 text-center space-x-3 whitespace-nowrap">
                            <a href="{{ route('admin.residents.edit', $resident->id) }}"
                                class="text-blue-600 hover:text-blue-800 font-medium transition text-xs">
                                Edit
                            </a>

                            <form action="{{ route('admin.residents.destroy', $resident->id) }}"
                                method="POST" class="inline-block"
                                onsubmit="return confirm('Are you sure you want to delete this resident?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-1.5 rounded-lg font-medium text-xs">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-10 text-center text-gray-400 font-medium bg-white">
                            No residents admitted yet. Click "+ Admit Resident" to add one!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>

</html>