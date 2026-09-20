@extends('layouts.admin')

@section('title', 'Community Members')

@section('content')
<div class="p-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-1">Community Members</h1>
    <p class="text-gray-500 mb-6">View details of donors, family members, and volunteers.</p>

    <!-- Tabs -->
    <div class="flex space-x-2 mb-6 border-b border-gray-200">
        <button onclick="showTab('donors')" id="tab-btn-donors"
            class="px-4 py-2 font-medium text-sm border-b-2 border-[#1E4C56] text-[#1E4C56]">
            Donors ({{ $donors->count() }})
        </button>
        <button onclick="showTab('family')" id="tab-btn-family"
            class="px-4 py-2 font-medium text-sm border-b-2 border-transparent text-gray-500 hover:text-gray-700">
            Family Members ({{ $family->count() }})
        </button>
        <button onclick="showTab('volunteers')" id="tab-btn-volunteers"
            class="px-4 py-2 font-medium text-sm border-b-2 border-transparent text-gray-500 hover:text-gray-700">
            Volunteers ({{ $volunteers->count() }})
        </button>
    </div>

    <!-- Donors Tab -->
    <div id="tab-donors" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-[#F8F6F0] text-gray-500 text-xs font-semibold uppercase tracking-wider">
                    <th class="px-6 py-4 text-left">Name</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">Phone</th>
                    <th class="px-6 py-4 text-left">Address</th>
                    <th class="px-6 py-4 text-left">Total Donations</th>
                    <th class="px-6 py-4 text-left">Joined</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($donors as $donor)
                <tr>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $donor->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $donor->email }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $donor->phone ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $donor->address ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $donor->donation_count }} ({{ $donor->donation_types }})</td>
                    <td class="px-6 py-4 text-gray-500">{{ $donor->created_at->format('d M, Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">No approved donors yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Family Tab -->
    <div id="tab-family" class="hidden bg-white rounded-2xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-[#F8F6F0] text-gray-500 text-xs font-semibold uppercase tracking-wider">
                    <th class="px-6 py-4 text-left">Name</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">Phone</th>
                    <th class="px-6 py-4 text-left">Address</th>
                    <th class="px-6 py-4 text-left">Linked Resident</th>
                    <th class="px-6 py-4 text-left">Joined</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($family as $member)
                <tr>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $member->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $member->email }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $member->phone ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $member->address ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $member->linked_resident }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $member->created_at->format('d M, Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">No approved family members yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Volunteers Tab -->
    <div id="tab-volunteers" class="hidden bg-white rounded-2xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-[#F8F6F0] text-gray-500 text-xs font-semibold uppercase tracking-wider">
                    <th class="px-6 py-4 text-left">Name</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">Phone</th>
                    <th class="px-6 py-4 text-left">Address</th>
                    <th class="px-6 py-4 text-left">Tasks Completed</th>
                    <th class="px-6 py-4 text-left">Hours This Month</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($volunteers as $volunteer)
                <tr>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $volunteer->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $volunteer->email }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $volunteer->phone ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $volunteer->address ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $volunteer->tasks_completed }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $volunteer->hours_this_month }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">No approved volunteers yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function showTab(tab) {
        ['donors', 'family', 'volunteers'].forEach(function(t) {
            document.getElementById('tab-' + t).classList.toggle('hidden', t !== tab);
            document.getElementById('tab-btn-' + t).classList.toggle('border-[#1E4C56]', t === tab);
            document.getElementById('tab-btn-' + t).classList.toggle('text-[#1E4C56]', t === tab);
            document.getElementById('tab-btn-' + t).classList.toggle('border-transparent', t !== tab);
            document.getElementById('tab-btn-' + t).classList.toggle('text-gray-500', t !== tab);
        });
    }
</script>
@endsection