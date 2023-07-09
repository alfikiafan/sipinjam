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

            return redirect('dashboard')->with(['success' => 'You have successfully logged into the system.']);
        }

        return back()->withErrors(['email' => "Your emails or passwords don't match."]);
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with(['success' => 'You have logged out of the system.']);
    }
}
