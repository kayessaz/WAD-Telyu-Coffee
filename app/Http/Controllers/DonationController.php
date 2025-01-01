<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
    // Show donation records or donation form
    public function index()
    {
        // Fetch all donations
        $donations = Donation::all();

        // Check if user is an admin or a donor
        if (auth()->user()->email == 'admin@gmail.com') {
            return view('donation.index', compact('donations')); // admin view
        }

        return view('donation.index'); // donor view
    }

    // Store donation records
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240', // 10MB max
        ]);

        // Handle file upload
        $proofPath = $request->file('proof')->store('donation_proofs', 'public');

        // Create a new donation record
        Donation::create([
            'name' => $request->name,
            'email' => $request->email,
            'proof' => $proofPath,
        ]);

        // Redirect to a success page or back to the form with a success message
        return redirect()->route('donation.index')->with('success', 'Donation recorded successfully!');
    }
}
