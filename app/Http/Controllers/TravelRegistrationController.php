<?php

namespace App\Http\Controllers;

use App\Models\TravelRegistration;
use Illuminate\Http\Request;

class TravelRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Aggregate statistics for dashboard summary cards
        $metrics = [
            'total'    => TravelRegistration::count(),
            'approved' => TravelRegistration::where('status', 'Approved')->count(),
            'pending'  => TravelRegistration::where('status', 'Pending')->count(),
            'rejected' => TravelRegistration::where('status', 'Rejected')->count(),
        ];

        // Retrieve filtered records
        $registrations = TravelRegistration::filter($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.dashboard', compact('registrations', 'metrics', 'search'));
    }

    public function create()
    {
        return view('registrations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'     => 'required|string|max:100',
            'email'         => 'required|email|unique:travel_registrations,email',
            'phone'         => 'required|string|max:20',
            'department'    => 'required|string|max:60',
            'destination'   => 'required|string|max:100',
            'medical_notes' => 'nullable|string|max:500',
        ]);

        TravelRegistration::create($validated);

        return redirect()->route('registrations.create')
            ->with('success', 'Application submitted successfully! Your clearance status is currently Pending.');
    }

    public function updateStatus(Request $request, TravelRegistration $registration)
    {
        $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected'
        ]);

        $registration->update(['status' => $request->status]);

        return redirect()->back()->with('success', "Status updated to {$request->status} for {$registration->full_name}.");
    }

    public function destroy(TravelRegistration $registration)
    {
        $registration->delete();

        return redirect()->route('registrations.index')
            ->with('success', 'Travel registration entry removed successfully.');
    }
}
