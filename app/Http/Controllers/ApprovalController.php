<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Usage;
use App\Models\Item;
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
            $validatedData = $request->validate([
                'due_date' => 'required|date',
                'note' => 'nullable|string',
            ]);
        
            $booking->status = 'approved';
            $booking->save();
        
            $usage = Usage::create([
                'booking_id' => $booking->id,
                'status' => 'awaiting use',
                'due_date' => $validatedData['due_date'],
                'note' => $validatedData['note'],
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

    public function generateApprovalLetter()
    {
        $data = [
            'unit' => 'Nama Unit',
            'name' => 'Nama Peminjam',
            'id' => 'ID Peminjam',
            'email' => 'Email Peminjam',
            'phone' => 'Nomor Telepon Peminjam',
            'itemName' => 'Nama Barang',
            'quantity' => 'Jumlah',
            'startDate' => 'Tanggal Mulai',
            'endDate' => 'Tanggal Selesai',
            'dueDate' => 'Tanggal Pengembalian',
            'usageNote' => 'Catatan Penggunaan',
            'adminUnit' => 'Unit Admin',
            'adminName' => 'Nama Admin',
            'adminPhone' => 'Nomor Telepon Admin',
            'createdAt' => 'Tanggal dan Waktu Persetujuan',
        ];

        $pdf = PDF::loadView('borrower.bookings.print-approval', $data)->setOptions([
            'defaultFont' => 'Roboto',
        ]);
        
        return response($pdf->stream('approval_letter.pdf'), 200)
            ->header('Content-Type', 'application/pdf');
    }
}
