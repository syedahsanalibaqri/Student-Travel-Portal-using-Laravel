@extends('layouts.app')

@section('title', 'Travel Pass Coordinator Panel')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Coordinator Dashboard</h1>
        <p class="text-sm text-slate-500">Monitor travel applications, approve passes, and manage attendee records.</p>
    </div>

    <!-- Aggregate Metric Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white border border-slate-200 p-4 rounded-lg shadow-sm">
            <p class="text-xs text-slate-500 uppercase font-semibold">Total Applications</p>
            <p class="text-2xl font-bold text-slate-900 mt-1">{{ $metrics['total'] }}</p>
        </div>
        <div class="bg-white border border-amber-200 p-4 rounded-lg shadow-sm bg-amber-50/30">
            <p class="text-xs text-amber-600 uppercase font-semibold">Pending Review</p>
            <p class="text-2xl font-bold text-amber-700 mt-1">{{ $metrics['pending'] }}</p>
        </div>
        <div class="bg-white border border-emerald-200 p-4 rounded-lg shadow-sm bg-emerald-50/30">
            <p class="text-xs text-emerald-600 uppercase font-semibold">Approved Passes</p>
            <p class="text-2xl font-bold text-emerald-700 mt-1">{{ $metrics['approved'] }}</p>
        </div>
        <div class="bg-white border border-rose-200 p-4 rounded-lg shadow-sm bg-rose-50/30">
            <p class="text-xs text-rose-600 uppercase font-semibold">Rejected Passes</p>
            <p class="text-2xl font-bold text-rose-700 mt-1">{{ $metrics['rejected'] }}</p>
        </div>
    </div>

    <!-- Search & Filter Controls -->
    <div class="flex justify-between items-center flex-wrap gap-4 bg-white p-4 border border-slate-200 rounded-lg">
        <form action="{{ route('registrations.index') }}" method="GET" class="flex gap-2 w-full md:w-96">
            <input type="text" name="search" value="{{ $search }}" placeholder="Search by name, email, or destination..."
                   class="w-full px-3 py-2 border border-slate-300 rounded-md text-sm outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded-md text-sm hover:bg-slate-900">Filter</button>
            @if ($search)
                <a href="{{ route('registrations.index') }}" class="bg-slate-200 text-slate-700 px-3 py-2 rounded-md text-sm hover:bg-slate-300">Reset</a>
            @endif
        </form>
    </div>

    <!-- Registrations Data Table -->
    <div class="bg-white border border-slate-200 rounded-lg overflow-hidden shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Applicant</th>
                    <th class="px-4 py-3">Department</th>
                    <th class="px-4 py-3">Destination</th>
                    <th class="px-4 py-3">Current Status</th>
                    <th class="px-4 py-3">Date Applied</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($registrations as $row)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3">
                            <div class="font-semibold text-slate-900">{{ $row->full_name }}</div>
                            <div class="text-xs text-slate-500">{{ $row->email }} | {{ $row->phone }}</div>
                        </td>
                        <td class="px-4 py-3 text-slate-700">{{ $row->department }}</td>
                        <td class="px-4 py-3 text-slate-700">{{ $row->destination }}</td>
                        <td class="px-4 py-3">
                            <form action="{{ route('registrations.updateStatus', $row) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" 
                                        class="text-xs font-semibold rounded-full px-2.5 py-1 border outline-none
                                        {{ $row->status === 'Approved' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : '' }}
                                        {{ $row->status === 'Pending' ? 'bg-amber-50 text-amber-700 border-amber-200' : '' }}
                                        {{ $row->status === 'Rejected' ? 'bg-rose-50 text-rose-700 border-rose-200' : '' }}">
                                    <option value="Pending" {{ $row->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Approved" {{ $row->status === 'Approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="Rejected" {{ $row->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-4 py-3 text-xs text-slate-500">{{ $row->created_at->format('M d, Y H:i') }}</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <form action="{{ route('registrations.destroy', $row) }}" method="POST" class="inline" 
                                  onsubmit="return confirm('Permanently remove this travel clearance record?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-medium text-red-600 hover:text-red-800">Remove</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-slate-400">No matching travel clearance records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div>
        {{ $registrations->links() }}
    </div>
</div>
@endsection
