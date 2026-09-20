@extends('layouts.donor')
@section('content')

<!-- Top Header & Donate Now Button -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-[#1E4C56]">Current Requirements</h1>
        <p class="text-sm text-gray-500 mt-1">What the Old Age Home needs right now — every contribution makes a difference</p>
    </div>
    <a href="{{ route('donor.make-donation') }}" class="px-5 py-2.5 bg-[#D1884F] hover:bg-[#b8733a] text-white font-semibold rounded-xl text-sm transition shadow-sm flex items-center space-x-2">
        <span>❤️</span> <span>Donate Now</span>
    </a>
</div>

<!-- Summary Cards Section -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-10">
    <!-- Food Card -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm text-center relative">
        <span class="inline-block px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-xs font-semibold mb-2">Food</span>
        <h3 class="text-2xl font-bold text-gray-800">{{ $foodCount }}</h3>
        <p class="text-xs text-gray-400 mt-1">items needed</p>
    </div>
    <!-- Clothes Card -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm text-center relative">
        <span class="inline-block px-3 py-1 bg-purple-50 text-purple-600 rounded-full text-xs font-semibold mb-2">Clothes</span>
        <h3 class="text-2xl font-bold text-gray-800">{{ $clothesCount }}</h3>
        <p class="text-xs text-gray-400 mt-1">item needed</p>
    </div>
    <!-- Medicine Card -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm text-center relative">
        <span class="inline-block px-3 py-1 bg-red-50 text-red-500 rounded-full text-xs font-semibold mb-2">Medicine</span>
        <h3 class="text-2xl font-bold text-gray-800">{{ $medicineCount }}</h3>
        <p class="text-xs text-gray-400 mt-1">item needed</p>
    </div>
    <!-- Money Card -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm text-center relative">
        <span class="inline-block px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-semibold mb-2">Money</span>
        <h3 class="text-2xl font-bold text-gray-800">{{ $moneyCount }}</h3>
        <p class="text-xs text-gray-400 mt-1">item needed</p>
    </div>
</div>

<!-- All Requirements Table -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-x-auto p-2">
    <div class="px-6 py-4 border-b border-gray-100">
        <h2 class="font-bold text-lg text-[#1E4C56]">All Requirements</h2>
    </div>
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="text-xs text-gray-400 uppercase border-b border-gray-100 bg-gray-50/50">
                <th class="p-4 font-semibold">Item</th>
                <th class="p-4 font-semibold">Category</th>
                <th class="p-4 font-semibold">Quantity Needed</th>
                <th class="p-4 font-semibold">Urgency</th>
                <th class="p-4 font-semibold">Status</th>
                <th class="p-4 font-semibold text-right">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm">
            @forelse($requirements as $req)
            <tr>
                <td class="p-4 font-semibold text-gray-800">{{ $req->item_name }}</td>
                <td class="p-4"><span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-semibold">{{ $req->category }}</span></td>
                <td class="p-4 text-gray-600">{{ $req->quantity_needed }}</td>
                <td class="p-4">
                    <span class="px-3 py-1 
                @if($req->urgency == 'High') bg-red-50 text-red-500 
                @elseif($req->urgency == 'Medium') bg-yellow-50 text-yellow-600 
                @else bg-green-50 text-green-600 @endif 
                rounded-full text-xs font-semibold">
                        {{ $req->urgency }}
                    </span>
                </td>
                <td class="p-4 text-gray-500">{{ $req->status }}</td>
                <td class="p-4 text-right">
                    <a href="{{ route('donor.make-donation') }}?category={{ urlencode($req->category) }}&item_name={{ urlencode($req->item_name) }}&quantity={{ urlencode($req->quantity_needed) }}"
                        class="px-4 py-2 bg-[#D1884F] hover:bg-[#b8733a] text-white text-xs font-semibold rounded-xl transition shadow-sm inline-block">
                        ♥ Donate This
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-6 text-center text-gray-500">No requirements found at the moment.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection