<?php

namespace App\Http\Controllers;

use App\Models\Usage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReturnController extends Controller
{
    public function show(Usage $usage)
    {
        $user = auth()->user();
        if ($user->can('unitadmin')) {
            $unitId = $user->unit_id;

            if ($usage->status == 'awaiting use') {
                return redirect()->back()->with('error', 'Cannot return an item that is still awaiting use.');
            } elseif ($usage->status == 'returned') {
                return redirect()->back()->with('error', 'Cannot return an item that has already been returned.');
            }

            if ($usage->booking->item->unit_id !== $unitId) {
                abort(403, 'Forbidden');
            }

            return view('unitadmin.usages.return', compact('usage'));
        } else {
            abort(403, 'Forbidden');
        }
    }
    
    public function return(Request $request, Usage $usage)
    {
        $user = auth()->user();
        if ($user->can('unitadmin')) {
            if ($usage->status == 'awaiting use') {
                return redirect()->back()->with('error', 'Cannot return an item that is still awaiting use.');
            } elseif ($usage->status == 'returned') {
                return redirect()->back()->with('error', 'Cannot return an item that has already been returned.');
            }
        
            $validatedData = $request->validate([
                'note_text' => 'nullable|string',
            ]);
            
            $usage->note_text = $validatedData['note_text'];            
            $usage->status = 'returned';
            $usage->save();
        
            $item = $usage->booking->item;
            
            $item->quantity += $usage->booking->quantity;
            $item->save();
        
            if ($usage->save()) {
                return redirect()->route('usages.index')->with('success', 'Item from usage returned successfully.');
            } else {
                return redirect()->route('usages.index')->with('error', 'Failed to return item from usage.');
            }
        } else {
            abort(403, 'Forbidden');
        }
    }    
}