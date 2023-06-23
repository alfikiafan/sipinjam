@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="container-fluid px-3">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="m-0">Booking Approval</h6>
          <p class="text-sm mb-0">Evaluate the booking and approve it.</p>
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
                      <p class="mb-1"><strong>{{ $booking->user->name }}</strong></p>
                      <p class="mb-0 text-sm">{{ $booking->user->email }}</p>
                      <p class="mb-0 text-sm">{{ $booking->user->phone }}</p>
                  </div>
              </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-6">
              <img src="{{ asset($booking->item->photo) }}" alt="Item Photo" class="img-fluid rounded mb-2" style="max-height: 150px; width: auto;">
              <h5 class="m-0">{{ $booking->item->name }}</h5>
              <p>{{ $booking->item->serial_number }}</p>
            </div>
            <div class="col-md-6">
              <p><strong>Category:</strong> {{ $booking->item->category->name }}</p>
              <p><strong>Quantity:</strong> {{ $booking->quantity }}</p>
              <p><strong>Start Date:</strong> {{ $booking->start_date }}</p>
              <p><strong>End Date:</strong> {{ $booking->end_date }}</p>
            </div>
          </div>
          <hr>
          <form method="POST" action="{{ route('bookings.approve', ['booking' => $booking->id]) }}">
            @csrf
            <div class="mb-3">
              <label for="due_date" class="form-label">Due Date</label>
              <input type="date" class="form-control" id="due_date" name="due_date" required>
            </div>
            <div class="mb-3">
              <label for="note_text" class="form-label">Note</label>
              <textarea class="form-control" id="note_text" name="note_text" rows="4"></textarea>
            </div>
            <div class="mt-4">
              <button type="submit" class="btn bg-gradient-primary me-2">Approve</button>
              <a href="{{ route('bookings.index') }}" class="btn bg-gradient-info">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection