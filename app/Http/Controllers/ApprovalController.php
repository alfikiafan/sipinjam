<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Usage;
use App\Models\Item;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PDF;

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

            $unitAdminId = $user->id;
            $validatedData = $request->validate([
                'due_date' => 'required|date',
                'note' => 'nullable|string',
            ]);
        
            $booking->status = 'approved';
            $booking->save();
        
            $usage = Usage::create([
                'user_id' => $unitAdminId,
                'booking_id' => $booking->id,
                'status' => 'awaiting use',
                'due_date' => $validatedData['due_date'],
                'note' => $validatedData['note'],
            ]);
        
            $item = $booking->item;
            $item->quantity -= $booking->quantity;

            if ($item->quantity == 0) {
                $item->status = 'empty';
            }

            if ($item->quantity < 0) {
                return redirect()->route('bookings.index')->with('error', 'Not enough items in stock.');
            }

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
            
            return redirect()->route('bookings.index')->with('success', 'Booking has been rejected.');
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function cancel(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return redirect()->back()->with('error', 'Cannot cancel a booking that is not pending.');
        }

        $user = auth()->user();
        if ($user->can('borrower')) {
            $booking->status = 'cancelled';
            $booking->save();
            
            return redirect()->route('bookings.index')->with('success', 'Your booking has been cancelled.');
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function generateApprovalLetter(Booking $booking)
    {
        $user = $booking->user;

        if ($user->id !== auth()->user()->id) {
            return redirect()->route('bookings.index')->with('error', 'You are not authorized to access this booking.');
        } elseif (!$booking) {
            return redirect()->route('bookings.index')->with('error', 'The provided booking ID was not found.');
        } elseif ($booking->status !== 'approved') {
            return redirect()->route('bookings.index')->with('error', 'The provided booking ID is not approved');
        } else {

            $item = Item::find($booking->item_id);
            $unit = Unit::find($item->unit_id);
            $usage = Usage::where('booking_id', $booking->id)->first();
            $adminUnit = User::where('unit_id', $item->unit_id)->where('role', 'unitadmin')->first();

            $data = [
                'unit' => $unit->name,
                'unitLocation' => $unit->location,
                'usageId' => $usage->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'itemName' => $item->name,
                'bookId' => $booking->id,
                'quantity' => $booking->quantity,
                'startDate' => $booking->start_date,
                'endDate' => $booking->end_date,
                'dueDate' => $usage->due_date,
                'usageNote' => $usage->note,
                'adminName' => $adminUnit->name,
                'adminPhone' => $adminUnit->phone,
                'createdAt' => $usage->created_at,
            ];

            $pdf = PDF::loadView('borrower.bookings.print-approval', $data)->setOptions([
                'defaultFont' => 'Roboto',
            ]);

            return response($pdf->stream('approval_letter.pdf'), 200)
                ->header('Content-Type', 'application/pdf');
        }
    }
}
