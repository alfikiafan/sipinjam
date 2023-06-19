<?php

namespace App\Http\Controllers;

use App\Models\Usage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsageController extends Controller
{
    public function index()
    {
        $unitId = Auth::user()->unit_id;
        $usages = Usage::whereHas('booking', function ($query) use ($unitId) {
            $query->whereHas('item', function ($query) use ($unitId) {
                $query->where('unit_id', $unitId);
            });
        })->latest()->paginate(20);
    
        return view('unitadmin.usages.index', compact('usages'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'booking_id' => 'required',
            'note_text' => 'required',
        ]);

        Usage::create($validatedData);

        return redirect()->route('unitadmin.usages.index')->with('success', 'Usage created successfully.');
    }

    public function update(Request $request, Usage $usage)
    {
        $validatedData = $request->validate([
            'booking_id' => 'required',
            'note_text' => 'required',
        ]);

        $usage->update($validatedData);

        return redirect()->route('unitadmin.usages.index')->with('success', 'Usage updated successfully.');
    }

    public function destroy(Usage $usage)
    {
        $usage->delete();

        return redirect()->route('unitadmin.usages.index')->with('success', 'Usage deleted successfully.');
    }
}
