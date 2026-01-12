<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\Transaction;

class ParticipantController extends Controller
{
    public function index(Request $request)
    {
        $query = Participant::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $participants = $query->latest()->paginate(10);
        return view('admin.participants.index', compact('participants'));
    }

    public function show(Participant $participant)
    {
        $participant->load(['transactions.package', 'transactions.paymentLog']); // Assuming relation exists or we fix it
        return view('admin.participants.show', compact('participant'));
    }
}
