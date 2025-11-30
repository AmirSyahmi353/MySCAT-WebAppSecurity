<?php

// namespace App\Http\Controllers\Dietitian;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;

// class DietitianAuthController extends Controller
// {
//     public function showLogin()
//     {
//         return view('login');
//     }

//     public function login(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required',
//         ]);

//         // Find dietitian user
//         $dietitian = User::where('email', $request->email)
//             ->where('role', 'dietitian')
//             ->where('status', 'active')
//             ->first();

//         if (!$dietitian || !Hash::check($request->password, $dietitian->password)) {
//             return back()->with('error', 'Invalid dietitian credentials');
//         }

//         // Log in dietitian manually
//         auth()->login($dietitian);

//         return redirect()->route('admin.dashboard');
//     }

//     public function logout()
//     {
//         auth()->logout();
//         return redirect()->route('login');
//     }
// }

