<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Old Age Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F8F6F0] text-gray-800 flex flex-col md:flex-row h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

    <!-- MOBILE TOP BAR -->
    <div class="md:hidden bg-[#1E4C56] text-white p-4 flex items-center justify-between shadow-md z-20">
        <div class="flex items-center space-x-3">
            <div class="p-2 bg-[#D1884F] rounded-xl text-white">❤️</div>
            <div>
                <h2 class="font-bold text-base leading-tight">Old Age Home</h2>
                <p class="text-[10px] text-teal-200">Management System</p>
            </div>
        </div>
        <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-2xl focus:outline-none">
            <span x-show="!sidebarOpen">☰</span>
            <span x-show="sidebarOpen">✕</span>
        </button>
    </div>

    <!-- SIDEBAR OVERLAY FOR MOBILE -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/50 z-30 md:hidden"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"></div>

    <!-- SIDEBAR -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed md:static inset-y-0 left-0 z-40 w-64 bg-[#1E4C56] text-white flex flex-col justify-between p-6 flex-shrink-0 overflow-y-auto transition-transform duration-300 ease-in-out md:translate-x-0">
        <div>
            <div class="hidden md:flex items-center space-x-3 mb-8">
                <div class="p-2 bg-[#D1884F] rounded-xl text-white">❤️</div>
                <div>
                    <h2 class="font-bold text-lg leading-tight">Old Age Home</h2>
                    <p class="text-xs text-teal-200">Management System</p>
                </div>
            </div>

            <div class="flex items-center space-x-3 mb-8 bg-[#255A66] p-3 rounded-xl">
                <div class="w-10 h-10 rounded-full bg-[#D1884F] flex items-center justify-center font-bold text-white">
                    @php
                    $name = auth()->user()->name ?? 'Donor';
                    $initials = preg_replace('/[^A-Z]/', '', ucwords(strtolower($name)));
                    echo substr($initials, 0, 2);
                    @endphp
                </div>
                <div>
                    <h4 class="font-semibold text-sm">{{ auth()->user()->name ?? 'Admin Name' }}</h4>
                    <p class="text-xs text-teal-300">Administrator</p>
                </div>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 p-3 rounded-xl font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#255A66] text-white shadow-sm' : 'text-teal-100 hover:bg-[#2A6673]' }}">
                    <span>📊</span> <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.manage_staff') }}" class="flex items-center space-x-3 px-4 p-3 rounded-xl font-medium transition {{ request()->routeIs('admin.manage_staff*') ? 'bg-[#255A66] text-white shadow-sm' : 'text-teal-100 hover:bg-[#2A6673]' }}">
                    <span>👥</span> <span>Manage Staff</span>
                </a>
                <a href="{{ route('admin.manage_residents') }}" class="flex items-center space-x-3 px-4 p-3 rounded-xl font-medium transition {{ request()->routeIs('admin.manage_residents*') ? 'bg-[#255A66] text-white shadow-sm' : 'text-teal-100 hover:bg-[#2A6673]' }}">
                    <span>👤</span> <span>Manage Residents</span>
                </a>
                <a href="/admin/manage-complaints" class="flex items-center space-x-3 px-4 p-3 rounded-xl font-medium transition {{ request()->is('admin/manage-complaints*') ? 'bg-[#255A66] text-white shadow-sm' : 'text-teal-100 hover:bg-[#2A6673]' }}">
                    <span>📋</span> <span>Manage Complaints & Requests</span>
                </a>
                <a href="{{ route('admin.donations.index') }}" class="flex items-center space-x-3 px-4 p-3 rounded-xl font-medium transition {{ request()->routeIs('admin.donations*') ? 'bg-[#255A66] text-white shadow-sm' : 'text-teal-100 hover:bg-[#2A6673]' }}">
                    <span>♥</span>
                    <span>Manage Donations</span>
                </a>
                <a href="{{ route('admin.communication') }}" class="flex items-center space-x-3 px-4 p-3 rounded-xl font-medium transition {{ request()->routeIs('admin.communication*') ? 'bg-[#255A66] text-white shadow-sm' : 'text-teal-100 hover:bg-[#2A6673]' }}">
                    <span>💬</span> <span>Manage Communication</span>
                </a>
                <a href="{{ route('admin.volunteer_management') }}" class="flex items-center space-x-3 px-4 p-3 rounded-xl font-medium transition {{ request()->routeIs('admin.volunteer_management*') ? 'bg-[#255A66] text-white shadow-sm' : 'text-teal-100 hover:bg-[#2A6673]' }}">
                    <span>🤝</span> <span>Volunteer Management</span>
                </a>
                <a href="{{ route('admin.approvals') }}" class="flex items-center space-x-3 px-4 p-3 rounded-xl font-medium transition {{ request()->routeIs('admin.approvals*') ? 'bg-[#255A66] text-white shadow-sm' : 'text-teal-100 hover:bg-[#2A6673]' }}">
                    <span>📋</span> <span>Approvals & Reports</span>
                </a>
                <a href="{{ route('admin.community_members') }}" class="flex items-center space-x-3 px-4 p-3 rounded-xl font-medium transition {{ request()->routeIs('admin.community_members*') ? 'bg-[#255A66] text-white shadow-sm' : 'text-teal-100 hover:bg-[#2A6673]' }}">
                    <span>🚹</span> <span>Community Members</span>
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

    <!-- PAGE CONTENT -->
    <main class="flex-1 overflow-y-auto overflow-x-auto p-4 md:p-8">
        @yield('content')
    </main>

</body>
@stack('scripts')

</html>