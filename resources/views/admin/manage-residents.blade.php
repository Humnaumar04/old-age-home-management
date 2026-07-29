@extends('layouts.admin')
@section('content')

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-[#1E4C56] mb-1">Manage Residents</h1>
                <p class="text-sm text-gray-500">All admitted elderly residents — view, update, or discharge</p>
            </div>
            <!-- Admit Resident Button -->
            <a href="{{ route('admin.add_resident') }}" class="bg-[#1E4C56] hover:bg-[#15353d] text-white px-5 py-2.5 rounded-xl font-semibold flex items-center space-x-2 shadow-sm transition">
                <span>➕</span> <span>Admit Resident</span>
            </a>
        </div>

        <!-- Residents Table Card (Figma Design Matches Here) -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#F3EFE6] text-gray-600 text-sm font-semibold uppercase tracking-wider">
                        <th class="p-4 text-center w-16">#</th>
                        <th class="p-4">Name</th>
                        <th class="p-4 text-center">Age</th>
                        <th class="p-4">Room</th>
                        <th class="p-4">Condition</th>
                        <th class="p-4">BP</th>
                        <th class="p-4">Sugar</th>
                        <th class="p-4">Admitted</th>
                        <th class="p-4 text-center w-40">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-xs text-gray-600 divide-y divide-gray-50/50">
                    @forelse($residents as $index => $resident)
                    <tr class="hover:bg-gray-50/40 transition">
                        <td class="px-6 py-4 text-center text-gray-400 font-medium">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-bold text-gray-800">{{ $resident->name }}</td>
                        <td class="px-6 py-4 font-medium text-gray-500">{{ $resident->age }}</td>
                        <td class="px-6 py-4 font-medium text-gray-500">{{ $resident->room_number }}</td>
                        <td class="px-6 py-4">
                            @if($resident->medical_condition == 'Stable')
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-[#E8F8F5] text-[#2ECC71]">Stable</span>
                            @elseif($resident->medical_condition == 'Critical')
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-[#FDEDEC] text-[#E74C3C]">Critical</span>
                            @else
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-[#FEF5E7] text-[#F39C12]">{{ $resident->medical_condition }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-400">{{ $resident->bp_systolic }}/{{ $resident->bp_diastolic }}</td>
                        <td class="px-6 py-4 font-medium text-gray-400">{{ $resident->sugar_level }}</td>
                        <td class="px-6 py-4 font-medium text-gray-400">{{ $resident->date_of_admission }}</td>
                        <td class="px-6 py-4 text-center space-x-3 whitespace-nowrap">
                            <a href="{{ route('admin.residents.edit', $resident->id) }}"
                                class="text-blue-600 hover:text-blue-800 font-medium transition text-xs">
                                Edit
                            </a>

                            <form action="{{ route('admin.residents.destroy', $resident->id) }}"
                                method="POST" class="inline-block"
                                onsubmit="return confirm('Are you sure you want to delete this resident?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-1.5 rounded-lg font-medium text-xs">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-10 text-center text-gray-400 font-medium bg-white">
                            No residents admitted yet. Click "+ Admit Resident" to add one!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endsection