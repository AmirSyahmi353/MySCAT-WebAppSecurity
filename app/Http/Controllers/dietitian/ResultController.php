<?php

namespace App\Http\Controllers\Dietitian;

use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\User;

class ResultController extends Controller
{
    /**
     * Display a list of all patient results.
     */
    public function index()
    {
        // RBAC Check: Only Dietitian can view all results
        if (auth()->user()->role !== 'dietitian') {
            abort(403, 'Unauthorized access.');
        }

        // Load results + patient info
        $results = Result::with(['user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dietitian.results.index', compact('results'));
    }

    /**
     * Show detailed result for a single patient
     */
    public function show($id)
    {
        // RBAC Check: Only Dietitian can view detailed result here
        if (auth()->user()->role !== 'dietitian') {
            abort(403, 'Unauthorized access.');
        }

        // Find result by ID
        $result = Result::with('user')->findOrFail($id);

        return view('dietitian.results.show', compact('result'));
    }
}
