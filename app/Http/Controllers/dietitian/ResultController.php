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
        // MongoDB uses string-based _id, so we must find by the string
        $result = Result::with('user')->findOrFail($id);

        // Decode JSON answers IF stored incorrectly as a JSON string
        if (is_string($result->answers)) {
            $result->answers = json_decode($result->answers, true);
        }

        return view('dietitian.results.show', compact('result'));
    }
}
