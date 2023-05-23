<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required' 
        ]);

        if(Auth::attempt($attributes))
        {
            session()->regenerate();
            return redirect('dashboard')->with(['success'=>'Anda telah masuk ke sistem.']);
        }
        else
        {
            return back()->withErrors(['email'=>'Email atau kata sandi Anda tidak cocok.']);
        }
    }
    
    public function destroy()
    {
        Auth::logout();
        return redirect('/login')->with(['success'=>'Anda telah keluar dari sistem.']);
    }
}
