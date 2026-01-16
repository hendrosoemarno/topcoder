<?php

namespace App\Http\Controllers;

use App\Models\BootcampPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipantOrderController extends Controller
{
    public function index()
    {
        // Show active packages that the user hasn't successfully paid for yet?
        // Or just show all active packages and let them buy.
        // Let's filter simply: Active & Date Range.

        $packages = BootcampPackage::where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->get();

        return view('participant.catalog', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:bootcamp_packages,id',
        ]);

        $package = BootcampPackage::findOrFail($request->package_id);
        $participant = Auth::guard('participant')->user();

        // Optional: Check if already registered for this SPECIFIC package batch?
        // Let's assume they can buy again or buy different packages.

        $transaction = $participant->transactions()->create([
            'order_id' => 'TC-' . time() . rand(10, 99),
            'bootcamp_package_id' => $package->id,
            'amount' => $package->price,
            'status' => 'pending',
        ]);

        return redirect()->route('pay', $transaction->id);
    }
}
