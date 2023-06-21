@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  <div class="container-fluid px-3">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6 class="m-0">Booking Approval</h6>
            <p class="text-sm mb-0">Evaluate the booking and approve it.</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <img src="{{ asset($booking->item->photo) }}" alt="Item Photo" class="img-fluid rounded mb-2" style="max-height: 150px; width: auto;">
                <h5 class="m-0">{{ $booking->item->name }}</h5>
                <p>{{ $booking->item->serial_number }}</p>
              </div>
              <div class="col-md-6">
                <p><strong>Start Date:</strong> {{ $booking->start_date }}</p>
                <p><strong>End Date:</strong> {{ $booking->end_date }}</p>
                <p><strong>Quantity:</strong> {{ $booking->item->quantity }}</p>
                <p><strong>Borrower:</strong> {{ $booking->user->name }}</p>
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
              <button type="submit" class="btn btn-primary">Approve</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection