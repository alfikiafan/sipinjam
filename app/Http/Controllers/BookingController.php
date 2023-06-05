<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan form
        $validatedData = $request->validate([
            'item_id' => 'required',
            'user_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);

        $booking = Booking::create($validatedData);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        // Validasi inputan form
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

        public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        
        $booking->status = 'approved';
        $booking->save();
        
        return redirect()->route('bookings.index')->with('success', 'Booking approved successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
