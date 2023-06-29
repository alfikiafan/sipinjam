<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Unit;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $perPage = 10;
    
        if ($user->can('unitadmin')) {
            $unitId = $user->unit_id;
            $bookings = Booking::whereHas('item', function ($bookings) use ($unitId) {
                $bookings->where('unit_id', $unitId);
            });
    
            $status = $request->query('status');
    
            if ($status) {
                $bookings->where('status', $status);
            }

            $totalBookings = $bookings->count();
            $totalBorrowers = $bookings->pluck('user_id')->unique()->count();
            $totalItems = $bookings->pluck('item_id')->unique()->count();

            $bookings = $bookings->paginate($perPage);
            $bookings->appends(['status' => $status]);
    
            return view('unitadmin.bookings.index', compact('bookings', 'totalBookings', 'totalBorrowers', 'totalItems'));
        
        } elseif ($user->can('borrower')) {

            Item::where('quantity', 0)
                ->update(['status' => 'empty']);
    
            $bookings = Booking::where('user_id', $user->id);
    
            $status = $request->query('status');
    
            if ($status) {
                $bookings->where('status', $status);
            }

            $totalBookings = $bookings->count();
            $totalItems = $bookings->pluck('item_id')->unique()->count();
    
            $bookings = $bookings->paginate($perPage);
            $bookings->appends(['status' => $status]);
    
            return view('borrower.bookings.index', compact('bookings', 'totalBookings', 'totalItems'));
       
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
        } elseif ($user->can('borrower')) {
            return view('borrower.bookings.show', compact('booking'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function create(Item $item)
    {
        $user = auth()->user();
        if($user->can('borrower')) {
            return view('borrower.bookings.create', compact('item'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->can('borrower')) {
            $validatedData = $request->validate([
                'item_id' => 'required',
                'quantity' => 'required|numeric|min:1',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
            ]);

            // if item quantity is === 0, cannot book
            $item = Item::find($validatedData['item_id']);
            if ($item->quantity === 0) {
                return redirect()->back()->with('error','Item is out of stock.')->withInput();
            }

            // if item quantity is less than requested quantity, cannot book
            if ($item->quantity < $validatedData['quantity']) {
                return redirect()->back()->with('error','Requested quantity is more than available item.')->withInput();
            }

            // Check if start_date is greater than end_date
            if (strtotime($validatedData['start_date']) > strtotime($validatedData['end_date'])) {
                return redirect()->back()->with('error','Start date must be before the end date.')->withInput();
            }

            $validatedData['status'] = 'pending';
            $validatedData['user_id'] = $user->id;

            $booking = new Booking($validatedData);
            if ($booking->save()) {
                return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
            } else {
                return redirect()->back()->with('error','Failed to create booking. Please try again.');
            }
        } else {
            abort(403, 'Forbidden');
        }
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
