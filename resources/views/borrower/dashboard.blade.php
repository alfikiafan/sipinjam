@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="row px-3">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="{{ route('items.index') }}">
            <div class="card h-100">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Items Available</p>
                                <h5 class="font-weight-bolder mb-0">{{ $itemsAvailable }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-lg fa-cubes opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="{{ route('bookings.index', ['status' => 'rejected']) }}">
            <div class="card h-100">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Rejected Bookings</p>
                                <h5 class="font-weight-bolder mb-0">{{ $all_rejectedBookings }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-ban fa-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="{{ route('bookings.index', ['status' => 'approved']) }}">
            <div class="card h-100">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Approved Bookings</p>
                                <h5 class="font-weight-bolder mb-0">{{ $all_approvedBookings }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-check fa-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="{{ route('bookings.index', ['status' => 'pending']) }}">
            <div class="card h-100">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Pending Bookings</p>
                                <h5 class="font-weight-bolder mb-0">{{ $all_pendingBookings }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-hourglass-start fa-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="{{ route('bookings.index') }}">
            <div class="card h-100 mt-3">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Your Booking Total</p>
                                <h5 class="font-weight-bolder mb-0">{{ $Bookings }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-lg fa-cubes opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="{{ route('bookings.index', ['status' => 'cancelled']) }}">
            <div class="card h-100 mt-3">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Cancelled Bookings</p>
                                <h5 class="font-weight-bolder mb-0">{{ $all_cancelledBookings }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-xmark fa-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row px-3 mt-5">
    <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row">
                    <div class="d-flex flex-column h-100">
                        <h5 class="font-weight-bolder ps-3">Welcome,</h5>
                        <p class="mb-1 ps-3 text-sm">You are logged in as Borrower</p>
                        <p class="mb-1 ps-3 text-sm">Choose a menu below to get started:</p>
                        <div class="card my-3 overflow-hidden"
                            style="background-image: url('{{ asset('assets/img/curved-images/curved14.jpg') }}');">
                            <span class="mask bg-gradient-dark"></span>
                            <div class="card-body overflow-hidden position-relative border-radius-xl p-3">
                                <h6 class="card-title text-white">Items</h6>
                                <p class="card-text text-sm mb-2 text-white">List of all available items.</p>
                                <a href="{{ route('items.index') }}"
                                    class="text-primary font-weight-bold underline">See More</a>
                            </div>
                        </div>
                        <div class="card mb-3 overflow-hidden"
                            style="background-image: url('{{ asset('assets/img/curved-images/curved14.jpg') }}');">
                            <span class="mask bg-gradient-dark"></span>
                            <div class="card-body overflow-hidden position-relative border-radius-xl p-3">
                                <h6 class="card-title text-white">Bookings</h6>
                                <p class="card-text text-sm mb-2 text-white">View your bookings.</p>
                                <a href="{{ route('bookings.index') }}"
                                    class="text-primary font-weight-bold underline">See More</a>
                            </div>
                        </div>
                        <div class="card mb-3 overflow-hidden"
                            style="background-image: url('{{ asset('assets/img/curved-images/curved14.jpg') }}');">
                            <span class="mask bg-gradient-dark"></span>
                            <div class="card-body overflow-hidden position-relative border-radius-xl p-3">
                                <h6 class="card-title text-white">User Profile</h6>
                                <p class="card-text text-sm mb-2 text-white">Manages your profile.</p>
                                <a href="{{ route('profile.index') }}"
                                    class="text-primary font-weight-bold underline">See More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card h-100">
            <div class="mx-2 mt-4 mb-0">
                <h5 class="font-weight-bolder ps-3">Your Booking Request</h5>
            </div>
            <div class="card-header pb-0">
                <h6>Approved</h6>
            </div>
            <div class="card-body">
                <div class="timeline timeline-one-side">
                    @php
                        $sortedBookings = $approvedBookings->sortByDesc('created_at')->take(2);;
                    @endphp
                    @foreach ($sortedBookings as $booking)
                        <a href="{{ route('bookings.show', ['booking' => $booking->id]) }}">
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i><img src="{{ asset($booking->item->photo) }}" class="avatar avatar-sm"
                                            alt="item-image"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm mb-0">{{ $booking->item->name }} | <span class="text-secondary">{{ $booking->item->category->name }} | <span class="text-secondary">{{ $booking->item->brand }}</span></h6>
                                    <p class="text-sm mt-1 mb-0"><span class="text-dark">{{ $booking->item->unit->name }}</span> | <span class="text-secondary">{{ $booking->created_at }}</span></p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div> 
            </div>

            <div class="card-header pb-0">
                <h6>Pending</h6>
            </div>
            <div class="card-body">
                <div class="timeline timeline-one-side">
                    @php
                        $sortedBookings = $pendingBookings->sortByDesc('created_at')->take(2);;
                    @endphp
                    @foreach ($sortedBookings as $booking)
                        <a href="{{ route('bookings.show', ['booking' => $booking->id]) }}">
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i><img src="{{ asset($booking->item->photo) }}" class="avatar avatar-sm"
                                            alt="item-image"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm mb-0">{{ $booking->item->name }} | <span class="text-secondary">{{ $booking->item->category->name }} | <span class="text-secondary">{{ $booking->item->brand }}</span></h6>
                                    <p class="text-sm mt-1 mb-0"><span class="text-dark">{{ $booking->item->unit->name }}</span> | <span class="text-secondary">{{ $booking->created_at }}</span></p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div> 
            </div>    
        </div>
    </div>
</div>

<div class="row px-3 my-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0">
                <h6>Cancelled</h6>
            </div>
            <div class="card-body">
                <div class="timeline timeline-one-side">
                    @php
                        $sortedBookings = $cancelledBookings->sortByDesc('created_at')->take(2);;
                    @endphp
                    @foreach ($sortedBookings as $booking)
                        <a href="{{ route('bookings.show', ['booking' => $booking->id]) }}">
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i><img src="{{ asset($booking->item->photo) }}" class="avatar avatar-sm"
                                            alt="item-image"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm mb-0">{{ $booking->item->name }} | <span class="text-secondary">{{ $booking->item->category->name }} | <span class="text-secondary">{{ $booking->item->brand }}</span></h6>
                                    <p class="text-sm mt-1 mb-0"><span class="text-dark">{{ $booking->item->unit->name }}</span> | <span class="text-secondary">{{ $booking->created_at }}</span></p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div> 
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0">
                <h6>Rejected</h6>
            </div>  
            <div class="card-body">
                <div class="timeline timeline-one-side">
                    @php
                        $sortedBookings = $rejectedBookings->sortByDesc('created_at')->take(2);;
                    @endphp
                    @foreach ($sortedBookings as $booking)
                        <a href="{{ route('bookings.show', ['booking' => $booking->id]) }}">
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i><img src="{{ asset($booking->item->photo) }}" class="avatar avatar-sm"
                                            alt="item-image"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm mb-0">{{ $booking->item->name }} | <span class="text-secondary">{{ $booking->item->category->name }} | <span class="text-secondary">{{ $booking->item->brand }}</span></h6>
                                    <p class="text-sm mt-1 mb-0"><span class="text-dark">{{ $booking->item->unit->name }}</span> | <span class="text-secondary">{{ $booking->created_at }}</span></p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection