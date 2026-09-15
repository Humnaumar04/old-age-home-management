@extends('layouts.app')

@section('content')
<div class="flex h-screen w-full">

    {{-- Left Side Info Panel --}}
    <div class="hidden md:flex md:w-5/12 bg-[#1C4E55] p-12 flex-col justify-between text-white">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <div class="bg-[#D97736] p-2 rounded-lg">🧡</div>
                <h2 class="text-xl font-bold leading-tight">Old Age Home<br><span class="text-xs font-normal opacity-80">Management System</span></h2>
            </div>
            <p class="text-xs text-[#D97736] font-semibold tracking-wider uppercase mt-8">Admin Access</p>
            <h1 class="text-4xl font-serif font-medium mt-4 leading-snug">Manage with care, lead with compassion.</h1>
            <p class="text-sm opacity-70 mt-6 max-w-sm">Restricted access panel for administrators only.</p>
        </div>
    </div>

    {{-- Right Side Login Form --}}
    <div class="w-full md:w-7/12 flex flex-col justify-center px-8 sm:px-16 lg:px-24 py-8">
        <a href="{{ route('landing') }}" class="text-xs text-gray-500 hover:text-gray-800 mb-6 flex items-center gap-1">← Back to Home</a>

        <h2 class="text-3xl font-serif font-bold text-[#1C4E55]">Admin Sign In</h2>
        <p class="text-sm text-gray-600 mt-1 mb-8">Restricted access — administrators only</p>

        {{-- Error Message Alert --}}
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm">
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="" required placeholder="admin@email.com" class="w-full p-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-[#1C4E55]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full p-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-[#1C4E55]">
            </div>

            <button type="submit" class="w-full bg-[#1C4E55] text-white py-3 rounded-lg text-sm font-semibold hover:bg-[#153B40] transition-colors flex justify-center items-center gap-2 mt-4 cursor-pointer">
                Sign In <span>→</span>
            </button>
        </form>
    </div>
    @endsection