<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Usage;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApprovalController extends Controller
{
    public function show(Booking $booking)
    {
        $user = auth()->user();
        if ($user->can('unitadmin')) {
            $unitId = $user->unit_id;

            if ($booking->status !== 'pending') {
                return redirect()->back()->with('error', 'Cannot approve a booking that is not pending.');
            }

            if ($booking->item->unit_id !== $unitId) {
                abort(403, 'Forbidden');
            }

            return view('unitadmin.bookings.approve', compact('booking'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function approve(Request $request, Booking $booking)
    {
        $user = auth()->user();
        $item = $booking->item;
        if ($booking->status !== 'pending') {
            return redirect()->back()->with('error', 'Cannot approve a booking that is not pending.');
        } elseif ($item->quantity < $booking->quantity) {
            return redirect()->route('bookings.index')->with('error', 'Not enough items in stock.');
        }
        
        if ($user->can('unitadmin')) {
            $request->validate([
                'due_date' => 'required|date',
                'note_text' => 'nullable|string',
            ]);
        
            $booking->status = 'approved';
            $booking->save();
        
            $usage = Usage::create([
                'booking_id' => $booking->id,
                'status' => 'awaiting use',
                'due_date' => $request->due_date,
                'note_text' => $request->note_text,
            ]);
        
            $item = $booking->item;
            
            $item->quantity -= $booking->quantity;
            $item->save();
        
            if ($booking->save() && $usage->save()) {
                return redirect()->route('bookings.index')->with('success', 'Booking approved successfully.');
            } else {
                return redirect()->route('bookings.index')->with('error', 'Failed to approve booking.');
            }
        } else {
            abort(403, 'Forbidden');
        }
    }    
    
    public function reject(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return redirect()->back()->with('error', 'Cannot approve a booking that is not pending.');
        }

        $user = auth()->user();
        if ($user->can('unitadmin')) {
            $booking->status = 'rejected';
            $booking->save();
            
            return redirect()->route('bookings.index');
        } else {
            abort(403, 'Forbidden');
        }
    }
}
