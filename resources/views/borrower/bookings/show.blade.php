@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="card mx-3 mb-4">
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
          <p><strong>Category:</strong><br>{{ $booking->item->category->name }}</p>
          <p><strong>Quantity:</strong><br>{{ $booking->quantity }}</p>
        </div>
        <div class="col-md-4">
          <p><strong>Booked at:</strong><br>{{ $booking->created_at }}</p>
          <p><strong>Start date:</strong><br>{{ $booking->start_date }}</p>
          <p><strong>End date:</strong><br>{{ $booking->end_date }}</p>
          @if ($booking->usage)
          <p><strong>Due date:</strong><br>
            <span>
                {{ $booking->usage->due_date }}
            </span>
          </p>
          @endif
        </div>
      </div>
      <hr>
      <div class="row gx-4">
        <p class="text-dark"><strong>Responsible unit admin(s):</strong></p>
        @foreach ($unitAdmins as $admin)
        <div class="col-md-4 mb-4 pe-4">
          <div class="row-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="{{ asset($admin->photo) }}" alt="..." class="w-100 border-radius-lg shadow-sm image-hover">
            </div>
          </div>
          <div class="row-auto my-auto">
            <div class="h-100 me-3">
              <p class="mb-1"><strong>{{ $admin->name }}</strong></p>
              <p class="mb-0 text-sm">{{ $admin->email }}</p>
              <p class="mb-0 text-sm">{{ $admin->phone }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <hr>
      <div class="col-md-6 mt-4">
        <a href="" class="btn bg-gradient-info me-2" id="backButton">Back</a>
        @if ($booking->status === 'pending')
        <a href="{{ route('bookings.cancel', ['booking' => $booking->id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure to cancel this booking?')">Cancel Booking</a>
        @elseif ($booking->status === 'approved')
        <a href="{{ route('bookings.approval', ['booking' => $booking->id]) }}" class="btn btn-success" target="_blank">Print Approval</a>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection