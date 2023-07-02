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

        // total category
        $totalCategories = Category::from('categories')->count();

        // total unit admin
        $totalUnitadmins = User::where('role', 'unitadmin')->count();

        // total units
        $totalUnits = Unit::from('units')->count();

        // total bookings bulan ini
        $firstCurrentMonthDate = Carbon::now()->startOfMonth();
        $currentMonthBookings = Booking::where('created_at', '>=', $firstCurrentMonthDate)
            ->count();

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
            $count = Usage::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
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

        // Mendapatkan data usages returned dari 12 bulan terakhir
        $usagesReturnedData = [];
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
                ->where('status', 'returned')
                ->count();
            $usagesReturnedData[] = $count;
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
                'usagesReturnedData',
                'activeUsages',
                'lateUsages',
            ));
        } elseif ($user->can('borrower')) {
            $Borrower = $user->id;
            
            // Menghitung item yang tersedia
            $itemsAvailable = Item::where('status', 'available')->count();

            // Menghitung total booking yang dimiliki oleh user
            $Bookings = Booking::where('user_id', $Borrower)->count();
            
            // Menghitung booking yang masih dalam status 'pending'
            $all_pendingBookings = Booking::where('status', 'pending')
                ->where('user_id', $Borrower)
                ->count();
            
            // Menghitung booking yang masih dalam status 'approved'
            $all_approvedBookings = Booking::where('status', 'approved')
                ->where('user_id', $Borrower)
                ->count();
            
            // Menghitung booking yang masih dalam status 'rejected'
            $all_rejectedBookings = Booking::where('status', 'rejected')
                ->where('user_id', $Borrower)
                ->count();
            
            // Menghitung booking yang masih dalam status 'cancelled'
            $all_cancelledBookings = Booking::where('status', 'cancelled')
                ->where('user_id', $Borrower)
                ->count();
            
            // Mengambil daftar booking yang masih dalam status 'approved'
            $approvedBookings = Booking::with(['item', 'item.unit', 'item.category'])
                ->where('user_id', $Borrower)
                ->where('status', 'approved')
                ->get();
                

            // Mengambil daftar booking yang masih dalam status 'pending'
            $pendingBookings = Booking::with(['item', 'item.unit', 'item.category'])
                ->where('user_id', $Borrower)
                ->where('status', 'pending')
                ->get();
            
            // Mengambil daftar booking yang masih dalam status 'cancelled'
            $cancelledBookings = Booking::with(['item', 'item.unit', 'item.category'])
                ->where('user_id', $Borrower)
                ->where('status', 'cancelled')
                ->get();

            // Mengambil daftar booking yang masih dalam status 'rejected'
            $rejectedBookings = Booking::with(['item', 'item.unit', 'item.category'])
                ->where('user_id', $Borrower)
                ->where('status', 'rejected')
                ->get();


            return view('borrower.dashboard', compact(
                'itemsAvailable',
                'Bookings',
                'all_approvedBookings',
                'all_pendingBookings',
                'all_rejectedBookings',
                'all_cancelledBookings',
                'approvedBookings',
                'pendingBookings',
                'rejectedBookings',
                'cancelledBookings',
            ));

        } else {
            abort(403, 'Forbidden');
        }
    }
}
