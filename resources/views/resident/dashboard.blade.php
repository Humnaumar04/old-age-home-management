@extends('layouts.resident')
@section('content')
<div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- PROFILE CARD -->
    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm text-center">
        <div class="w-24 h-24 bg-gray-100 rounded-full mx-auto mb-6 flex items-center justify-center text-3xl">👤</div>
        <h2 class="text-xl font-bold text-[#1E4C56]">{{ $resident->name }}</h2>
        <p class="text-gray-500 text-sm">Room {{ $resident->room_number }} • Age {{ $resident->age }}</p>

        <!-- Dynamic Medical Condition Badge -->
        @php
        $condition = $resident->medical_condition ?? 'Stable';
        if ($condition == 'Critical') {
        $badgeClass = 'bg-rose-100 text-rose-700 border-rose-200';
        } elseif ($condition == 'Under Observation') {
        $badgeClass = 'bg-amber-100 text-amber-700 border-amber-200';
        } else {
        $badgeClass = 'bg-emerald-100 text-emerald-700 border-emerald-200';
        }
        @endphp
        <span class="inline-block mt-3 px-4 py-1 text-xs rounded-full font-bold border {{ $badgeClass }}">
            {{ $condition }}
        </span>

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
            <div class="flex justify-between items-start py-3">
                <span class="text-gray-500">Assigned Staff</span>
                <div class="text-right">
                    <p class="font-bold text-gray-800">{{ $resident->doctor_name ?? 'N/A' }}</p>
                    <p class="text-xs text-gray-400 italic mt-1">For reference only</p>
                </div>
            </div>
        </div>
    </div>

    <!-- VITALS & ACTIVITIES -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Vitals -->
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <h3 class="font-bold text-[#1E4C56] mb-6">Today's Health Vitals</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                <!-- Blood Pressure -->
                <div class="bg-gray-50 p-4 rounded-xl text-center">
                    <p class="text-lg mb-1">⚡</p>
                    <p class="text-xl font-bold text-gray-800">
                        @if(isset($latestVitals))
                        {{ $latestVitals->bp_systolic }}/{{ $latestVitals->bp_diastolic }}
                        @else
                        130/85
                        @endif
                    </p>
                    <p class="text-xs text-gray-500">Blood Pressure</p>
                </div>

                <!-- Blood Sugar -->
                <div class="bg-gray-50 p-4 rounded-xl text-center">
                    <p class="text-lg mb-1">💧</p>
                    <p class="text-xl font-bold text-gray-800">
                        {{ $latestVitals->sugar_level ?? '6.0' }} <span class="text-xs font-normal">mmol/L</span>
                    </p>
                    <p class="text-xs text-gray-500">Blood Sugar</p>
                </div>

                <!-- Temperature -->
                <div class="bg-gray-50 p-4 rounded-xl text-center">
                    <p class="text-lg mb-1">🌡️</p>
                    <p class="text-xl font-bold text-gray-800">
                        {{ $latestVitals->body_temperature ?? '98.4' }} <span class="text-xs font-normal">°F</span>
                    </p>
                    <p class="text-xs text-gray-500">Temperature</p>
                </div>
            </div>
        </div>

        <!-- Activities -->
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <h3 class="font-bold text-[#1E4C56] mb-6">Daily Activities</h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                <!-- Breakfast -->
                @php
                $val = $activities->breakfast ?? '';
                $bgClass = $val == 'Done' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : ($val == 'Partial' ? 'bg-gray-100 text-gray-700 border-gray-200' : ($val == 'Skipped' ? 'bg-rose-50 text-rose-700 border-rose-200' : 'bg-gray-50 text-gray-700 border-gray-100'));
                @endphp
                <div class="p-4 rounded-xl text-center border {{ $bgClass }}">
                    <p class="text-2xl mb-1">🍳</p>
                    <p class="text-xs opacity-75 mb-1 font-medium">Breakfast</p>
                    <p class="text-sm font-bold">{{ $val ?: 'N/A' }}</p>
                </div>

                <!-- Morning Walk -->
                @php
                $val = $activities->morning_walk ?? '';
                $bgClass = $val == 'Done' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : ($val == 'Partial' ? 'bg-gray-100 text-gray-700 border-gray-200' : ($val == 'Skipped' ? 'bg-rose-50 text-rose-700 border-rose-200' : 'bg-gray-50 text-gray-700 border-gray-100'));
                @endphp
                <div class="p-4 rounded-xl text-center border {{ $bgClass }}">
                    <p class="text-2xl mb-1">🚶</p>
                    <p class="text-xs opacity-75 mb-1 font-medium">Morning Walk</p>
                    <p class="text-sm font-bold">{{ $val ?: 'N/A' }}</p>
                </div>

                <!-- Medication -->
                @php
                $val = $activities->medication_taken ?? '';
                $bgClass = $val == 'Done' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : ($val == 'Partial' ? 'bg-gray-100 text-gray-700 border-gray-200' : ($val == 'Skipped' ? 'bg-rose-50 text-rose-700 border-rose-200' : 'bg-gray-50 text-gray-700 border-gray-100'));
                @endphp
                <div class="p-4 rounded-xl text-center border {{ $bgClass }}">
                    <p class="text-2xl mb-1">💊</p>
                    <p class="text-xs opacity-75 mb-1 font-medium">Medication</p>
                    <p class="text-sm font-bold">{{ $val ?: 'N/A' }}</p>
                </div>

                <!-- Lunch -->
                @php
                $val = $activities->lunch ?? '';
                $bgClass = $val == 'Done' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : ($val == 'Partial' ? 'bg-gray-100 text-gray-700 border-gray-200' : ($val == 'Skipped' ? 'bg-rose-50 text-rose-700 border-rose-200' : 'bg-gray-50 text-gray-700 border-gray-100'));
                @endphp
                <div class="p-4 rounded-xl text-center border {{ $bgClass }}">
                    <p class="text-2xl mb-1">🥗</p>
                    <p class="text-xs opacity-75 mb-1 font-medium">Lunch</p>
                    <p class="text-sm font-bold">{{ $val ?: 'N/A' }}</p>
                </div>

                <!-- Physical Therapy -->
                @php
                $val = $activities->physical_therapy ?? '';
                $bgClass = $val == 'Done' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : ($val == 'Partial' ? 'bg-gray-100 text-gray-700 border-gray-200' : ($val == 'Skipped' ? 'bg-rose-50 text-rose-700 border-rose-200' : 'bg-gray-50 text-gray-700 border-gray-100'));
                @endphp
                <div class="p-4 rounded-xl text-center border {{ $bgClass }}">
                    <p class="text-2xl mb-1">🧘</p>
                    <p class="text-xs opacity-75 mb-1 font-medium">Physio</p>
                    <p class="text-sm font-bold">{{ $val ?: 'N/A' }}</p>
                </div>

                <!-- Dinner -->
                @php
                $val = $activities->dinner ?? '';
                $bgClass = $val == 'Done' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : ($val == 'Partial' ? 'bg-gray-100 text-gray-700 border-gray-200' : ($val == 'Skipped' ? 'bg-rose-50 text-rose-700 border-rose-200' : 'bg-gray-50 text-gray-700 border-gray-100'));
                @endphp
                <div class="p-4 rounded-xl text-center border {{ $bgClass }}">
                    <p class="text-2xl mb-1">🍲</p>
                    <p class="text-xs opacity-75 mb-1 font-medium">Dinner</p>
                    <p class="text-sm font-bold">{{ $val ?: 'N/A' }}</p>
                </div>

                <!-- Sleep Routine -->
                @php
                $val = $activities->sleep_routine ?? '';
                $bgClass = $val == 'Done' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : ($val == 'Partial' ? 'bg-gray-100 text-gray-700 border-gray-200' : ($val == 'Skipped' ? 'bg-rose-50 text-rose-700 border-rose-200' : 'bg-gray-50 text-gray-700 border-gray-100'));
                @endphp
                <div class="p-4 rounded-xl text-center border {{ $bgClass }}">
                    <p class="text-2xl mb-1">😴</p>
                    <p class="text-xs opacity-75 mb-1 font-medium">Sleep</p>
                    <p class="text-sm font-bold">{{ $val ?: 'N/A' }}</p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection