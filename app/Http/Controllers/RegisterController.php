<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'no_telp' => ['required', 'string', 'max:50', Rule::unique('users', 'no_telp')],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted']
        ]);
        $attributes['password'] = bcrypt($attributes['password']);
        $attributes['role'] = 'peminjam';

        session()->flash('Berhasil', 'Akun Anda berhasil dibuat.');
        $user = User::create($attributes);
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}