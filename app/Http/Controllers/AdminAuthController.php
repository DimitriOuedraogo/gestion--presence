<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ], [
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        $motDePasse = env('ADMIN_PASSWORD', '1234567890');

        if ($request->input('password') !== $motDePasse) {
            return back()->withErrors(['password' => 'Mot de passe incorrect.']);
        }

        $request->session()->put('admin_logged_in', true);
        $request->session()->save();

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');
        return redirect()->route('admin.login')->with('success', 'Vous avez été déconnecté.');
    }
}
