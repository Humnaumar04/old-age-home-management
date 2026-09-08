@extends('layouts.admin')

@section('title', 'Admin Communication')

@section('content')
<div class="max-w-4xl mx-auto h-[calc(100vh-6rem)] flex flex-col">

    <!-- Header, Back Button & Clear Chat Button -->
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-[#1E4C56]">Chat with {{ $selectedUser->name ?? 'Family Member' }}</h1>
            <p class="text-sm text-gray-500">Manage communication regarding residents</p>
        </div>

        <div class="flex items-center space-x-3">
            <!-- Clear Chat Button -->
            <form action="{{ route('admin.communication.clear', $selectedUser->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to clear all chat history with this user?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3.5 py-2 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold rounded-xl border border-red-200 transition flex items-center gap-1.5 shadow-sm">
                    <span>🗑️</span> Clear Chat
                </button>
            </form>

            <a href="{{ route('admin.communication') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition">
                ← Back to Inbox
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm flex-1 flex flex-col overflow-hidden p-6 space-y-6">

        <!-- Messages History Box -->
        <div class="bg-[#FAF9F5] rounded-2xl p-6 border border-gray-100 flex-1 overflow-y-auto space-y-6">
            @forelse($messages as $msg)
            @if($msg->sender_type == 'admin')
            <!-- Admin Sent Message -->
            <div class="space-y-1 text-right">
                <span class="text-xs text-gray-400 mr-1">You (Admin) · {{ $msg->created_at->format('M d, Y h:i A') }}</span>
                <div class="inline-block bg-[#1E4C56] text-white p-4 rounded-2xl rounded-tr-sm max-w-xl text-left shadow-sm text-sm">
                    {{ $msg->message }}
                </div>
            </div>
            @else
            <!-- Family Received Message -->
            <div class="space-y-1">
                <span class="text-xs text-gray-400 ml-1">{{ $msg->user->name ?? 'Family Member' }} · {{ $msg->created_at->format('M d, Y h:i A') }}</span>
                <div class="bg-white border border-gray-200 text-gray-800 p-4 rounded-2xl rounded-tl-sm max-w-xl shadow-sm text-sm">
                    {{ $msg->message }}
                </div>
            </div>
            @endif
            @empty
            <div class="text-center text-gray-400 py-20 text-sm">
                No messages in this conversation yet.
            </div>
            @endforelse
        </div>

        <!-- Reply Form with Selected User ID -->
        <form action="{{ route('admin.communication.store', $selectedUser->id) }}" method="POST" class="space-y-4">
            @csrf
            <div class="flex items-center space-x-3">
                <input type="text" name="message" required placeholder="Type your message here..." class="flex-1 rounded-2xl border border-gray-200 p-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#1E4C56] bg-gray-50/50">
                <button type="submit" class="bg-[#1E4C56] hover:bg-[#16383f] text-white px-6 py-4 rounded-2xl font-medium transition text-sm shadow-sm">
                    Send Message
                </button>
            </div>
        </form>

    </div>

</div>
@endsection