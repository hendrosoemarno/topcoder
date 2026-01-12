<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ParticipantDashboardController extends Controller
{
    public function index()
    {
        $participant = Auth::guard('participant')->user();
        // Load latest transaction
        $latestTransaction = $participant->transactions()->latest()->with('package')->first();

        return view('participant.dashboard', compact('participant', 'latestTransaction'));
    }
}
