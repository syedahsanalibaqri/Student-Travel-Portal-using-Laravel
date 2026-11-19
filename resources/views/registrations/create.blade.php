@extends('layouts.app')

@section('title', 'Apply for Travel Pass')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-slate-200">
    <h1 class="text-2xl font-bold text-slate-900 mb-2">Student Travel Registration</h1>
    <p class="text-sm text-slate-500 mb-6">Fill out your travel details to secure your college trip clearance pass.</p>

    <form action="{{ route('registrations.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-semibold uppercase text-slate-600 mb-1">Full Name *</label>
            <input type="text" name="full_name" value="{{ old('full_name') }}" required
                   class="w-full px-3 py-2 border rounded-md text-sm @error('full_name') border-red-500 @else border-slate-300 @enderror focus:ring-2 focus:ring-blue-500 outline-none">
            @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-600 mb-1">Institutional Email *</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full px-3 py-2 border rounded-md text-sm @error('email') border-red-500 @else border-slate-300 @enderror focus:ring-2 focus:ring-blue-500 outline-none">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-600 mb-1">Phone Number *</label>
                <input type="text" name="phone" value="{{ old('phone') }}" required
                       class="w-full px-3 py-2 border rounded-md text-sm @error('phone') border-red-500 @else border-slate-300 @enderror focus:ring-2 focus:ring-blue-500 outline-none">
                @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-600 mb-1">Department *</label>
                <select name="department" required class="w-full px-3 py-2 border border-slate-300 rounded-md text-sm outline-none">
                    <option value="">Select Department</option>
                    <option value="Software Engineering" {{ old('department') == 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
                    <option value="Computer Science" {{ old('department') == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                    <option value="Electrical Engineering" {{ old('department') == 'Electrical Engineering' ? 'selected' : '' }}>Electrical Engineering</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-600 mb-1">Trip Destination *</label>
                <input type="text" name="destination" value="{{ old('destination') }}" placeholder="e.g. Northern Areas / Swat" required
                       class="w-full px-3 py-2 border border-slate-300 rounded-md text-sm outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase text-slate-600 mb-1">Medical or Dietary Notes</label>
            <textarea name="medical_notes" rows="3" placeholder="Allergies, chronic conditions, or none"
                      class="w-full px-3 py-2 border border-slate-300 rounded-md text-sm outline-none">{{ old('medical_notes') }}</textarea>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-md text-sm transition">
            Submit Travel Application
        </button>
    </form>
</div>
@endsection
