@extends('layouts.volunteer')

@section('title', 'Volunteer Dashboard')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">

    <!-- Top Greeting Section -->
    <div>
        <h2 class="text-2xl font-bold text-[#14434C]">Volunteer Activities</h2>
        <p class="text-sm text-gray-600 mt-1">Welcome, {{ Auth::user()->name ?? $volunteer->name }}! Here are today's sessions where your help is needed.</p>
    </div>

    <!-- Top 3 Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs flex items-center space-x-4">
            <div class="w-12 h-12 bg-[#14434C] text-white rounded-xl flex items-center justify-center text-xl">👥</div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $attentionResidents->count() }}</h3>
                <p class="text-xs text-gray-500">Residents to Help</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs flex items-center space-x-4">
            <div class="w-12 h-12 bg-amber-600 text-white rounded-xl flex items-center justify-center text-xl">⭐</div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $volunteer->hours_this_month ?? 24 }}h</h3>
                <p class="text-xs text-gray-500">Hours This Month</p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs flex items-center space-x-4">
            <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center text-xl">✓</div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $volunteer->tasks_completed ?? 18 }}</h3>
                <p class="text-xs text-gray-500">Tasks Completed</p>
            </div>
        </div>
    </div>

    <!-- Lower Grid Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Left 2 Columns: Task List -->
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-200 shadow-xs space-y-5">
            <h3 class="text-lg font-bold text-[#14434C]">Task List — {{ date('F d, Y') }}</h3>

            <div class="space-y-3">
                @forelse($tasks as $task)
                @php
                $isCompleted = ($task->status ?? 'Pending') == 'Completed';
                $isCommon = str_contains($task->title, '(Common)');

                // Task Date calculation
                $taskDate = isset($task->date) ? \Carbon\Carbon::parse($task->date) : \Carbon\Carbon::today();

                // Extract End Time from time_slot string (e.g., "12:00 PM - 1:00 PM")
                $timeSlot = $task->time_slot ?? '9:00 AM';
                if (str_contains($timeSlot, '-')) {
                $parts = explode('-', $timeSlot);
                $endTimeStr = trim(end($parts));
                } else {
                $endTimeStr = trim($timeSlot);
                }

                try {
                $taskEndTime = \Carbon\Carbon::parse($taskDate->format('Y-m-d') . ' ' . $endTimeStr);
                } catch (\Exception $e) {
                $taskEndTime = $taskDate->copy()->endOfDay();
                }

                $now = \Carbon\Carbon::now();
                $isExpired = !$isCompleted && $now->gt($taskEndTime);
                $hideThreshold = $taskEndTime->copy()->addHours(24);
                $shouldHide = $now->gt($hideThreshold);
                @endphp

                @if(!$shouldHide)
                <div class="p-4 rounded-xl border {{ $isCompleted ? 'border-emerald-100 bg-emerald-50/40' : ($isExpired ? 'border-rose-100 bg-rose-50/30' : 'border-gray-200 bg-white') }} flex items-center justify-between transition">
                    <div class="flex items-center space-x-3">
                        <span class="{{ $isCompleted ? 'text-emerald-600' : ($isExpired ? 'text-rose-500' : 'text-gray-400') }} text-lg">
                            @if($isCompleted)
                            ✅
                            @elseif($isExpired)
                            ❌
                            @else
                            ⭕
                            @endif
                        </span>
                        <div>
                            <div class="flex items-center space-x-2">
                                <p class="text-sm font-semibold {{ $isCompleted ? 'line-through text-gray-400' : ($isExpired ? 'text-gray-600' : 'text-gray-800') }}">
                                    {{ $task->title }}
                                </p>

                                <!-- Common Task vs Personal Task Badge -->
                                @if($isCommon)
                                <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-blue-100 text-blue-700">Common Task</span>
                                @else
                                <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-purple-100 text-purple-700">Personal Task</span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500">⏰ {{ $task->time_slot ?? '9:00 AM' }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons / Badges -->
                    <div>
                        @if($isCompleted)
                        <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-700">
                            Done ✓
                        </span>
                        @elseif($isExpired)
                        <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-rose-100 text-rose-700">
                            Expired
                        </span>
                        @elseif(isset($task->id))
                        <form action="{{ route('volunteer.completeTask', $task->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-1.5 bg-[#1E4C56] hover:bg-[#163a42] text-white text-xs font-semibold rounded-lg transition shadow-xs cursor-pointer">
                                Mark Done
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @endif
                @empty
                <p class="text-sm text-gray-500 text-center py-4">No tasks scheduled for today.</p>
                @endforelse
            </div>
        </div>

        <!-- Right 1 Column: Residents Needing Attention & My Stats -->
        <div class="space-y-6">

            <!-- Residents Needing Attention -->
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs space-y-4">
                <h3 class="text-lg font-bold text-[#14434C]">Residents Needing Attention</h3>

                <div class="space-y-4">
                    @forelse($attentionResidents as $res)
                    @php
                    $cond = $res->medical_condition ?? 'Critical';
                    $badgeColor = $cond == 'Critical' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700';
                    @endphp
                    <div class="flex justify-between items-center border-b border-gray-100 pb-3 last:border-none last:pb-0">
                        <div>
                            <p class="text-sm font-bold text-gray-800">{{ $res->name }}</p>
                            <p class="text-xs text-gray-500">Room {{ $res->room_number ?? 'A-101' }}</p>
                        </div>
                        <span class="px-2.5 py-1 text-[10px] font-bold rounded-full {{ $badgeColor }}">{{ $cond }}</span>
                    </div>
                    @empty
                    <p class="text-xs text-gray-500">No residents currently needing attention.</p>
                    @endforelse
                </div>
            </div>

            <!-- My Stats Card (Dark Teal Box) -->
            <div class="bg-[#14434C] text-white p-6 rounded-2xl shadow-xs space-y-5">
                <h3 class="text-lg font-bold">My Stats</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-[#1E5C67] p-4 rounded-xl">
                        <p class="text-xl font-bold">{{ $volunteer->sessions_attended ?? 12 }}</p>
                        <p class="text-[11px] text-gray-300">Sessions Attended</p>
                    </div>
                    <div class="bg-[#1E5C67] p-4 rounded-xl">
                        <p class="text-xl font-bold">{{ $volunteer->hours_this_month ?? 24 }}h</p>
                        <p class="text-[11px] text-gray-300">Total Hours</p>
                    </div>
                    <div class="bg-[#1E5C67] p-4 rounded-xl">
                        <p class="text-xl font-bold">{{ $volunteer->residents_helped ?? 31 }}</p>
                        <p class="text-[11px] text-gray-300">Residents Helped</p>
                    </div>
                    <div class="bg-[#1E5C67] p-4 rounded-xl">
                        <p class="text-xl font-bold">{{ $volunteer->tasks_completed ?? 8 }}</p>
                        <p class="text-[11px] text-gray-300">Activities Led</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection