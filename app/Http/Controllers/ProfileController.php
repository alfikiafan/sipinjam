<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        if ($user->can('administratorOrBorrower')) {
            $validatedData = $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'city' => 'required',
                'about_me' => 'max:500',
            ]);
            
            $user = auth()->user();
            
            $user->name = $validatedData['name'];
            $user->phone = $validatedData['phone'];
            $user->address = $validatedData['address'];
            $user->city = $validatedData['city'];
            $user->about_me = $validatedData['about_me'];
            
            $user->save();

            return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');

        } elseif ($user->can('unitadmin')) {
            $validatedData = $request->validate([
                'about_me' => 'max:500',
            ]);
            
            $user = auth()->user();
            
            $user->about_me = $validatedData['about_me'];
            
            $user->save();

            return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
            
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function updatePhoto(Request $request)
    {
        $user = auth()->user();

        if ($request->hasFile('photo')) {

            if ($user->photo) {
                Storage::delete(str_replace('storage/', 'public/', $user->photo));
            }

            $path = $request->file('photo')->store('public/img/avatar');
            $filename = str_replace('public/', 'storage/', $path);
            $user->photo = $filename;
            $user->save();
        }

        return redirect()->back()->with('success', 'Photo profile updated successfully.');
    }

    public function changePassword(User $user)
    {
        return view('profile.change-password', compact('user'));
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

        return redirect()->route('profile.index')->with('success', 'Password changed successfully.');
    }
}