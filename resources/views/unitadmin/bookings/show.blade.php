@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="card mx-3 mb-4">
  <div class="card-header pb-0">
    <h6 class="m-0">Booking Detail</h6>
    <p class="text-sm mb-0">Show detail the booking</p>
  </div>
  <div class="card-body">
    <div class="row gx-4">
      <p class="text-dark"><strong>Borrower:</strong></p>
        <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
                <img src="{{ asset($booking->user->photo) }}" alt="..." class="w-100 border-radius-lg shadow-sm image-hover">
            </div>
        </div>
        <div class="col-auto my-auto">
            <div class="h-100 me-3">
                <p class="mb-1"><strong>{{ $booking->user->name }}</strong> (ID: {{ $booking->user->id }})</p>
                <p class="mb-0 text-sm">{{ $booking->user->email }}</p>
                <p class="mb-0 text-sm">{{ $booking->user->phone }}</p>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-4">
        <img src="{{ asset($booking->item->photo) }}" alt="Item Photo" class="img-fluid rounded" style="max-height: 150px; width: auto;"><br>
        <h5 class="mb-0 mt-2 d-inline-block">{{ $booking->item->name }}</h5>
        <p class="d-inline-block"></p>
        <p class="m-0 d-inline-block">(ID: {{ $booking->item->id }})</p>
        <p class="m-0">Serial: {{ $booking->item->serial_number }}</p>
      </div>
      <div class="col-md-4">
        <p><strong>Status:</strong><br>
          @if ($booking->status === 'pending')
            <span class="badge bg-primary badge-sm">{{ $booking->status }}</span>
          @elseif ($booking->status === 'rejected')
            <span class="badge bg-danger badge-sm">{{ $booking->status }}</span>
          @elseif ($booking->status === 'cancelled')
            <span class="badge bg-secondary badge-sm">{{ $booking->status }}</span>
          @else
            <span class="badge bg-success badge-sm">{{ $booking->status }}</span>
          @endif
          <p><strong>Category:</strong><br>{{ $booking->item->category->name }}</p>
          <p><strong>Quantity:</strong><br>{{ $booking->quantity }}</p>
        </div>
        <div class="col-md-4">
          <p><strong>Created At:</strong><br>{{ $booking->created_at }}</p>
          <p><strong>Start Date:</strong><br>{{ $booking->start_date }}</p>
          <p><strong>End Date:</strong><br>{{ $booking->end_date }}</p>
        </div>
      </div>
      <hr>
      <div class="row">
          <div class="col-md-12 mt-4">
              <a href="{{ route('bookings.index') }}" class="btn btn-info me-2">Back</a>
              @if ($booking->status === 'pending')
                <a href="{{ route('bookings.approve.show', ['booking' => $booking->id]) }}" class="btn btn-success me-2">Approve</a>
                <a href="{{ route('bookings.reject', ['booking' => $booking->id]) }}" class="btn btn-danger" id="rejectBooking">Reject</a>
              @endif
          </div>
      </div>
    </div>
  </div>
</div>

@endsection