<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if($user->can('unitadmin')) {
            $unitId = $user->unit_id;
            $bookings = Booking::whereHas('item', function ($query) use ($unitId) {
                $query->where('unit_id', $unitId);
            })->get();
            
            return view('unitadmin.bookings.index', compact('bookings'));
        } elseif ($user->can('borrower')) {
            $bookings = Booking::where('user_id', $user->id)->get();
            return view('borrower.bookings.index');
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function create()
    {
        return view('borrower.bookings.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if($user->can('borrower')) {
            $validatedData = $request->validate([
                'item_id' => 'required',
                'user_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'status' => 'required',
            ]);
            $booking = Booking::create($validatedData);
            return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function update(Request $request, Booking $booking)
    {
        $validatedData = $request->validate([
            'item_id' => 'required',
            'user_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);

        $booking->update($validatedData);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function approve(Booking $booking)
    {
        $user = auth()->user();
        if($user->can('unitadmin')) {
            $booking->status = 'approved';
            $booking->save();
            
            return redirect()->back();
        } else {
            abort(403, 'Forbidden');
        }
    }
    
    public function reject(Booking $booking)
    {
        $user = auth()->user();
        if ($user->can('unitadmin')) {
            $booking->status = 'rejected';
            $booking->save();
            
            return redirect()->back();
        } else {
            abort(403, 'Forbidden');
        }
    }
}
