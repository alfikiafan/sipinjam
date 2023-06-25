<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Models\Item;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('administrator.units.index', compact('units'));
    }

    public function show(Unit $unit)
    {
        $user = auth()->user();

        if ($user->can('administrator')) {
            $unitAdmins = $unit->users()->where('role', 'unitadmin')->get();

            return view('administrator.units.show', compact('unit', 'unitAdmins'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function create()
    {
        return view('administrator.units.create');
    }

    public function store(Request $request)
    {
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
        $unit->name = $request->name;
        $unit->location = $request->location;
        $unit->save();

        return redirect()->route('administrator.units.index')->with('success', 'Unit updated successfully.');
    }

    public function destroy(Unit $unit)
    {
        if ($unit->items()->count() === 0) {
            $unit->delete();
            return redirect()->route('administrator.units.index')->with('success', 'Unit deleted successfully.');
        }
        
        return redirect()->route('administrator.units.index')->with('error', 'Cannot delete unit. It has items associated with it.');
    }
}
