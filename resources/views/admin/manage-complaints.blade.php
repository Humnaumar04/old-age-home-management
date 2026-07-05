<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Complaints & Requests - Old Age Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F8F6F0] text-gray-800 flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#1E4C56] text-white flex flex-col justify-between p-6 flex-shrink-0">
        <div>
            <div class="flex items-center space-x-3 mb-8">
                <div class="p-2 bg-[#D1884F] rounded-xl text-white">❤️</div>
                <div>
                    <h2 class="font-bold text-lg leading-tight">Old Age Home</h2>
                    <p class="text-xs text-teal-200">Management System</p>
                </div>
            </div>

            <div class="flex items-center space-x-3 mb-8 bg-[#255A66] p-3 rounded-xl">
                <div class="w-10 h-10 rounded-full bg-teal-700 flex items-center justify-center font-bold">UG</div>
                <div>
                    <h4 class="font-semibold text-sm">{{ auth()->user()->name ?? 'Usman Ghani' }}</h4>
                    <p class="text-xs text-teal-300">Administrator</p>
                </div>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>📊</span> <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.manage_staff') }}" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>👥</span> <span>Manage Staff</span>
                </a>
                <a href="{{ route('admin.manage_residents') }}" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>👤</span> <span>Manage Residents</span>
                </a>
                <!-- Set Active State Color [#2A6673] to this link -->
                <a href="/admin/manage-complaints" class="flex items-center space-x-3 bg-[#2A6673] px-4 p-3 rounded-xl font-medium transition">
                    <span>📋</span> <span>Manage Complaints & Requests</span>
                </a>
                <a href="{{ route('admin.approvals') }}" class="flex items-center space-x-3 hover:bg-[#255A66] px-4 p-3 rounded-xl font-medium transition text-teal-100">
                    <span>📋</span> <span>Approvals & Reports</span>
                </a>
            </nav>
        </div>

        <!-- LOGOUT BUTTON -->
        <div>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex items-center space-x-3 hover:bg-red-900 px-4 p-3 rounded-xl font-medium transition text-red-200">
                <span>🚪</span> <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 overflow-y-auto p-8">

        <!-- Header Panel with Badge Triggers -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-[#1E4C56]">Manage Complaints & Requests</h1>
                <p class="text-sm text-gray-500 mt-1">Track, review, and manage resident grievances, medical help requests, and leave applications.</p>
            </div>
            <!-- Notification Indicators -->
            <div class="flex space-x-3 text-xs font-semibold">
                <!-- High-Priority Complaints -->
                <span class="px-3 py-1.5 bg-red-50 text-red-600 border border-red-200 rounded-full flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> {{ $highUrgency }} High-Priority Complaints
                </span>

                <!-- Urgent Requests (Emergency) -->
                <span class="px-3 py-1.5 bg-amber-50 text-amber-700 border border-amber-200 rounded-full flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span> {{ $urgentRequests }} Urgent Requests
                </span>
            </div>
        </div>

        <!-- FIGMA STATS OVERVIEW CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

            <!-- Total Complaints -->
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center space-x-3">
                <div class="w-12 h-12 rounded-xl bg-[#1E4C56] text-white font-bold flex items-center justify-center text-lg shrink-0">{{ $totalComplaints }}</div>
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase">Total Complaints</p>
                </div>
            </div>

            <!-- High Urgency -->
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center space-x-3">
                <div class="w-12 h-12 rounded-xl bg-red-600 text-white font-bold flex items-center justify-center text-lg shrink-0">{{ $highUrgency }}</div>
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase">High Urgency</p>
                </div>
            </div>

            <!-- Assistance Requests -->
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center space-x-3">
                <div class="w-12 h-12 rounded-xl bg-[#9E6233] text-white font-bold flex items-center justify-center text-lg shrink-0">{{ $totalRequests }}</div>
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase">Assistance Requests</p>
                </div>
            </div>

            <!-- Urgent / Critical -->
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center space-x-3">
                <div class="w-12 h-12 rounded-xl bg-rose-600 text-white font-bold flex items-center justify-center text-lg shrink-0">{{ $urgentRequests }}</div>
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase">Urgent / Critical</p>
                </div>
            </div>
        </div>

        <!-- MAIN DATA FILTER CONTAINER -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <!-- Filter Bar: Tabs Panel & Search Input -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <!-- Segmented Custom Filter Controller -->
                <div class="bg-gray-100 p-1.5 rounded-xl flex items-center space-x-1 self-start">
                    <button id="btn-complaints-tab" onclick="toggleActiveView('complaints')"
                        class="px-5 py-2 rounded-lg text-sm font-bold transition duration-200 bg-[#1E4C56] text-white shadow-sm">
                        Complaints <span class="ml-1.5 text-xs bg-white/20 px-2 py-0.5 rounded-full">{{ $complaints->count() }}</span>
                    </button>
                    <button id="btn-requests-tab" onclick="toggleActiveView('requests')"
                        class="px-5 py-2 rounded-lg text-sm font-bold transition duration-200 text-gray-600 hover:text-gray-900">
                        Assistance Requests <span class="ml-1.5 text-xs bg-gray-200 px-2 py-0.5 rounded-full">{{ $totalRequests }}</span>
                    </button>
                </div>
                <!-- Search Component -->
                <div class="relative w-full sm:w-64">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 text-sm">🔍</span>
                    <!-- Yahan id add karein -->
                    <input type="text" id="searchBox" placeholder="Search requests..." class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-xl text-sm ...">
                </div>
            </div>

            <!-- VIEW BLOCK 1: COMPLAINTS CONTAINER -->
            <div id="view-complaints" class="block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/70 text-gray-500 text-xs font-bold uppercase border-b border-gray-100">
                            <th class="p-4 w-12 text-center">#</th>
                            <th class="p-4">Resident Name</th>
                            <th class="p-4">Category</th>
                            <th class="p-4">Subject / Title</th>
                            <th class="p-4">Urgency</th>
                            <th class="p-4">Date Submitted</th>
                            <th class="p-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($complaints as $complaint)
                        <tr class="border-b border-gray-100">
                            <td class="p-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="p-4 text-sm font-medium text-gray-800">{{ $complaint->user->name }}</td>
                            <td class="p-4 text-sm text-red-500">{{ $complaint->category }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ $complaint->subject }}</td>
                            <td class="p-4 text-sm {{ $complaint->urgency == 'High' ? 'text-red-600' : 'text-blue-600' }}">
                                {{ $complaint->urgency }}
                            </td>
                            <td class="p-4 text-sm text-gray-500">{{ $complaint->created_at->format('Y-m-d') }}</td>
                            <td class="p-4 text-sm">
                                <button type="button"
                                    onclick="viewDetails(this)"
                                    data-id="{{ $complaint->id }}"
                                    class="text-teal-600 font-semibold hover:underline">
                                    View Details
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- VIEW BLOCK 2: ASSISTANCE REQUESTS CONTAINER -->
            <div id="view-requests" class="hidden overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/70 text-gray-500 text-xs font-bold uppercase border-b border-gray-100">
                            <th class="p-4 w-12 text-center">#</th>
                            <th class="p-4">Resident Name</th>
                            <th class="p-4">Request Type</th>
                            <th class="p-4">Details Summary</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y divide-gray-50">
                        @foreach($helpRequests as $request)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="p-4 text-center text-gray-400 font-medium">{{ $loop->iteration }}</td>
                            <td class="p-4 flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 text-xs">👤</div>
                                <span class="font-semibold text-gray-900">{{ $request->user->name ?? 'N/A' }}</span>
                            </td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-red-50 text-red-600">
                                    {{ $request->help_type }}
                                </span>
                            </td>
                            <td class="p-4 text-gray-500 font-medium">{{ $request->description }}</td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-blue-100 text-blue-800">
                                    {{ $request->status }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <form action="{{ route('admin.requests.update', $request->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="Approved">
                                        <button type="submit" class="px-4 py-1.5 bg-emerald-600 text-white font-semibold rounded-xl hover:bg-emerald-700 transition text-xs shadow-sm">✓ Approve</button>
                                    </form>
                                    <form action="{{ route('admin.requests.update', $request->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="Rejected">
                                        <button type="submit" class="px-4 py-1.5 border border-red-100 text-red-600 hover:bg-red-50 font-semibold rounded-xl transition text-xs">✕ Reject</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- TAB TENSION-FREE TOGGLE SCRIPT -->
    <script>
        function toggleActiveView(target) {
            const complaintsBtn = document.getElementById('btn-complaints-tab');
            const requestsBtn = document.getElementById('btn-requests-tab');
            const complaintsView = document.getElementById('view-complaints');
            const requestsView = document.getElementById('view-requests');

            if (target === 'complaints') {
                // Button management
                complaintsBtn.className = "px-5 py-2 rounded-lg text-sm font-bold transition duration-200 bg-[#1E4C56] text-white shadow-sm";
                requestsBtn.className = "px-5 py-2 rounded-lg text-sm font-bold transition duration-200 text-gray-600 hover:text-gray-900";

                // View Management
                complaintsView.classList.replace('hidden', 'block');
                requestsView.classList.replace('block', 'hidden');
            } else {
                // Button management
                requestsBtn.className = "px-5 py-2 rounded-lg text-sm font-bold transition duration-200 bg-[#1E4C56] text-white shadow-sm";
                complaintsBtn.className = "px-5 py-2 rounded-lg text-sm font-bold transition duration-200 text-gray-600 hover:text-gray-900";

                // View Management
                requestsView.classList.replace('hidden', 'block');
                complaintsView.classList.replace('block', 'hidden');
            }
        }
    </script>
    <!-- Updated Complaint Details Modal -->
    <div id="detailsModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white p-8 rounded-2xl w-full max-w-lg">
            <h2 class="text-xl font-bold mb-4 text-[#1E4C56]" id="modalTitle"></h2>

            <div class="space-y-3 text-sm text-gray-700 mb-6">
                <p><strong>Resident:</strong> <span id="modalResident"></span></p>
                <p><strong>Category:</strong> <span id="modalCategory"></span></p>
                <p><strong>Date:</strong> <span id="modalDate"></span></p>
                <hr>
                <p><strong>Details:</strong></p>
                <p id="modalDescription" class="text-gray-600 bg-gray-50 p-4 rounded-xl"></p>
            </div>

            <button onclick="closeModal()" class="w-full bg-[#1E4C56] text-white py-2 rounded-xl font-semibold hover:bg-[#255A66]">Close</button>
            <button id="resolveBtn" onclick="resolveComplaint()" class="w-full bg-emerald-600 text-white py-2 rounded-xl font-semibold hover:bg-emerald-700 mt-2">
                Mark as Resolved
            </button>
        </div>
    </div>

    <script>
        // Is variable mein current complaint ki ID store hogi
        let currentComplaintId = null;

        // Complaint ki details fetch karne aur modal dikhane ke liye
        function viewDetails(button) {
            currentComplaintId = button.getAttribute('data-id');

            fetch(`/admin/complaints/${currentComplaintId}`)
                .then(response => response.json())
                .then(data => {
                    // Modal ke elements mein data set karna
                    document.getElementById('modalTitle').innerText = data.subject;
                    document.getElementById('modalResident').innerText = data.user.name;
                    document.getElementById('modalCategory').innerText = data.category;
                    document.getElementById('modalDate').innerText = data.created_at.substring(0, 10);
                    document.getElementById('modalDescription').innerText = data.description;

                    // Modal ko show karna
                    document.getElementById('detailsModal').classList.remove('hidden');
                });
        }

        // Complaint ko Resolve status dene ke liye
        function resolveComplaint() {
            if (!currentComplaintId) return;

            fetch(`/admin/complaints/resolve/${currentComplaintId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Laravel security token
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    closeModal();
                    location.reload(); // Page refresh taake status update show ho
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Something went wrong!');
                });
        }

        // Modal band karne ke liye
        function closeModal() {
            document.getElementById('detailsModal').classList.add('hidden');
        }
    </script>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchBox');

        searchInput.addEventListener('keyup', function() {
            let searchTerm = this.value.toLowerCase();

            // Sirf wahi table dhundein jo display: block/none hai (Active Table)
            let activeTable = document.querySelector('#view-complaints:not(.hidden)') ||
                document.querySelector('#view-requests:not(.hidden)');

            if (activeTable) {
                let rows = activeTable.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    let rowText = row.innerText.toLowerCase();
                    row.style.display = rowText.includes(searchTerm) ? '' : 'none';
                });
            }
        });
    });
</script>

</html>