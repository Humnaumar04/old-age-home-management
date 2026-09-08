@extends('layouts.donor')

@section('content')

<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-[#1E4C56]">My Donations</h1>
        <p class="text-sm text-gray-500 mt-1">A history of everything you've donated so far</p>
    </div>
    <a href="{{ route('donor.make-donation') }}" class="px-5 py-2.5 bg-[#D1884F] hover:bg-[#b8733a] text-white font-semibold rounded-xl text-sm transition shadow-sm flex items-center space-x-2">
        <span>❤️</span> <span>Donate Now</span>
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-2">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="text-xs text-gray-400 uppercase border-b border-gray-100 bg-gray-50/50">
                <th class="p-4 font-semibold">Date</th>
                <th class="p-4 font-semibold">Type</th>
                <th class="p-4 font-semibold">Amount / Item</th>
                <th class="p-4 font-semibold">Method</th>
                <th class="p-4 font-semibold">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm">
            @forelse($donations as $donation)
            <tr>
                <td class="p-4">{{ $donation->created_at->format('d M, Y') }}</td>
                <td class="p-4">{{ $donation->donation_type }}</td>
                <td class="p-4">
                    @if($donation->donation_type == 'Money')
                    PKR {{ number_format($donation->amount) }}
                    @else
                    {{ $donation->quantity }} {{ $donation->item_name }}
                    @endif
                </td>
                <td class="p-4">{{ $donation->payment_method ?? $donation->delivery_method ?? 'N/A' }}</td>
                <td class="p-4">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        @if($donation->status == 'Approved') bg-emerald-50 text-emerald-600
                        @elseif($donation->status == 'Rejected') bg-red-50 text-red-500
                        @else bg-amber-50 text-amber-600
                        @endif">
                        {{ $donation->status }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-8 text-center text-gray-400">You haven't made any donations yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection