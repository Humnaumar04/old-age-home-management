<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Requests - Old Age Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F8F6F0] text-gray-800">

    <div class="p-8 md:p-12 max-w-5xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-[#1E4C56]">My Request Status</h1>
            <a href="/resident/request-help" class="text-sm font-semibold text-[#1E4C56] hover:underline">← Back to Request Help</a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-bold">
                    <tr>
                        <th class="p-4">#</th>
                        <th class="p-4">Type</th>
                        <th class="p-4">Description</th>
                        <th class="p-4">Date</th>
                        <th class="p-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($myRequests as $req)
                    <tr>
                        <td class="p-4 text-sm">{{ $loop->iteration }}</td>
                        <td class="p-4 text-sm font-semibold text-[#1E4C56]">{{ $req->help_type }}</td>
                        <td class="p-4 text-sm text-gray-600">{{ $req->description }}</td>
                        <td class="p-4 text-sm text-gray-500">{{ $req->created_at->format('Y-m-d') }}</td>
                        <td class="p-4">
                            @if($req->status == 'Approved')
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full font-bold text-xs">Approved ✓</span>
                            @elseif($req->status == 'Rejected')
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full font-bold text-xs">Rejected ✕</span>
                            @else
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full font-bold text-xs">Pending...</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">No requests found yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>