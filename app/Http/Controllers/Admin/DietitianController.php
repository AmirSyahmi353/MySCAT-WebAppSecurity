<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\FoodDiary;

class DietitianController extends Controller
{
    public function index()
    {
        $dietitians = User::where('role', 'dietitian')->orderBy('name')->get();
        return view('admin.dietitianindex', compact('dietitians'));
    }

    public function create()
    {
        return view('admin.dietitiancreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required',
            'status' => 'required'
        ]);
        // tunjuk validation kat depan

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'status'   => $request->status,
        ]);

        return redirect()->route('admin.dietitianindex')
                         ->with('success', 'Dietitian registered successfully.');
    }

    public function edit($id)
    {
        $dietitian = User::findOrFail($id);
        return view('admin.dietitians.edit', compact('dietitian'));
    }

    public function update(Request $request, $id)
    {
        $dietitian = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$id},_id",
        ]);

        $dietitian->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.dietitianindex')
                         ->with('success', 'Dietitian updated successfully.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('admin.dietitianindex')
                         ->with('success', 'Dietitian removed.');
    }

    public function questionnaire($id)
{
    $patient = User::findOrFail($id);

    $questionnaire = Result::where('user_id', $id)->first();

    return view('admin.patientquestionnaire', compact('patient', 'questionnaire'));
}

public function FoodDiary($id)
{
    $patient = User::findOrFail($id);

    // Get the single diary document for this patient (or null)
    $diary = FoodDiary::where('user_id', $id)->first();

    // Normalize entries to a collection so blade can call ->isEmpty()
    $entries = collect();

    if ($diary && !empty($diary->entries)) {
        // If entries is an associative array (day1 => [...]), convert to collection
        $entries = collect($diary->entries);
    }

    return view('admin.patientfooddiary', [
        'patient' => $patient,
        'diary'   => $diary,
        'entries' => $entries,
    ]);
}

}
