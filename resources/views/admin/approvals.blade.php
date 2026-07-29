@extends('layouts.admin')
@section('content')

        @if(session('success'))
        <div class="w-full mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl text-sm font-semibold shadow-sm">
            <div class="flex items-center space-x-2">
                <span>✅</span>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="w-full mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl text-sm font-semibold shadow-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Approvals & Reports</h1>
            <p class="text-sm text-gray-500 mt-1">Manage registrations and download system reports</p>
        </div>

        <div class="flex gap-3 mb-6">
            <button onclick="showTab('pending')" id="tab-pending"
                class="px-6 py-2.5 rounded-full text-sm font-semibold bg-[#1E4C56] text-white transition">
                Pending Approvals
            </button>
            <button onclick="showTab('reports')" id="tab-reports"
                class="px-6 py-2.5 rounded-full text-sm font-semibold border border-gray-300 text-gray-600 bg-white transition">
                System Reports
            </button>
        </div>

        <div id="section-pending">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-[#F8F6F0] text-gray-500 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-6 py-4 text-left">Name</th>
                            <th class="px-6 py-4 text-left">Type</th>
                            <th class="px-6 py-4 text-left">Email</th>
                            <th class="px-6 py-4 text-left">Date Applied</th>
                            <th class="px-6 py-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($pendingApprovals as $user)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $user->name }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ ucfirst($user->role) }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $user->email }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $user->phone ?? 'N/A' }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                <div class="flex space-x-2">

                                    <form action="{{ route('admin.approvals.action', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition shadow-sm">
                                            Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.approvals.action', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to reject this request?')">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition shadow-sm">
                                            Reject
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500 font-medium">
                                ✨ No pending registration requests found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SYSTEM REPORTS TAB (Figma Design Cards) -->
        <div id="section-reports" class="hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- CARD 1: Monthly Resident Report -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-start space-x-4">
                    <div class="p-3 bg-[#F8F6F0] rounded-xl text-xl flex items-center justify-center w-12 h-12">📄</div>
                    <div class="flex-1">
                        <h3 class="font-bold text-lg text-[#1E4C56]">Monthly Resident Report</h3>
                        <p class="text-sm text-gray-500 mt-1">Health status, activities, and incidents for June 2026</p>
                        <p class="text-xs text-gray-400 mt-2">Generated: Jun 1, 2026</p>
                        <a href="#" class="inline-block mt-4 bg-[#F8F6F0] hover:bg-gray-200 text-[#1E4C56] font-semibold text-xs px-4 py-2 rounded-lg border border-gray-200 transition">
                            Download PDF
                        </a>
                    </div>
                </div>

                <!-- CARD 2: Staff Attendance Report -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-start space-x-4">
                    <div class="p-3 bg-[#F8F6F0] rounded-xl text-xl flex items-center justify-center w-12 h-12">📄</div>
                    <div class="flex-1">
                        <h3 class="font-bold text-lg text-[#1E4C56]">Staff Attendance Report</h3>
                        <p class="text-sm text-gray-500 mt-1">Shift-wise attendance and leave records — all staff</p>
                        <p class="text-xs text-gray-400 mt-2">Generated: Jun 1, 2026</p>
                        <a href="#" class="inline-block mt-4 bg-[#F8F6F0] hover:bg-gray-200 text-[#1E4C56] font-semibold text-xs px-4 py-2 rounded-lg border border-gray-200 transition">
                            Download PDF
                        </a>
                    </div>
                </div>

                <!-- CARD 3: Donation & Funding Report -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-start space-x-4">
                    <div class="p-3 bg-[#F8F6F0] rounded-xl text-xl flex items-center justify-center w-12 h-12">📄</div>
                    <div class="flex-1">
                        <h3 class="font-bold text-lg text-[#1E4C56]">Donation & Funding Report</h3>
                        <p class="text-sm text-gray-500 mt-1">Total donations received, categories, and pending needs</p>
                        <p class="text-xs text-gray-400 mt-2">Generated: Jun 1, 2026</p>
                        <a href="#" class="inline-block mt-4 bg-[#F8F6F0] hover:bg-gray-200 text-[#1E4C56] font-semibold text-xs px-4 py-2 rounded-lg border border-gray-200 transition">
                            Download PDF
                        </a>
                    </div>
                </div>

                <!-- CARD 4: Emergency Incidents Report -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-start space-x-4">
                    <div class="p-3 bg-[#F8F6F0] rounded-xl text-xl flex items-center justify-center w-12 h-12">📄</div>
                    <div class="flex-1">
                        <h3 class="font-bold text-lg text-[#1E4C56]">Emergency Incidents Report</h3>
                        <p class="text-sm text-gray-500 mt-1">All emergency cases logged this month with outcomes</p>
                        <p class="text-xs text-gray-400 mt-2">Generated: Jun 1, 2026</p>
                        <a href="#" class="inline-block mt-4 bg-[#F8F6F0] hover:bg-gray-200 text-[#1E4C56] font-semibold text-xs px-4 py-2 rounded-lg border border-gray-200 transition">
                            Download PDF
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <script>
        function showTab(tab) {
            document.getElementById('section-pending').classList.add('hidden');
            document.getElementById('section-reports').classList.add('hidden');

            document.getElementById('tab-pending').className = 'px-6 py-2.5 rounded-full text-sm font-semibold border border-gray-300 text-gray-600 bg-white transition';
            document.getElementById('tab-reports').className = 'px-6 py-2.5 rounded-full text-sm font-semibold border border-gray-300 text-gray-600 bg-white transition';

            document.getElementById('section-' + tab).classList.remove('hidden');
            document.getElementById('tab-' + tab).className = 'px-6 py-2.5 rounded-full text-sm font-semibold bg-[#1E4C56] text-white transition';
        }
    </script>

@endsection