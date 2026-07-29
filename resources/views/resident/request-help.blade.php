@extends('layouts.resident')
@section('content')
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-[#1E4C56]">Request Assistance</h1>
                <p class="text-sm text-gray-500 mt-1">Need help? Select the type of assistance you require.</p>
            </div>
            <a href="{{ route('resident.my-requests') }}" 
            class="flex items-center space-x-2 bg-white border border-[#1E4C56] text-[#1E4C56] px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-[#1E4C56] hover:text-white transition shadow-sm">
                📜 My Requests
            </a>
        </div>
        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-xl">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm max-w-3xl p-8">
            <form action="{{ route('help.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Help Type -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Assistance Type <span class="text-red-500">*</span></label>
                    <select name="help_type" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm bg-white focus:outline-none focus:border-[#1E4C56]">
                        <option value="" disabled selected>-- Select Type --</option>
                        <option value="Medical">Medical Help</option>
                        <option value="Personal">Personal Care</option>
                        <option value="Emergency">Urgent/Emergency</option>
                        <option value="Maintenance">Room Maintenance</option>
                    </select>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="4" required placeholder="Describe what you need help with..."
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#1E4C56]"></textarea>
                </div>

                <!-- Submit -->
                <button type="submit" class="px-6 py-3 bg-[#1E4C56] hover:bg-[#255A66] text-white font-semibold rounded-xl text-sm transition shadow-sm">
                    Send Request
                </button>
            </form>
        </div>
    @endsection