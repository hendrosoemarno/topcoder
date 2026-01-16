<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\Transaction;
use Illuminate\Validation\Rule;

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
        $participant->load(['transactions.package', 'transactions.paymentLog']);
        return view('admin.participants.show', compact('participant'));
    }

    public function edit(Participant $participant)
    {
        return view('admin.participants.edit', compact('participant'));
    }

    public function update(Request $request, Participant $participant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('participants')->ignore($participant->id)],
            'whatsapp' => 'required|string|max:20',
            'status' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
        ]);

        $participant->update($request->all());

        return redirect()->route('admin.participants.index')->with('success', 'Participant updated successfully.');
    }

    public function destroy(Participant $participant)
    {
        // Optional: Check/Delete transactions first
        $participant->transactions()->delete();
        $participant->delete();

        return redirect()->route('admin.participants.index')->with('success', 'Participant deleted successfully.');
    }
}
