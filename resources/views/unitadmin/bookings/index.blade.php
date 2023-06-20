@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  <div class="container-fluid px-3">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Bookings table</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-xxs font-weight-bolder opacity-7">ID</th>
                    <th class="text-xxs font-weight-bolder opacity-7">Item</th>
                    <th class="text-xxs font-weight-bolder opacity-7">Borrower</th>
                    <th class="text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-xxs font-weight-bolder opacity-7">Start Date</th>
                    <th class="text-xxs font-weight-bolder opacity-7">End Date</th>
                    <th class="text-xxs font-weight-bolder opacity-7">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($bookings as $booking)
                  <tr>
                    <td>
                      <p class="text-xs font-weight-bold mb-0 ps-3">{{ $booking->id }}</p>
                    </td>
                    <td>
                      <div class="d-flex ps-3">
                        <img src="{{ $booking->item->photo }}" class="avatar avatar-sm me-3" alt="item-image">
                        <div class="d-flex flex-column">
                          <h6 class="mb-0 text-sm">{{ $booking->item->name }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $booking->item->Category->name }}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0 ps-3">{{ $booking->user->name }}</p>
                      <p class="text-xs text-secondary mb-0 ps-3">{{ $booking->user->email }}</p>
                    </td>
                    <td class="align-middle">
                      <div class="ps-3">
                      @if ($booking->status === 'pending')
                        <span class="badge bg-primary badge-sm">{{ $booking->status }}</span>
                      @elseif ($booking->status === 'rejected')
                        <span class="badge bg-danger badge-sm">{{ $booking->status }}</span>
                      @elseif ($booking->status === 'cancelled')
                        <span class="badge bg-secondary badge-sm">{{ $booking->status }}</span>
                      @else
                        <span class="badge bg-success badge-sm">{{ $booking->status }}</span>
                      @endif
                      </div>
                    </td>
                    <td class="align-middle">
                      <span class="text-xs font-weight-bold ps-3">{{ $booking->start_date }}</span>
                    </td>
                    <td class="align-middle">
                      <span class="text-xs font-weight-bold ps-3">{{ $booking->end_date }}</span>
                      <td class="align-middle">
                      <div class="ps-3">
                        <a href="#" class="badge bg-success font-weight-bold button-icon d-inline-flex align-items-center justify-content-center ps-3" data-toggle="tooltip" data-original-title="Approve Booking">
                          <i class="fas fa-check-circle me-1"></i> APPROVE
                        </a>
                        <a href="#" class="badge bg-danger font-weight-bold button-icon d-inline-flex align-items-center justify-content-center ps-3" data-toggle="tooltip" data-original-title="Reject Booking">
                          <i class="fas fa-times-circle me-1"></i> REJECT
                        </a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection
