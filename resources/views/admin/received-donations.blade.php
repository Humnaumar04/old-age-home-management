@extends('layouts.admin')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Received Donations Management</h2>
                <a href="{{ route('admin.donations.index') }}" class="text-sm bg-gray-200 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-300">Back</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50 text-gray-600 text-sm">
                            <th class="py-3 px-4">Donor Name</th>
                            <th class="py-3 px-4">Donation Type</th>
                            <th class="py-3 px-4">Amount / Item</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700">
                        @forelse($donations as $donation)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4 font-medium">{{ $donation->user->name ?? 'Guest' }}</td>
                            <td class="py-3 px-4 font-semibold text-indigo-600">{{ $donation->donation_type }}</td>
                            <td class="py-3 px-4">
                                @if($donation->donation_type == 'Money')
                                Rs. {{ $donation->amount }}
                                @else
                                {{ $donation->item_name ?? 'N/A' }} (Qty: {{ $donation->quantity }})
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                        {{ $donation->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $donation->status }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('admin.donations.review', $donation->id) }}"
                                    class="bg-indigo-600 text-white px-3 py-1.5 rounded-xl text-xs hover:bg-indigo-700">
                                    Review
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">No donations received yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection