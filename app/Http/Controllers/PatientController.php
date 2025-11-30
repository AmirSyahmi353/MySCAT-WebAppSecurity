<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Result;
use App\Models\Demographic;

class PatientController extends Controller
{
    /**
     * Show list of all patients (with optional filters)
     */
 public function index()
{
    $query = User::where('role', 'patient');

    // Search
    if (request('search')) {
        $search = request('search');
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%")
              ->orWhere('_id', 'like', "%$search%");
        });
    }

    // Status filter
    if (request('status')) {
        $status = request('status'); // Normal or High
        $patientIds = Result::where('level', $status)->pluck('user_id');

        $query->whereIn('_id', $patientIds);
    }

    $patients = $query->orderBy('name')->get();

    // 🔥 Attach latest result to each patient
    foreach ($patients as $p) {
        $latest = Result::where('user_id', $p->_id)->latest()->first();

        // Add dynamic fields (NOT stored in DB)
        $p->result = $latest;
        $p->score  = $latest->totalScore ?? null;
        $p->level  = $latest->level ?? null;
    }

    return view('admin.patientindex', compact('patients'));
}




    /**
     * Show details for one patient
     */
    public function show($id)
    {
        // Load patient by MongoDB _id
        $patient = User::where('_id', $id)
                    ->where('role', 'patient')
                    ->firstOrFail();

        // Get demographic data
        $demographic = Demographic::where('user_id', $id)->first();

        // Get latest result
        $result = Result::where('user_id', $id)->latest()->first();

        return view('admin.patientshow', compact(
            'patient',
            'demographic',
            'result'
        ));
    }
}
