@extends('layouts.admin')

@section('title', 'Volunteer Management')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">

    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-[#14434C]">Volunteer Management</h2>
            <p class="text-sm text-gray-600 mt-1">Monitor volunteers, view their activity status, and assign new tasks.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-xl relative">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Volunteers List Table -->
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-200 shadow-xs space-y-5">
            <h3 class="text-lg font-bold text-[#14434C]">Registered Volunteers</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 text-xs text-gray-500 uppercase">
                            <th class="pb-3">Name</th>
                            <th class="pb-3">Hours</th>
                            <th class="pb-3">Tasks Done</th>
                            <th class="pb-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($volunteers as $v)
                        <tr>
                            <td class="py-3 font-semibold text-gray-800">{{ $v->user->name ?? 'N/A' }}</td>
                            <td class="py-3 text-gray-600">{{ $v->hours_this_month ?? 0 }}h</td>
                            <td class="py-3 text-gray-600">{{ $v->tasks_completed ?? 0 }}</td>
                            <td class="py-3">
                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-700">Active</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500 text-xs">No volunteers registered yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Assign Task Form -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs space-y-5">
            <h3 class="text-lg font-bold text-[#14434C]">Assign Task</h3>

            <form action="{{ route('admin.assignTask') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Select Volunteer (Optional)</label>
                    <select name="volunteer_id" class="w-full p-2.5 text-sm border border-gray-300 rounded-xl focus:outline-none focus:border-[#1E4C56]">
                        <!-- Yeh option select karne se volunteer_id NULL (Common Task) save hogi -->
                        <option value="">-- All Volunteers (Common Task) --</option>
                        @foreach($volunteers as $v)
                        <option value="{{ $v->id }}">{{ $v->user->name ?? 'Unknown' }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Task Title</label>
                    <input type="text" name="title" required placeholder="e.g. Morning walk assistance" class="w-full p-2.5 text-sm border border-gray-300 rounded-xl focus:outline-none focus:border-[#1E4C56]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Time Slot</label>
                    <input type="text" name="time_slot" placeholder="e.g. 9:00 AM - 11:00 AM" class="w-full p-2.5 text-sm border border-gray-300 rounded-xl focus:outline-none focus:border-[#1E4C56]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Date</label>
                    <input type="date" name="date" required class="w-full p-2.5 text-sm border border-gray-300 rounded-xl focus:outline-none focus:border-[#1E4C56]">
                </div>
                <button type="submit" class="w-full bg-[#1E4C56] hover:bg-[#163840] text-white text-sm font-semibold py-2.5 rounded-xl transition shadow-sm">
                    Assign Task
                </button>
            </form>
        </div>
    </div>
</div>
@endsection