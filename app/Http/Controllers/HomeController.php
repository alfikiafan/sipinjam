<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        
        if ($user->role === 'administrator') {
            return view('administrator.dashboard', compact('user'));
        } elseif ($user->role === 'unitadmin') {
            return view('unitadmin.dashboard', compact('user'));
        } elseif ($user->role === 'borrower') {
            return view('borrower.dashboard', compact('user'));
        } else {
            abort(403, 'Forbidden');
        }
    }
}