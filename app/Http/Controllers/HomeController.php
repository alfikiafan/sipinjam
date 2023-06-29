<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Random;
use App\Models\Item;
use App\Models\Booking;
use App\Models\Usage;
use App\Models\Category;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
{
    $user = auth()->user();
    
    if ($user->can('administrator')) {
        // Implementasi untuk peran 'administrator'
        // total category
        $totalCategories = Category::from('categories')->count();

        // total unit admin
        $totalUnitadmins = User::where('role', 'unitadmin')->count();

        // total units
        $totalUnits = Unit::from('units')->count();

        // total bookings bulan ini
        $currentMonth = now()->format('m');
        $currentMonthBookings = Booking::whereMonth('created_at', $currentMonth)->count();

        // total items
        $totalAllItems = Item::from('items')->count();

        // total borrower
        $totalUsers = User::where('role', 'borrower')->count();

        // data untuk bookings yang telah di approved dalam 12 bulan terakhir
        $dataBookingsApproved = [];
        $currentDate = now();
        for ($i = 11; $i >= 0; $i--) {
            $date = clone $currentDate;
            $date->subMonths($i)->startOfMonth();
            $count = Booking::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('status', 'approved')
                ->count();
            $dataBookingsApproved[] = $count;
        }

        // data untuk pengembalian barang dalam 12 bulan terakhir
        $dataUsagesReturned = [];
        $currentDate = now();
        for ($i = 11; $i >= 0; $i--) {
            $date = clone $currentDate;
            $date->subMonths($i)->startOfMonth();
            $count = Usage::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('status', 'returned')
                ->count();
            $dataUsagesReturned[] = $count;
        }

        // data untuk permintaan peminjaman barang dalam 12 bulan terakhir
        $dataBookingsRequest = [];
        $currentDate = now();
        for ($i = 11; $i >= 0; $i--) {
            $date = clone $currentDate;
            $date->subMonths($i)->startOfMonth();
            $count = Booking::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('status', 'pending')
                ->count();
            $dataBookingsRequest[] = $count;
        }

        $randomNumber = random_int(0, 10);
        $randomNumber2 = random_int(0, 5);
        $randomNumber3 = random_int(0, 5);
        $randomNumber4 = random_int(0, 5);
    
        return view('administrator.dashboard', compact(
            'totalCategories',
            'totalUnits',
            'totalUnitadmins',
            'currentMonthBookings',
            'totalAllItems',
            'totalUsers',
            'dataBookingsApproved',
            'dataUsagesReturned',
            'dataBookingsRequest',
            'randomNumber',
            'randomNumber2',
            'randomNumber3',
            'randomNumber4',
        ));

    } elseif ($user->can('unitadmin')) {
        $unitId = $user->unit_id;
        
        // Menghitung total item
        $totalItems = Item::where('unit_id', $unitId)->count();
        
        // Menghitung item yang tersedia
        $itemsAvailable = Item::where('unit_id', $unitId)->where('status', 'available')->count();
        
        // Menghitung item yang kosong
        $emptyItems = Item::where('unit_id', $unitId)->where('status', 'empty')->count();
        
        // Menghitung penggunaan aktif
        $activeUsagesCount = Usage::join('bookings', 'usages.booking_id', '=', 'bookings.id')
            ->join('items', 'bookings.item_id', '=', 'items.id')
            ->where('items.unit_id', $unitId)
            ->where('usages.status', 'used')
            ->count();
        
        // Menghitung booking yang masih dalam status 'pending'
        $pendingBookings = Booking::where('status', 'pending')
            ->whereHas('item', function ($query) use ($unitId) {
                $query->where('unit_id', $unitId);
            })
            ->count();
        
        // Menghitung booking yang ditolak
        $rejectedBookings = Booking::where('status', 'rejected')
            ->whereHas('item', function ($query) use ($unitId) {
                $query->where('unit_id', $unitId);
            })
            ->count();
        
        // Menghitung booking yang dibatalkan
        $cancelledBookings = Booking::where('status', 'cancelled')
            ->whereHas('item', function ($query) use ($unitId) {
                $query->where('unit_id', $unitId);
            })
            ->count();
        
        // Menghitung penggunaan yang terlambat
        $lateUsagesCount = Usage::where('status', 'late')
            ->whereHas('booking', function ($query) use ($unitId) {
                $query->whereHas('item', function ($query) use ($unitId) {
                    $query->where('unit_id', $unitId);
                });
            })
            ->count();
        
        // Mengambil daftar booking yang masih dalam status 'pending'
        $bookings = Booking::whereHas('item', function ($query) use ($unitId) {
                $query->where('unit_id', $unitId);
            })
            ->where('status', 'pending')
            ->get();

        // Mengambil daftar usage yang statusnya 'used'
        $activeUsages = Usage::whereHas('booking', function ($query) use ($unitId) {
                $query->whereHas('item', function ($query) use ($unitId) {
                    $query->where('unit_id', $unitId);
                });
            })
            ->where('status', 'used')
            ->get();

        // Mengambil daftar usage yang statusnya 'late'
        $lateUsages = Usage::whereHas('booking', function ($query) use ($unitId) {
                $query->whereHas('item', function ($query) use ($unitId) {
                    $query->where('unit_id', $unitId);
                });
            })
            ->where('status', 'late')
            ->get();
        
        // Mendapatkan data booking requests dari 12 bulan terakhir
        $bookingRequestsData = [];
        $currentDate = now();
        for ($i = 11; $i >= 0; $i--) {
            $date = clone $currentDate;
            $date->subMonths($i)->startOfMonth();
            $count = Booking::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->whereHas('item', function ($query) use ($unitId) {
                    $query->where('unit_id', $unitId);
                })
                ->count();
            $bookingRequestsData[] = $count;
        }
        
        // Mendapatkan data approved bookings dari 12 bulan terakhir
        $approvedBookingsData = [];
        $currentDate = now();
        for ($i = 11; $i >= 0; $i--) {
            $date = clone $currentDate;
            $date->subMonths($i)->startOfMonth();
            $count = Usage::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->whereHas('booking', function ($query) use ($unitId) {
                    $query->whereHas('item', function ($query) use ($unitId) {
                        $query->where('unit_id', $unitId);
                    });
                })
                ->count();
            $approvedBookingsData[] = $count;
        }
            return view('unitadmin.dashboard', compact(
                'totalItems',
                'itemsAvailable',
                'emptyItems',
                'activeUsagesCount',
                'pendingBookings',
                'rejectedBookings',
                'cancelledBookings',
                'lateUsagesCount',
                'bookings',
                'bookingRequestsData',
                'approvedBookingsData',
                'activeUsages',
                'lateUsages',
            ));
        } elseif ($user->can('borrower')) {
            return view('borrower.dashboard', compact('user'));

        } else {
            abort(403, 'Forbidden');
        }
    }
}
