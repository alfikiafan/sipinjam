<?php

namespace App\Http\Controllers;

use App\Models\UnitAdmin;
use Illuminate\Http\Request;

class UnitAdminController extends Controller
{
    public function index()
    {
        $unitAdmins = UnitAdmin::all();
        return view('unit_admins.index', compact('unitAdmins'));
    }

    public function create()
    {
        return view('unit_admins.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan form

        $unitAdmin = new UnitAdmin([
            'unit_id' => $request->unit_id,
            'user_id' => $request->user_id,
        ]);

        $unitAdmin->save();

        return redirect()->route('unit_admins.index')->with('success', 'Unit Admin created successfully.');
    }

    public function edit(UnitAdmin $unitAdmin)
    {
        return view('unit_admins.edit', compact('unitAdmin'));
    }

    public function update(Request $request, UnitAdmin $unitAdmin)
    {
        // Validasi inputan form

        $unitAdmin->unit_id = $request->unit_id;
        $unitAdmin->user_id = $request->user_id;
        $unitAdmin->save();

        return redirect()->route('unit_admins.index')->with('success', 'Unit Admin updated successfully.');
    }

    public function destroy(UnitAdmin $unitAdmin)
    {
        $unitAdmin->delete();

        return redirect()->route('unit_admins.index')->with('success', 'Unit Admin deleted successfully.');
    }
}
