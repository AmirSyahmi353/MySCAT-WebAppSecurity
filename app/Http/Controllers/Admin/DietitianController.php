<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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
}
