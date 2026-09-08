@extends('layouts.admin')
@section('content')

<!-- Header -->
<div class="mb-8">
    <h1 class="text-2xl font-bold text-[#1E4C56]">Admin Dashboard</h1>
    <p class="text-sm text-gray-500 mt-1">Overview — Old Age Home, June 2026</p>
</div>

<!-- 1. TOP STATS GRID -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <!-- Card: Total Residents -->
    <a href="{{ route('admin.manage_residents') }}" class="block bg-white rounded-2xl p-6 border border-gray-100 border-l-4 border-l-[#2D5A66] shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex items-center space-x-4">
            <div class="p-4 bg-[#2D5A66] text-white rounded-xl text-xl">👥</div>
            <div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalResidents }}</h3>
                <p class="text-sm font-medium text-gray-500">Total Residents</p>
            </div>
        </div>
    </a>

    <!-- Card: Active Staff -->
    <a href="{{ route('admin.manage_staff') }}" class="block bg-white rounded-2xl p-6 border border-gray-100 border-l-4 border-l-[#B87333] shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex items-center space-x-4">
            <div class="p-4 bg-[#B87333] text-white rounded-xl text-xl">🛡</div>
            <div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $activeStaff }}</h3>
                <p class="text-sm font-medium text-gray-500">Active Staff</p>
            </div>
        </div>
    </a>

    <!-- Card: Registered Donors -->
    <a href="{{ route('admin.donations.index') }}" class="block bg-white rounded-2xl p-6 border border-gray-100 border-l-4 border-l-[#108A56] shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex items-center space-x-4">
            <div class="p-4 bg-[#108A56] text-white rounded-xl text-xl">💚</div>
            <div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $registeredDonors }}</h3>
                <p class="text-sm font-medium text-gray-500">Registered Donors</p>
            </div>
        </div>
    </a>

    <!-- Card: Emergencies -->
    <a href="{{ route('admin.emergency_reports') }}" class="block bg-white rounded-2xl p-6 border border-gray-100 border-l-4 border-l-[#E53E3E] shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex items-center space-x-4">
            <div class="p-4 bg-[#E53E3E] text-white rounded-xl text-xl">⚠️</div>
            <div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $emergencies }}</h3>
                <p class="text-sm font-medium text-gray-500">Emergencies</p>
            </div>
        </div>
    </a>

</div>

<!-- 2. LOWER SECTIONS: SPLIT GRID -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

    <!-- LEFT COLUMN: RECENT RESIDENTS -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col justify-between">
        <div>
            <h2 class="text-lg font-bold text-[#1E4C56] mb-4">Recent Residents</h2>
            <div class="space-y-3">

                @forelse($recentResidents as $resident)
                @php
                $condition = $resident->medical_condition ?? $resident->health_status ?? 'Stable';

                $badgeClass = match($condition) {
                'Critical' => 'bg-rose-50 text-rose-700 border border-rose-200',
                'Recovering' => 'bg-amber-50 text-amber-700 border border-amber-200',
                default => 'bg-green-50 text-green-700 border border-green-200',
                };
                @endphp
                <!-- Resident Item -->
                <div class="flex items-center justify-between p-2.5 hover:bg-gray-50 rounded-xl transition border border-transparent hover:border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full bg-[#2D5A66]/10 text-[#2D5A66] font-bold flex items-center justify-center text-sm">
                            {{ strtoupper(substr($resident->name, 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm text-gray-800">{{ $resident->name }}</h4>
                            <p class="text-xs text-gray-400">Room {{ $resident->room_number ?? 'N/A' }} • Age {{ $resident->age ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 {{ $badgeClass }} rounded-full text-xs font-semibold">{{ $condition }}</span>
                </div>
                @empty
                <p class="text-sm text-gray-400 py-4 text-center">No recent residents found.</p>
                @endforelse

            </div>
        </div>
        <a href="{{ route('admin.manage_residents') }}" class="text-xs font-bold text-[#D1884F] hover:underline mt-6 block">View All Residents →</a>
    </div>

    <!-- RIGHT COLUMN: PENDING APPROVALS -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col justify-between">
        <div>
            <h2 class="text-lg font-bold text-[#1E4C56] mb-4">Pending Approvals</h2>
            <div class="space-y-3">

                @forelse($pendingApprovals as $approval)
                <!-- Pending Item -->
                <div class="flex items-center justify-between p-2.5 hover:bg-gray-50 rounded-xl transition border border-transparent hover:border-gray-100">
                    <div>
                        <h4 class="font-semibold text-sm text-gray-800">{{ $approval->name }}</h4>
                        <p class="text-xs text-gray-400">{{ ucfirst($approval->role) }} • Applied {{ $approval->created_at ? $approval->created_at->format('Y-m-d') : 'Today' }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <form action="{{ route('admin.approvals.action', $approval->id) }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="w-8 h-8 rounded-full bg-green-50 hover:bg-green-100 text-green-600 font-bold text-sm flex items-center justify-center transition border border-green-200">✓</button>
                        </form>
                        <form action="{{ route('admin.approvals.action', $approval->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="w-8 h-8 rounded-full bg-red-50 hover:bg-red-100 text-red-600 font-bold text-sm flex items-center justify-center transition border border-red-200">✕</button>
                        </form>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-400 py-4 text-center">✨ No pending registration requests found.</p>
                @endforelse

            </div>
        </div>
        <a href="{{ route('admin.approvals') }}" class="text-xs font-bold text-[#D1884F] hover:underline mt-6 block">Manage All Approvals →</a>
    </div>

</div>
@endsection