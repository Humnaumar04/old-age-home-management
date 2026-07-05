@extends('layouts.app')

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Emergency Reports List</h2>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-200">
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Resident Name</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Emergency Type</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Severity</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                <tr class="border-b border-gray-200">
                    <td class="px-5 py-4 text-sm">{{ $report->resident->name ?? 'N/A' }}</td>
                    <td class="px-5 py-4 text-sm">{{ $report->emergency_type }}</td>
                    <td class="px-5 py-4 text-sm">{{ $report->severity_level }}</td>
                    <td class="px-5 py-4 text-sm">{{ $report->created_at }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-5 py-4 text-center text-gray-500">No emergency reports found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection