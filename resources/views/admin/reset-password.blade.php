@extends('layouts.admin')
@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-[#1E4C56] mb-1">Reset Password</h1>
        <p class="text-sm text-gray-500">Set a new password for {{ $user->name }} ({{ ucfirst($user->role) }})</p>
    </div>
    <a href="{{ route('admin.community_members') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl font-medium text-sm transition">
        ← Back
    </a>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 max-w-2xl">

    @if ($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-4">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.community_members.reset_password', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Account Email</label>
            <input type="text" value="{{ $user->email }}" disabled class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-100 text-gray-500">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">New Password <span class="text-red-500">*</span></label>
            <input type="password" name="password" required minlength="6" placeholder="Enter a new password"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Confirm New Password <span class="text-red-500">*</span></label>
            <input type="password" name="password_confirmation" required minlength="6" placeholder="Re-enter the new password"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1E4C56] transition bg-gray-50/30">
        </div>

        <p class="text-xs text-gray-400">The user will need to log in with this new password — share it with them securely outside the system.</p>

        <div class="pt-2">
            <button type="submit" class="bg-[#1E4C56] hover:bg-[#163C44] text-white px-6 py-2.5 rounded-xl font-medium text-sm transition">
                Reset Password
            </button>
        </div>
    </form>
</div>

@endsection