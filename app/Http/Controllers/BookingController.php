<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index(Request $request)
    {   
        $user = auth()->user();

        if ($user->can('unitadmin')) {
            $unitId = $user->unit_id;
            $bookings = Booking::whereHas('item', function ($query) use ($unitId) {
                $query->where('unit_id', $unitId);
            });

            $status = $request->query('status');

            if ($status) {
                $bookings->where('status', $status);
            }

            $bookings = $bookings->get();

            return view('unitadmin.bookings.index', compact('bookings', 'status'));
        }
        elseif ($user->can('borrower')) {
            $bookings = Booking::where('user_id', $user->id)->get();
            return view('borrower.bookings.index', compact('bookings'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function show(Booking $booking) {
        $user = auth()->user();
        if($user->can('unitadmin')) {
            $unitId = $user->unit_id;
            if ($booking->item->unit_id !== $unitId) {
                abort(403, 'Forbidden');
            }
            return view('unitadmin.bookings.show', compact('booking'));
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

    public function updateExpiredBookings()
    {
        $expiredBookings = Booking::where('status', 'pending')
            ->whereDate('end_date', '<', Carbon::today()->toDateString())
            ->get();

        foreach ($expiredBookings as $booking) {
            $booking->status = 'expired';
            $booking->save();
        }

        return response()->json(['message' => 'Expired bookings updated successfully.']);
    }
}
