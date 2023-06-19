<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        if (auth()->check()) {
            return redirect('/dashboard');
        }
        return view('session.login-session');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('rememberMe');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect('dashboard')->with(['success' => 'Anda telah masuk ke sistem.']);
        }

        return back()->withErrors(['email' => 'Email atau kata sandi Anda tidak cocok.']);
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/login')->with(['success' => 'Anda telah keluar dari sistem.']);
    }
}
