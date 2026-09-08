@extends('layouts.admin')

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Emergency Reports List</h2>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-200">
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Resident Name</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Emergency Type</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Severity</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Time</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                    <th class="px-5 py-3 text-right text-xs font-semibold text-gray-600 uppercase">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                <tr class="border-b border-gray-200">
                    <td class="px-5 py-4 text-sm">{{ $report->resident->name ?? 'N/A' }}</td>
                    <td class="px-5 py-4 text-sm">{{ $report->emergency_type }}</td>
                    <td class="px-5 py-4 text-sm">{{ $report->severity_level }}</td>
                    <td class="px-5 py-4 text-sm">{{ $report->created_at }}</td>
                    <td class="px-5 py-4 text-sm">
                        @if($report->status == 'Resolved')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Resolved
                        </span>
                        @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Pending
                        </span>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-sm text-right">
                        @if($report->status != 'Resolved')
                        <form action="{{ route('admin.emergency.resolve', $report->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-xs">
                                Mark as Resolved
                            </button>
                        </form>
                        @else
                        <span class="text-green-600 text-xs font-semibold">✓ Completed</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-4 text-center text-gray-500">No emergency reports found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection