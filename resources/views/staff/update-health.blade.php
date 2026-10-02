@extends('layouts.staff')
@section('content')

```
{{-- Validation Errors --}}
@if ($errors->any())
<div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
    <div class="flex items-start">
        <span class="text-red-600 mr-2">⚠️</span>
        <div>
            <p class="text-sm font-bold text-red-700">
                Please correct the following errors:
            </p>

            <ul class="mt-2 text-xs text-red-600 list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif

{{-- Database / Transaction Error --}}
@if (session('error'))
<div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
    <div class="flex items-center">
        <span class="text-red-600 mr-2">❌</span>
        <p class="text-sm font-semibold text-red-700">
            {{ session('error') }}
        </p>
    </div>
</div>
@endif

{{-- Success Message --}}
@if (session('success'))
<div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4">
    <div class="flex items-center">
        <span class="text-green-600 mr-2">✓</span>
        <p class="text-sm font-semibold text-green-700">
            {{ session('success') }}
        </p>
    </div>
</div>
@endif


{{-- PAGE HEADER --}}
<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-2xl font-bold text-[#1E4C56]">
            Update Health —
            <span class="text-gray-800">
                {{ $resident->name ?? 'Muhammad Aslam' }}
            </span>
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Room {{ $resident->room_number ?? 'A-239' }} &bull;
            Condition:

            @if(strtolower($resident->medical_condition ?? '') == 'critical')

            <span class="px-2 py-0.5 bg-red-50 text-red-700 rounded-full text-xs font-semibold">
                Critical
            </span>

            @else

            <span class="px-2 py-0.5 bg-green-50 text-green-700 rounded-full text-xs font-semibold">
                {{ $resident->medical_condition ?? 'Stable' }}
            </span>

            @endif
        </p>
    </div>


    <a href="{{ route('staff.dashboard') }}"
        class="px-4 py-2 border border-gray-200 rounded-xl text-xs font-bold text-gray-700 bg-white hover:bg-gray-50 transition shadow-sm">

        &larr; Back to Dashboard

    </a>

</div>


{{-- FORM --}}
<form action="{{ route('staff.save_health', $resident->id) }}"
    method="POST"
    class="space-y-6">

    @csrf


    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">


        {{-- ========================= --}}
        {{-- VITAL SIGNS --}}
        {{-- ========================= --}}

        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">

            <div class="flex items-center space-x-2 border-b border-gray-100 pb-4 mb-6">

                <span class="text-lg">🌡️</span>

                <h2 class="text-base font-bold text-[#1E4C56]">
                    Vital Signs
                </h2>

            </div>


            <div class="space-y-5">


                {{-- BLOOD PRESSURE --}}
                <div>

                    <label class="block text-xs font-semibold text-gray-600 mb-2">
                        Blood Pressure (mmHg)
                    </label>

                    <div class="grid grid-cols-2 gap-3">


                        {{-- Systolic --}}
                        <div>

                            <input type="number"
                                name="bp_systolic"
                                value="{{ old('bp_systolic') }}"
                                placeholder="Systolic"
                                class="w-full px-4 py-2.5 bg-gray-50 border {{ $errors->has('bp_systolic') ? 'border-red-400' : 'border-gray-200' }} rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition">

                            @error('bp_systolic')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>


                        {{-- Diastolic --}}
                        <div>

                            <input type="number"
                                name="bp_diastolic"
                                value="{{ old('bp_diastolic') }}"
                                placeholder="Diastolic"
                                class="w-full px-4 py-2.5 bg-gray-50 border {{ $errors->has('bp_diastolic') ? 'border-red-400' : 'border-gray-200' }} rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition">

                            @error('bp_diastolic')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- BLOOD SUGAR --}}
                <div>

                    <label class="block text-xs font-semibold text-gray-600 mb-2">
                        Blood Sugar (mmol/L)
                    </label>

                    <input type="text"
                        name="sugar_level"
                        value="{{ old('sugar_level') }}"
                        placeholder="e.g., 6.2"
                        class="w-full px-4 py-2.5 bg-gray-50 border {{ $errors->has('sugar_level') ? 'border-red-400' : 'border-gray-200' }} rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition">

                    @error('sugar_level')
                    <p class="mt-1 text-xs text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- BODY TEMPERATURE --}}
                <div>

                    <label class="block text-xs font-semibold text-gray-600 mb-2">
                        Body Temperature (&deg;F)
                    </label>

                    <input type="text"
                        name="body_temperature"
                        value="{{ old('body_temperature') }}"
                        placeholder="e.g., 98.4"
                        class="w-full px-4 py-2.5 bg-gray-50 border {{ $errors->has('body_temperature') ? 'border-red-400' : 'border-gray-200' }} rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition">

                    @error('body_temperature')
                    <p class="mt-1 text-xs text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- PULSE RATE --}}
                <div>

                    <label class="block text-xs font-semibold text-gray-600 mb-2">
                        Pulse Rate (bpm)
                    </label>

                    <input type="number"
                        name="pulse_rate"
                        value="{{ old('pulse_rate') }}"
                        placeholder="e.g., 72"
                        class="w-full px-4 py-2.5 bg-gray-50 border {{ $errors->has('pulse_rate') ? 'border-red-400' : 'border-gray-200' }} rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition">

                    @error('pulse_rate')
                    <p class="mt-1 text-xs text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- OXYGEN SATURATION --}}
                <div>

                    <label class="block text-xs font-semibold text-gray-600 mb-2">
                        Oxygen Saturation (%)
                    </label>

                    <input type="number"
                        name="oxygen_saturation"
                        value="{{ old('oxygen_saturation') }}"
                        placeholder="e.g., 98"
                        class="w-full px-4 py-2.5 bg-gray-50 border {{ $errors->has('oxygen_saturation') ? 'border-red-400' : 'border-gray-200' }} rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition">

                    @error('oxygen_saturation')
                    <p class="mt-1 text-xs text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- OVERALL CONDITION --}}
                <div>

                    <label class="block text-xs font-semibold text-gray-600 mb-2">
                        Overall Condition
                    </label>

                    <select name="medical_condition"
                        class="w-full px-4 py-2.5 bg-gray-50 border {{ $errors->has('medical_condition') ? 'border-red-400' : 'border-gray-200' }} rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition">

                        <option value="">
                            -- Select --
                        </option>

                        <option value="Stable"
                            {{ old('medical_condition') == 'Stable' ? 'selected' : '' }}>
                            Stable
                        </option>

                        <option value="Critical"
                            {{ old('medical_condition') == 'Critical' ? 'selected' : '' }}>
                            Critical
                        </option>

                        <option value="Under Observation"
                            {{ old('medical_condition') == 'Under Observation' ? 'selected' : '' }}>
                            Under Observation
                        </option>

                    </select>

                    @error('medical_condition')
                    <p class="mt-1 text-xs text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

            </div>

        </div>



        {{-- ========================= --}}
        {{-- DAILY ACTIVITIES --}}
        {{-- ========================= --}}

        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col justify-between">

            <div>

                <div class="flex items-center space-x-2 border-b border-gray-100 pb-4 mb-6">

                    <span class="text-lg">📉</span>

                    <h2 class="text-base font-bold text-[#1E4C56]">
                        Daily Activities
                    </h2>

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

                        <span class="text-xs font-medium text-gray-700">
                            {{ $label }}
                        </span>


                        <div class="flex items-center space-x-4">


                            {{-- DONE --}}
                            <label class="inline-flex items-center space-x-1.5 cursor-pointer text-xs text-gray-600">

                                <input type="radio"
                                    name="{{ $key }}"
                                    value="Done"
                                    class="accent-[#1E4C56]"
                                    {{ old($key) == 'Done' ? 'checked' : '' }}
                                    required>

                                <span>
                                    Done
                                </span>

                            </label>


                            {{-- SKIPPED --}}
                            <label class="inline-flex items-center space-x-1.5 cursor-pointer text-xs text-gray-600">

                                <input type="radio"
                                    name="{{ $key }}"
                                    value="Skipped"
                                    class="accent-[#1E4C56]"
                                    {{ old($key) == 'Skipped' ? 'checked' : '' }}>

                                <span>
                                    Skipped
                                </span>

                            </label>


                            {{-- PARTIAL --}}
                            <label class="inline-flex items-center space-x-1.5 cursor-pointer text-xs text-gray-600">

                                <input type="radio"
                                    name="{{ $key }}"
                                    value="Partial"
                                    class="accent-[#1E4C56]"
                                    {{ old($key) == 'Partial' ? 'checked' : '' }}>

                                <span>
                                    Partial
                                </span>

                            </label>

                        </div>

                    </div>


                    {{-- Activity Error --}}
                    @error($key)

                    <p class="text-xs text-red-600 -mt-2">
                        {{ $message }}
                    </p>

                    @enderror

                    @endforeach

                </div>


                {{-- STAFF NOTES --}}
                <div class="mt-6">

                    <label class="block text-xs font-semibold text-gray-600 mb-2">
                        Staff Notes
                    </label>

                    <textarea name="staff_notes"
                        rows="3"
                        placeholder="Any observations about the resident today..."
                        class="w-full px-4 py-2.5 bg-gray-50 border {{ $errors->has('staff_notes') ? 'border-red-400' : 'border-gray-200' }} rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-teal-500 focus:bg-white transition">{{ old('staff_notes') }}</textarea>

                    @error('staff_notes')

                    <p class="mt-1 text-xs text-red-600">
                        {{ $message }}
                    </p>

                    @enderror

                </div>

            </div>


            {{-- BUTTONS --}}
            <div class="flex items-center space-x-4 mt-8 pt-4 border-t border-gray-100">

                <button type="submit"
                    class="px-5 py-2.5 bg-[#D1884F] text-white rounded-xl text-xs font-bold shadow-sm hover:bg-[#b8733b] transition cursor-pointer">

                    ✓ Save Health Record

                </button>


                <a href="{{ route('staff.dashboard') }}"
                    class="text-xs font-bold text-gray-400 hover:text-gray-600 transition">

                    Cancel

                </a>

            </div>

        </div>

    </div>

</form>
```

@endsection