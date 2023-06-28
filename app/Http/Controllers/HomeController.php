<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $user = auth()->user();
        
        if ($user->can('administrator')) {
            return view('administrator.dashboard', compact('user'));
        } elseif ($user->can('unitadmin')) {
            return view('unitadmin.dashboard', compact('user'));
        } elseif ($user->can('borrower')) {
            return view('borrower.dashboard', compact('user'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function index() {
        if ($user->can('administrator')) {

        } elseif ($user->can('unitadmin')) {

        } elseif ($user->can('borrower')) {

        } else {
            abort(403, 'Forbidden');
        }
    }
}