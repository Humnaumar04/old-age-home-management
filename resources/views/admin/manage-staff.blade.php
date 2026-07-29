@extends('layouts.admin')
@section('content')

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-[#1E4C56] mb-1">Manage Staff</h1>
                <p class="text-sm text-gray-500">View, add, update, and remove staff members</p>
            </div>
            <!-- Add Staff Button -->
            <a href="{{ route('admin.add_staff') }}" class="bg-[#1E4C56] hover:bg-[#15353d] text-white px-5 py-2.5 rounded-xl font-semibold flex items-center space-x-2 shadow-sm transition">
                <span>➕</span> <span>Add Staff</span>
            </a>
        </div>

        <!-- Staff Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#F3EFE6] text-gray-600 text-sm font-semibold uppercase tracking-wider">
                        <th class="p-4 text-center w-16">#</th>
                        <th class="p-4">Name</th>
                        <th class="p-4">Designation</th>
                        <th class="p-4">Shift</th>
                        <th class="p-4">Phone</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center w-40">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($staffMembers as $index => $staff)
                    <tr class="hover:bg-gray-50/70 transition">
                        <td class="p-4 text-center text-gray-400 font-medium">{{ $index + 1 }}</td>
                        <td class="p-4 font-semibold text-gray-900">{{ $staff->name }}</td>
                        <td class="p-4 text-gray-500">{{ $staff->designation }}</td>
                        <td class="p-4">{{ $staff->shift }}</td>
                        <td class="p-4 text-gray-600">{{ $staff->phone }}</td>
                        <td class="p-4">
                            <span class="px-3 py-1 font-semibold text-xs rounded-full 
                    {{ $staff->status == 'Active' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $staff->status }}
                            </span>
                        </td>
                        <td class="p-4 text-center flex justify-center space-x-3">
                            <a href="{{ route('admin.manage_staff.edit', $staff->id) }}" class="text-blue-600 hover:text-blue-800 font-medium transition text-xs pt-1.5 mr-3">
                                Edit
                            </a>
                            <form action="{{ route('admin.manage_staff.destroy', $staff->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this staff member?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1.5 rounded-lg font-medium text-xs transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <!-- Agar database mein koi staff nahi hoga to yeh message aayega -->
                    <tr>
                        <td colspan="7" class="p-8 text-center text-gray-400 font-medium">
                            No staff members found. Click "+ Add Staff" to add one!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
@endsection