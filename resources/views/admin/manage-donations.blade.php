@extends('layouts.admin')
@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-[#1E4C56]">Donations Management</h1>
    <p class="text-sm text-gray-500">Select an option below to manage requirements or view incoming donations.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Card 1: Manage Requirements -->
    <a href="{{ route('admin.donations.requirements') }}" class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition group">
        <div class="w-12 h-12 bg-[#1E4C56]/10 rounded-xl flex items-center justify-center text-[#1E4C56] font-bold text-xl mb-4 group-hover:bg-[#1E4C56] group-hover:text-white transition">📦</div>
        <h3 class="text-lg font-semibold text-[#1E4C56] mb-2">Manage Donation Requirements</h3>
        <p class="text-sm text-gray-500">Add, edit, or remove items that the old age home currently needs from donors.</p>
    </a>

    <!-- Card 2: View Donations -->
    <a href="{{ route('admin.donations.received') }}" class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition group">
        <div class="w-12 h-12 bg-[#1E4C56]/10 rounded-xl flex items-center justify-center text-[#1E4C56] font-bold text-xl mb-4 group-hover:bg-[#1E4C56] group-hover:text-white transition">❤️</div>
        <h3 class="text-lg font-semibold text-[#1E4C56] mb-2">View Received Donations</h3>
        <p class="text-sm text-gray-500">Track and review all donations submitted by registered donors.</p>
    </a>
</div>
</main>
</div>
@endsection