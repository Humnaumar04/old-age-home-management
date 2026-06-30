@extends('layouts.app')

@section('content')
<div class="flex h-screen w-full">

    <div class="hidden md:flex md:w-5/12 bg-[#1C4E55] p-12 flex-col justify-between text-white">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <div class="bg-[#D97736] p-2 rounded-lg">🧡</div>
                <h2 class="text-xl font-bold leading-tight">Old Age Home<br><span class="text-xs font-normal opacity-80">Management System</span></h2>
            </div>
            <p class="text-xs text-[#D97736] font-semibold tracking-wider uppercase mt-8">Caring Since 2018</p>
            <h1 class="text-4xl font-serif font-medium mt-4 leading-snug">Dignity, care, and compassion for our beloved elders.</h1>
            <p class="text-sm opacity-70 mt-6 max-w-sm">A unified management platform for residents, staff, families, donors, and volunteers — bringing everyone closer to those who need care.</p>
        </div>

        <div class="grid grid-cols-3 gap-4 bg-[#163E44] p-4 rounded-xl border border-teal-800">
            <div>
                <h3 class="text-xl font-bold">47</h3>
                <p class="text-[10px] opacity-60">Residents</p>
            </div>
            <div>
                <h3 class="text-xl font-bold">12</h3>
                <p class="text-[10px] opacity-60">Staff Members</p>
            </div>
            <div>
                <h3 class="text-xl font-bold">23</h3>
                <p class="text-[10px] opacity-60">Volunteers</p>
            </div>
        </div>
    </div>

    <div class="w-full md:w-7/12 flex flex-col justify-center px-8 sm:px-16 lg:px-24 py-8">
        <a href="{{ route('landing') }}" class="text-xs text-gray-500 hover:text-gray-800 mb-6 flex items-center gap-1">← Back to Home</a>

        <h2 class="text-3xl font-serif font-bold text-[#1C4E55]">Welcome Back</h2>
        <p class="text-sm text-gray-600 mt-1 mb-8">Sign in to your account to continue</p>

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm">
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-2">Login As</label>
                <input type="hidden" name="role" id="selected_role" value="admin">
                <div class="grid grid-cols-3 gap-3">
                    <button type="button" onclick="selectRole('admin', this)" class="role-btn py-2 px-3 text-xs font-medium rounded-lg border bg-[#1C4E55] text-white transition-all">Admin</button>
                    <button type="button" onclick="selectRole('staff', this)" class="role-btn py-2 px-3 text-xs font-medium rounded-lg border bg-white text-gray-700 hover:bg-gray-50 transition-all">Staff</button>
                    <button type="button" onclick="selectRole('resident', this)" class="role-btn py-2 px-3 text-xs font-medium rounded-lg border bg-white text-gray-700 hover:bg-gray-50 transition-all">Resident</button>
                    <button type="button" onclick="selectRole('donor', this)" class="role-btn py-2 px-3 text-xs font-medium rounded-lg border bg-white text-gray-700 hover:bg-gray-50 transition-all">Donor</button>
                    <button type="button" onclick="selectRole('family', this)" class="role-btn py-2 px-3 text-xs font-medium rounded-lg border bg-white text-gray-700 hover:bg-gray-50 transition-all">Family</button>
                    <button type="button" onclick="selectRole('volunteer', this)" class="role-btn py-2 px-3 text-xs font-medium rounded-lg border bg-white text-gray-700 hover:bg-gray-50 transition-all">Volunteer</button>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                <input type="email" name="email" required placeholder="your@email.com" class="w-full p-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-[#1C4E55]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full p-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-[#1C4E55]">
            </div>

            <button type="submit" class="w-full bg-[#1C4E55] text-white py-3 rounded-lg text-sm font-semibold hover:bg-[#153B40] transition-colors flex justify-center items-center gap-2 mt-4 cursor-pointer">
                Sign In <span>→</span>
            </button>
        </form>

        <!-- REGISTER LINK BLOCK (With proper spacing and interactive layer) -->
        <div class="relative z-10 text-center mt-6 py-2">
            <p class="text-xs text-gray-500">
                New here? <a href="{{ route('register') }}" class="text-[#1C4E55] font-bold hover:underline cursor-pointer px-1 py-1">Register as Donor, Family, or Volunteer</a>
            </p>
        </div>
    </div>

    <script>
        function selectRole(roleName, buttonElement) {
            // Update hidden input value
            document.getElementById('selected_role').value = roleName;

            // Reset all buttons to default style
            document.querySelectorAll('.role-btn').forEach(btn => {
                btn.classList.remove('bg-[#1C4E55]', 'text-white');
                btn.classList.add('bg-white', 'text-gray-700');
            });

            // Apply active style to clicked button
            buttonElement.classList.remove('bg-white', 'text-gray-700');
            buttonElement.classList.add('bg-[#1C4E55]', 'text-white');
        }
    </script>
    @endsection