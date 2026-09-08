@extends('layouts.family')

@section('title', 'Communication')

@section('content')
<div class="max-w-4xl mx-auto">

    <!-- Top Header Title & Clear Chat Button -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-[#1E4C56]">Care Team Communication</h1>
            <p class="text-sm text-gray-500">Directly message the management regarding resident updates</p>
        </div>

        <!-- Clear Chat Button for Family -->
        <form action="{{ url('/family/communication/clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear your chat history?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-3.5 py-2 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold rounded-xl border border-red-200 transition flex items-center gap-1.5 shadow-sm">
                <span>🗑️</span> Clear Chat
            </button>
        </form>
    </div>

    <!-- Chat Box Container -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 space-y-6">

        <!-- Messages History Box -->
        <div class="bg-[#FAF9F5] rounded-2xl p-6 border border-gray-100 h-96 overflow-y-auto space-y-6">

            @forelse($messages as $msg)
            @if($msg->sender_type == 'admin')
            <!-- Admin / Care Team Received Message (Left Side) -->
            <div class="space-y-1">
                <span class="text-xs text-gray-400 ml-1">Care Team (Admin) · {{ $msg->created_at->format('M d, Y h:i A') }}</span>
                <div class="bg-white border border-gray-200 text-gray-800 p-4 rounded-2xl rounded-tl-sm max-w-xl shadow-sm text-sm">
                    {{ $msg->message }}
                </div>
            </div>
            @else
            <!-- Family Member Sent Message (Right Side) -->
            <div class="space-y-1 text-right">
                <span class="text-xs text-gray-400 mr-1">You · {{ $msg->created_at->format('M d, Y h:i A') }}</span>
                <div class="inline-block bg-[#1E4C56] text-white p-4 rounded-2xl rounded-tr-sm max-w-xl text-left shadow-sm text-sm">
                    {{ $msg->message }}
                </div>
            </div>
            @endif
            @empty
            <div class="text-center text-gray-400 py-20 text-sm">
                No messages yet. Start a conversation below!
            </div>
            @endforelse

        </div>

        <!-- Write a Message Form -->
        <form action="{{ route('family.communication.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Write a Message <span class="text-red-500">*</span></label>
                <textarea name="message" rows="3" required placeholder="Type your message to the staff or admin..." class="w-full rounded-2xl border border-gray-200 p-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#1E4C56] bg-gray-50/50"></textarea>
            </div>

            <div>
                <button type="submit" class="bg-[#1E4C56] hover:bg-[#16383f] text-white px-6 py-3 rounded-xl font-medium transition flex items-center space-x-2 text-sm shadow-sm">
                    <span>💬</span>
                    <span>Send Message</span>
                </button>
            </div>
        </form>

    </div>

</div>
@endsection