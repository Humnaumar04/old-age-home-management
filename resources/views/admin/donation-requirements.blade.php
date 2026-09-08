@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-[#1E4C56]">Manage Donation Requirements</h1>
            <p class="text-sm text-gray-500">Add and manage items or funds needed for the old age home.</p>
        </div>
        <a href="{{ route('admin.donations.index') }}" class="text-sm bg-gray-200 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-300">Back</a>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm">
        {{ session('success') }}
    </div>
    @endif

    <!-- Add Requirement Form Card -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-8">
        <h3 class="text-lg font-semibold text-[#1E4C56] mb-4">Add New Requirement</h3>

        <form action="{{ route('admin.donations.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf

            <!-- Category Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Category *</label>
                <select name="category" id="category_select" onchange="handleCategoryChange()" required class="w-full border-gray-300 rounded-xl p-2.5 focus:border-[#1E4C56] focus:ring-[#1E4C56]">
                    <option value="">-- Select Category --</option>
                    <option value="Food">Food</option>
                    <option value="Medicine">Medicine</option>
                    <option value="Clothes">Clothes</option>
                    <option value="Money">Money</option>
                </select>
            </div>

            <!-- Item Name / Fund Title -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1" id="name_label">Item Name *</label>
                <input type="text" name="item_name" id="name_input" required placeholder="e.g. Rice, Blankets" class="w-full border-gray-300 rounded-xl p-2.5 focus:border-[#1E4C56] focus:ring-[#1E4C56]">
            </div>

            <!-- Quantity Needed / Target Amount -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1" id="quantity_label">Quantity Needed *</label>
                <input type="text" name="quantity_needed" id="quantity_input" required placeholder="e.g. 50 kg, 20 packets" class="w-full border-gray-300 rounded-xl p-2.5 focus:border-[#1E4C56] focus:ring-[#1E4C56]">
            </div>

            <!-- Urgency -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Urgency *</label>
                <select name="urgency" class="w-full border-gray-300 rounded-xl p-2.5 focus:border-[#1E4C56] focus:ring-[#1E4C56]">
                    <option value="Normal">Normal</option>
                    <option value="High">High</option>
                    <option value="Critical">Critical</option>
                </select>
            </div>

            <input type="hidden" name="status" value="Active">

            <div class="md:col-span-2 flex justify-end">
                <button type="submit" class="bg-[#1E4C56] text-white px-6 py-2.5 rounded-xl font-medium hover:bg-[#16383f] transition">
                    Add Requirement
                </button>
            </div>
        </form>
    </div>

    <!-- Current Requirements Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-6">
        <h3 class="text-lg font-semibold text-[#1E4C56] mb-4">Current Requirements List</h3>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b text-gray-400 text-sm">
                    <th class="py-3 px-4">Item / Fund Title</th>
                    <th class="py-3 px-4">Category</th>
                    <th class="py-3 px-4">Quantity / Amount</th>
                    <th class="py-3 px-4">Urgency</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requirements as $req)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4 font-medium">{{ $req->item_name }}</td>
                    <td class="py-3 px-4">
                        <span class="px-2.5 py-1 text-xs rounded-full 
                                {{ $req->category == 'Money' || $req->category == 'Money / Fund' ? 'bg-amber-100 text-amber-700 font-semibold' : 'bg-gray-100 text-gray-700' }}">
                            {{ $req->category }}
                        </span>
                    </td>
                    <td class="py-3 px-4">{{ $req->quantity_needed }}</td>
                    <td class="py-3 px-4">
                        <span class="px-2.5 py-1 text-xs rounded-full 
                                {{ $req->urgency == 'Critical' ? 'bg-red-100 text-red-600 font-semibold' : ($req->urgency == 'High' ? 'bg-orange-100 text-orange-600' : 'bg-blue-100 text-blue-600') }}">
                            {{ $req->urgency }}
                        </span>
                    </td>
                    <td class="py-3 px-4">{{ $req->status }}</td>
                    <td class="py-3 px-4 text-center">
                        <form action="{{ url('/admin/donations/requirements/' . $req->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this requirement?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold rounded-lg border border-red-200 transition flex items-center gap-1 mx-auto shadow-sm">
                                <span>🗑️</span> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-6 text-center text-gray-400">No requirements found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        handleCategoryChange();
    });

    function handleCategoryChange() {
        const category = document.getElementById('category_select').value;
        const nameLabel = document.getElementById('name_label');
        const nameInput = document.getElementById('name_input');
        const qtyLabel = document.getElementById('quantity_label');
        const qtyInput = document.getElementById('quantity_input');

        if (category === 'Money' || category === 'Money / Fund') {
            nameLabel.innerText = 'Fund Title *';
            nameInput.placeholder = 'e.g. Monthly Utility Bills, Medical Fund';

            qtyLabel.innerText = 'Target Amount (PKR) *';
            qtyInput.placeholder = 'e.g. 25000';
        } else {
            nameLabel.innerText = 'Item Name *';
            nameInput.placeholder = 'e.g. Rice, Blankets';

            qtyLabel.innerText = 'Quantity Needed *';
            qtyInput.placeholder = 'e.g. 50 kg, 20 packets';
        }
    }
</script>
@endpush
@endsection