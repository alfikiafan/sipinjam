<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unit;

class UnitAdminController extends Controller
{
    public function index()
    {
        $perPage = 10;

        if (auth()->user()->can('administrator')) {
            $unitadmins = User::where('role', 'unitadmin');

            $totalUnitAdmins = $unitadmins->count();
            $totalUnits = Unit::all()->count();
            
            $unitadmins = $unitadmins->paginate($perPage);

            return view('administrator.unitadmins.index', compact('unitadmins', 'totalUnitAdmins', 'totalUnits'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function show(User $unitadmin) {
        if (auth()->user()->can('administrator')) {
        return view('administrator.unitadmins.show', compact('unitadmin'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function create()
    {
        $units = Unit::all();
        return view('administrator.unitadmins.create', compact('units'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'unit_id' => 'required',
        ]);

        $unitadmin = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'phone' => $validatedData['phone'],
            'role' => 'unitadmin',
            'address' => $validatedData['address'],
            'city' => $validatedData['city'],
            'unit_id' => $validatedData['unit_id'],
        ]);

        $unitadmin->save();

        return redirect()->route('unitadmins.index')->with('success', 'Unit administrator created successfully.');
    }

    public function edit(User $unitadmin)
    {
        if(auth()->user()->can('administrator')) {
            $units = Unit::all();
        return view('administrator.unitadmins.edit', compact('unitadmin', 'units'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function update(Request $request, User $unitadmin)
    {
        if ($request->has('unit_id') && $unitadmin->unit_id != $request->unit_id) {
            
            $AdminUnitRemaining = User::where('unit_id', $unitadmin->unit_id)
                ->where('role', 'unitadmin')
                ->where('id', '!=', $unitadmin->id)
                ->count();
        
            if ($AdminUnitRemaining > 0) {
                $unitadmin->unit_id = $request->unit_id;
            } else {
                return redirect()->route('unitadmins.index')->with('error', 'Cannot change unit. There are no other unit administrator with the same unit.');
            }
        }
    
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        $unitadmin->name = $validatedData['name'];
        $unitadmin->phone = $validatedData['phone'];
        $unitadmin->address = $request->address;
        $unitadmin->city = $request->city;
        $unitadmin->save();
    
        return redirect()->route('unitadmins.index')->with('success', 'Unit administrator updated successfully.');
    }
    
    public function destroy(User $unitadmin)
    {       
        $AdminUnitRemaining = User::where('unit_id', $unitadmin->unit_id)
            ->where('role', 'unitadmin')
            ->where('id', '!=', $unitadmin->id)
            ->count();
    
        if ($AdminUnitRemaining > 0) {
            $unitadmin->delete();
            return redirect()->route('unitadmins.index')->with('success', 'Unit administrator deleted successfully.');
        } else {
            return redirect()->route('unitadmins.index')->with('error', 'Cannot delete unit administrator. There are no other unit administrator with the same unit.');
        }
    }
}
