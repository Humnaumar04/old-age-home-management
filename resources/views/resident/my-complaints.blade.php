<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Complaints - Old Age Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F8F6F0] p-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-[#1E4C56] mb-6">My Complaints History</h1>
            <a href="/resident/submit-complaint" class="text-[#1E4C56] font-semibold hover:underline">← Back to Submit Complaint</a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-400 text-xs uppercase border-b">
                        <th class="p-4">Subject</th>
                        <th class="p-4">Category</th>
                        <th class="p-4">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $complaint)
                    <tr class="border-b">
                        <td class="p-4 font-medium text-gray-700">{{ $complaint->subject }}</td>
                        <td class="p-4 text-gray-600">{{ $complaint->category }}</td>
                        <td class="p-4">
                            @if($complaint->status == 'Resolved')
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Resolved</span>
                            @else
                            <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full">Pending</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>