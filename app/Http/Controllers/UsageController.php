<?php

namespace App\Http\Controllers;

use App\Models\Usage;
use Illuminate\Http\Request;

class UsageController extends Controller
{
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
