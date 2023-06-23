<?php

namespace App\Http\Controllers;

use App\Models\Usage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UsageController extends Controller
{
    public function index(Request $request)
    {   
        $user = auth()->user();
        $unitId = $user->unit_id;
        $usages = Usage::whereHas('booking', function ($query) use ($unitId) {
            $query->whereHas('item', function ($query) use ($unitId) {
                $query->where('unit_id', $unitId);
            });
        });
        
        $status = $request->query('status');

        if ($status) {
            $usages->where('status', $status);
        }

        $usages = $usages->latest()->paginate(20);

        return view('unitadmin.usages.index', compact('usages'));
    }

    public function show(Usage $usage)
    {
        $user = auth()->user();
        if($user->can('unitadmin')) {
            $unitId = $user->unit_id;
            if ($usage->booking->item->unit_id !== $unitId) {
                abort(403, 'Forbidden');
            }
            return view('unitadmin.usages.show', compact('usage'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'booking_id' => 'required',
            'status' => 'required',
            'due_date' => 'required',
            'note_text' => 'required',
        ]);

        Usage::create($validatedData);

        return redirect()->route('usages.index')->with('success', 'Usage created successfully.');
    }

    public function edit(Usage $usage)
    {
        return view('unitadmin.usages.edit', compact('usage'));
    }

    public function update(Request $request, Usage $usage)
    {
        $validatedData = $request->validate([
            'due_date' => 'required',
            'note_text' => 'nullable|string',
        ]);
    
        $usage->update($validatedData);
    
        return redirect()->route('usages.index')->with('success', 'Usage updated successfully.');
    }

    public function setUsed(Request $request, Usage $usage)
    {
        if ($usage->status == 'used') {
            return redirect()->back()->with('error', 'Item in this usage already set as used.');
        } elseif ($usage->status == 'returned') {
            return redirect()->back()->with('error', 'Borrower need to book the item again.');
        } else if ($usage->status == 'expired') {
            return redirect()->back()->with('error', 'Borrower need to book the item again.');
        }

        $usage->status = 'used';
        $usage->save();
        
        return redirect()->route('usages.index')->with('success', 'Item in usage set as used successfully.');
    }

    public function updateExpiredAndLateUsages()
    {
        $expiredAndLateUsages = Usage::whereIn('status', ['awaiting use', 'used'])
            ->whereDate('due_date', '<', Carbon::today()->toDateString())
            ->get();

        foreach ($expiredAndLateUsages as $usage) {
            $booking = $usage->booking;
            $item = $booking->item;

            if ($usage->status === 'awaiting use') {
                $usage->status = 'expired';
                $usage->save();

                $item->quantity += $booking->quantity;
                $item->save();
            } elseif ($usage->status === 'used') {
                $usage->status = 'late';
                $usage->save();
            }
        }

        return response()->json(['message' => 'Expired and late usages updated successfully.']);
    }
}
