@extends('layouts.staff')
@section('content')

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
    @endsection