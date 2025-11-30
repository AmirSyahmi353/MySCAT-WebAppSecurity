<?php

namespace App\Http\Controllers\Dietitian;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Result;

class DashboardController extends Controller
{
    public function index()
    {
        // Count all patients
        $totalPatients = User::where('role', 'patient')->count();

        // Correct craving analytics based on totalScore
        $normalCount = Result::where('totalScore', '<=', 45)->count();
        $highCount   = Result::where('totalScore', '>=', 46)->count();

        // Build recent patients list (latest 5 users)
        $patients = User::where('role', 'patient')
            ->orderByDesc('created_at') // fallbacks to document creation order if available
            ->take(5)
            ->get();

        // Attach latest result and demographic for each patient to make blade simple
        $recentPatients = $patients->map(function ($p) {
            // attach latest result (or null)
            $p->result = Result::where('user_id', $p->_id)->orderByDesc('created_at')->first();

            // demographic relationship may already exist if defined on User model
            // If not loaded, try to access (it will lazy load)
            $p->demographic = $p->demographic ?? null;

            return $p;
        });

        return view('admin.dashboard', compact(
            'totalPatients',
            'normalCount',
            'highCount',
            'recentPatients'   // <-- pass this so view has it
        ));
    }
}
