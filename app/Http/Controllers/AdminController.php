<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Administrator::all();
        return view('admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan form

        $admin = new Administrator([
            'user_id' => $request->user_id,
            'name' => $request->name,
        ]);

        $admin->save();

        return redirect()->route('admins.index')->with('success', 'Admin created successfully.');
    }

    public function edit(Administrator $admin)
    {
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, Administrator $admin)
    {
        // Validasi inputan form

        $admin->user_id = $request->user_id;
        $admin->name = $request->name;
        $admin->save();

        return redirect()->route('admins.index')->with('success', 'Admin updated successfully.');
    }

    public function destroy(Administrator $admin)
    {
        $admin->delete();

        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully.');
    }
}
