<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BootcampPackage;
use App\Models\Participant;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $totalParticipants = Participant::count();
        $totalTransactions = Transaction::where('status', 'paid')->sum('amount');
        $activePackages = BootcampPackage::where('is_active', true)->count();
        $recentParticipants = Participant::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalParticipants', 'totalTransactions', 'activePackages', 'recentParticipants'));
    }
}
