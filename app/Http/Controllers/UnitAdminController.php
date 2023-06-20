<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UnitAdminController extends Controller
{
    public function index() {
        if(auth()->user()->can('administrator')) {
        $unitadmins = User::where('role', 'unitadmin')->get();

        return view('administrator.unitadmins.index', compact('unitadmins'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function create()
    {
        return view('administrator.unitadmins.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan form

        $unitadmin = new UnitAdmin([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'unit_id' => $request->unit_id,
        ]);

        $unitadmin->save();

        return redirect()->route('administrator.unitadmins.index')->with('success', 'Unit admin created successfully.');
    }

    public function edit(UnitAdmin $unitadmin)
    {
        if(auth()->user()->can('administrator')) {
        return view('administrator.unitadmins.edit', compact('unitadmin'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function update(Request $request, UnitAdmin $unitadmin)
    {
        // Validasi inputan form

        $unitadmin->name = $request->name;
        $unitadmin->email = $request->email;
        $unitadmin->unit_id = $request->unit_id;
        $unitadmin->save();

        return redirect()->route('administrator.unitadmins.index')->with('success', 'Unit admin updated successfully.');
    }

    public function destroy(UnitAdmin $unitadmin)
    {
        $unitadmin->delete();

        return redirect()->route('administrator.unitadmins.index')->with('success', 'Unit admin deleted successfully.');
    }
}
