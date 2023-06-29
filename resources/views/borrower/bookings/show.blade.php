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
          <p><strong>Admin Unit:</strong><br>
            <span>
              @php
                  $usage = App\Models\Usage::where('booking_id', $booking->id)->first();
                  $user = App\Models\User::find($booking->user_id);
              @endphp
              @if ($user)
                  {{ $user->name }}
              @endif
          </span>
          </p>
        </div>
        <div class="col-md-4">
          <p><strong>Created At:</strong><br>{{ $booking->created_at }}</p>
          <p><strong>Start Date:</strong><br>{{ $booking->start_date }}</p>
          <p><strong>End Date:</strong><br>{{ $booking->end_date }}</p>
          <p><strong>Due Date:</strong><br>
            <span>
                @php
                    $usage = App\Models\Usage::where('booking_id', $booking->id)->first();
                @endphp
                @if ($usage)
                    {{ $usage->due_date }}
                @endif
            </span>
        </p>
        </div>
      </div>
      <hr>
      <div class="col-md-6 mt-4">
        <a href="" class="btn bg-gradient-info" id="backButton">Back</a>
      </div>
    </div>
  </div>
</div>

@endsection