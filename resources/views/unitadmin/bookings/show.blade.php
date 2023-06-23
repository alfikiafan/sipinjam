@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  <div class="container-fluid px-3">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6 class="m-0">Booking Detail</h6>
            <p class="text-sm mb-0">Show detail the booking</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <img src="{{ asset($booking->item->photo) }}" alt="Item Photo" class="img-fluid rounded" style="max-height: 150px; width: auto;">
                <h5 class="m-0">{{ $booking->item->name }}</h5>
                <p>{{ $booking->item->serial_number }}</p>
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
                </p>
                <p><strong>Borrower:</strong><br>{{ $booking->user->name }}</p>
                  <p><strong>Email:</strong><br>{{ $booking->user->email }}</p>
                </div>
                <div class="col-md-4">
                  <p><strong>Start Date:</strong><br>{{ $booking->start_date }}</p>
                  <p><strong>End Date:</strong><br>{{ $booking->end_date }}</p>
                  <p><strong>Quantity:</strong><br>{{ $booking->quantity }}</p>
                </div>
              </div>
              <hr>
              <div class="col-md-6 mt-4">
                <a href="{{ route('bookings.index') }}" class="btn btn-info">Back</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection