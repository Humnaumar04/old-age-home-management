@extends('layouts.admin')
@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-[#1E4C56]">Family Care Communication</h1>
    <p class="text-sm text-gray-500 mt-1">Select a family member to view and reply to their messages.</p>
</div>

<div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
    <div class="space-y-4">
        @forelse($families as $family)
        <div class="flex items-center justify-between p-4 hover:bg-gray-50 rounded-xl border border-gray-100 transition relative">
            <div class="flex items-center space-x-3">
                <!-- User Avatar with Unread Indicator Dot -->
                <div class="relative">
                    <div class="w-10 h-10 rounded-full bg-[#1E4C56] text-white flex items-center justify-center font-bold">
                        {{ strtoupper(substr($family->name, 0, 1)) }}
                    </div>
                    @if($family->unread_count > 0)
                    <span class="absolute -top-1 -right-1 flex h-3.5 w-3.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-red-500 border-2 border-white"></span>
                    </span>
                    @endif
                </div>

                <div>
                    <div class="flex items-center gap-2">
                        <h4 class="font-semibold text-gray-800">{{ $family->name }}</h4>

                        <!-- Unread Count Badge -->
                        @if($family->unread_count > 0)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-500 text-white animate-pulse">
                            {{ $family->unread_count }} New
                        </span>
                        @endif
                    </div>

                    <p class="text-xs text-gray-400">{{ $family->email }}</p>

                    <!-- Resident ka naam -->
                    @if($family->resident)
                    <span class="inline-block mt-1 px-2 py-0.5 bg-blue-50 text-[#1E4C56] text-xs font-semibold rounded-md">
                        Resident: {{ $family->resident->name }}
                    </span>
                    @else
                    <span class="inline-block mt-1 px-2 py-0.5 bg-gray-100 text-gray-400 text-xs rounded-md">
                        Resident: Not Assigned
                    </span>
                    @endif
                </div>
            </div>

            <a href="{{ route('admin.communication.chat', $family->id) }}" class="px-4 py-2 bg-[#1E4C56] text-white text-xs font-bold rounded-xl hover:bg-[#15343c] transition flex items-center gap-1">
                Open Chat
                @if($family->unread_count > 0)
                <span class="w-2 h-2 rounded-full bg-red-400"></span>
                @endif
                →
            </a>
        </div>
        @empty
        <p class="text-sm text-gray-400 py-4 text-center">✨ No family messages found yet.</p>
        @endforelse
    </div>
</div>
@endsection