<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        if ($user->can('borrower')) {
            return view('borrower.profile.index', compact('user'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function edit()
    {
        if(auth()->user()->can('borrower')) {
            $user = auth()->user();
            return view('borrower.profile.edit', compact('user'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|required',
            'phone' => 'required',
        ]);

        $user = auth()->user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $user->save();

        return redirect()->route('borrower.profile.index')->with('success', 'Profile updated successfully.');
    }

    public function changePassword(User $user)
    {
        if(auth()->user()->can('borrower')) {
            return view('borrower.profile.change-password', compact('user'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('borrower.profile.index')->with('success', 'Password changed successfully.');
    }
}