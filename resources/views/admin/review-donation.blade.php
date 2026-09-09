@extends('layouts.admin')
@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6">

            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <h2 class="text-2xl font-bold text-gray-800">Review Donation Details</h2>
                <a href="{{ route('admin.donations.received') }}" class="text-sm bg-gray-200 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-300">Back</a>
            </div>

            <!-- Donation Details Card -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 bg-gray-50 p-6 rounded-2xl border">
                <div>
                    <p class="text-sm text-gray-500">Donor Name</p>
                    <p class="text-base font-semibold text-gray-800">{{ $donation->user->name ?? 'Guest' }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Donor Email</p>
                    <p class="text-base font-semibold text-gray-800">{{ $donation->user->email ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Donation Type</p>
                    <p class="text-base font-semibold text-indigo-600">{{ $donation->donation_type }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Amount / Item Details</p>
                    <p class="text-base font-semibold text-gray-800">
                        @if($donation->donation_type == 'Money')
                        Rs. {{ $donation->amount }}
                        @else
                        {{ $donation->item_name ?? 'N/A' }} (Quantity: {{ $donation->quantity }})
                        @endif
                    </p>
                </div>

                @if($donation->donation_type == 'Money')
                <div>
                    <p class="text-sm text-gray-500">Payment Method</p>
                    <p class="text-base font-semibold text-gray-800">{{ $donation->payment_method ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Transaction ID / Reference</p>
                    <p class="text-base font-semibold text-gray-800">{{ $donation->transaction_id ?? 'N/A' }}</p>
                </div>
                @else
                <div>
                    <p class="text-sm text-gray-500">Pickup / Delivery Method</p>
                    <p class="text-base font-semibold text-gray-800">{{ $donation->delivery_method ?? 'N/A' }}</p>
                </div>
                @endif

                <div class="md:col-span-2">
                    <p class="text-sm text-gray-500">Current Status</p>
                    <span class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-semibold 
                            {{ $donation->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                        {{ $donation->status }}
                    </span>
                </div>
            </div>

            <!-- Status Update Form -->
            <form action="{{ route('admin.donations.update-status', $donation->id) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Update Donation Status</label>
                    <select name="status" class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="Pending" {{ $donation->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Approved" {{ $donation->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Rejected" {{ $donation->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="Rejected" {{ $donation->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-indigo-700 transition">
                        Save Changes
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection