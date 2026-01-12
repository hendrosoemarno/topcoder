<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BootcampPackage;

class FrontController extends Controller
{
    public function index()
    {
        $packages = BootcampPackage::where('is_active', true)->get();
        return view('landing', compact('packages'));
    }

    public function register()
    {
        $packages = BootcampPackage::where('is_active', true)->get();
        return view('auth.register', compact('packages'));
    }

    public function bootcampDetail()
    {
        return view('bootcamp-detail');
    }

    public function storeRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:participants',
            'whatsapp' => 'required|string|max:20',
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'postal_code' => 'required|string',
            'status' => 'required|in:Umum,SMA,Mahasiswa,Pekerja',

            // Conditional validation based on status
            'school' => 'required_if:status,SMA',
            'school_class' => 'required_if:status,SMA',
            'major' => 'required_if:status,SMA',
            'campus' => 'required_if:status,Mahasiswa',
            'study_program' => 'required_if:status,Mahasiswa',
            'semester' => 'required_if:status,Mahasiswa',
            'occupation' => 'required_if:status,Pekerja',
            'company' => 'required_if:status,Pekerja',

            'bootcamp_package_id' => 'required|exists:bootcamp_packages,id',
            'programming_experience' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
        ]);

        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($request) {
                // 1. Create Participant
                $participant = \App\Models\Participant::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                    'whatsapp' => $request->whatsapp,
                    'gender' => $request->gender,
                    'birth_date' => $request->birth_date,
                    'address' => $request->address,
                    'city' => $request->city,
                    'province' => $request->province,
                    'postal_code' => $request->postal_code,
                    'status' => $request->status,
                    'school' => $request->school,
                    'school_class' => $request->school_class,
                    'major' => $request->major,
                    'campus' => $request->campus,
                    'study_program' => $request->study_program,
                    'semester' => $request->semester,
                    'occupation' => $request->occupation,
                    'company' => $request->company,
                    'programming_experience' => $request->programming_experience,
                ]);

                // 2. Get Package Details
                $package = BootcampPackage::findOrFail($request->bootcamp_package_id);

                // 3. Create Pending Transaction
                $participant->transactions()->create([
                    'order_id' => \Illuminate\Support\Str::uuid(),
                    'bootcamp_package_id' => $package->id,
                    'amount' => $package->price,
                    'status' => 'pending',
                ]);

                // 4. Auto Login
                \Illuminate\Support\Facades\Auth::guard('participant')->login($participant);
            });

            return redirect()->route('dashboard')->with('success', 'Registration successful! Please complete your payment.');

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['msg' => 'Registration failed: ' . $e->getMessage()]);
        }
    }
}
