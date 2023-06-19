<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('administrator.units.index', compact('units'));
    }

    public function create()
    {
        return view('administrator.units.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan form

        $unit = new Unit([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        $unit->save();

        return redirect()->route('administrator.units.index')->with('success', 'Unit created successfully.');
    }

    public function edit(Unit $unit)
    {
        return view('administrator.units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        // Validasi inputan form

        $unit->name = $request->name;
        $unit->location = $request->location;
        $unit->save();

        return redirect()->route('administrator.units.index')->with('success', 'Unit updated successfully.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();

        return redirect()->route('administrator.units.index')->with('success', 'Unit deleted successfully.');
    }
}
