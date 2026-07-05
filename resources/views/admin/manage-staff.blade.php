<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff - Old Age Home</title>
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

    <!-- 1. SIDEBAR (Same as Dashboard) -->
    <aside class="w-64 bg-[#1E4C56] text-white flex flex-col justify-between p-6">
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
                <a href="#" class="flex items-center space-x-3 bg-[#2A6673] px-4 p-3 rounded-xl font-medium transition">
                    <span>👥</span> <span>Manage Staff</span>
                </a>
                <a href="{{ route('admin.manage_residents') }}" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
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

    <!-- 2. MAIN CONTENT AREA -->
    <main class="flex-1 overflow-y-auto p-8">

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-[#1E4C56] mb-1">Manage Staff</h1>
                <p class="text-sm text-gray-500">View, add, update, and remove staff members</p>
            </div>
            <!-- Add Staff Button -->
            <a href="{{ route('admin.add_staff') }}" class="bg-[#1E4C56] hover:bg-[#15353d] text-white px-5 py-2.5 rounded-xl font-semibold flex items-center space-x-2 shadow-sm transition">
                <span>➕</span> <span>Add Staff</span>
            </a>
        </div>

        <!-- Staff Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#F3EFE6] text-gray-600 text-sm font-semibold uppercase tracking-wider">
                        <th class="p-4 text-center w-16">#</th>
                        <th class="p-4">Name</th>
                        <th class="p-4">Designation</th>
                        <th class="p-4">Shift</th>
                        <th class="p-4">Phone</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center w-40">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($staffMembers as $index => $staff)
                    <tr class="hover:bg-gray-50/70 transition">
                        <td class="p-4 text-center text-gray-400 font-medium">{{ $index + 1 }}</td>
                        <td class="p-4 font-semibold text-gray-900">{{ $staff->name }}</td>
                        <td class="p-4 text-gray-500">{{ $staff->designation }}</td>
                        <td class="p-4">{{ $staff->shift }}</td>
                        <td class="p-4 text-gray-600">{{ $staff->phone }}</td>
                        <td class="p-4">
                            <span class="px-3 py-1 font-semibold text-xs rounded-full 
                    {{ $staff->status == 'Active' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $staff->status }}
                            </span>
                        </td>
                        <td class="p-4 text-center flex justify-center space-x-3">
                            <a href="{{ route('admin.manage_staff.edit', $staff->id) }}" class="text-blue-600 hover:text-blue-800 font-medium transition text-xs pt-1.5 mr-3">
                                Edit
                            </a>
                            <form action="{{ route('admin.manage_staff.destroy', $staff->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this staff member?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1.5 rounded-lg font-medium text-xs transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <!-- Agar database mein koi staff nahi hoga to yeh message aayega -->
                    <tr>
                        <td colspan="7" class="p-8 text-center text-gray-400 font-medium">
                            No staff members found. Click "+ Add Staff" to add one!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>

</body>

</html>