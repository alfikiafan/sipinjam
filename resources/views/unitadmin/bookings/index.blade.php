@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  <div class="container-fluid px-3">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6 class="m-0">Bookings table</h6>
            <p class="text-sm">View all bookings made by borrowers for your unit.</p>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-xxs font-weight-bolder pe-2">ID</th>
                    <th class="text-xxs font-weight-bolder px-2">Item</th>
                    <th class="text-xxs font-weight-bolder px-2">Borrower</th>
                    <th class="text-xxs font-weight-bolder px-2">Status</th>
                    <th class="text-xxs font-weight-bolder px-2">Start Date</th>
                    <th class="text-xxs font-weight-bolder px-2">End Date</th>
                    <th class="text-xxs font-weight-bolder px-2">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($bookings as $booking)
                  <tr>
                    <td>
                      <p class="text-xs font-weight-bold mb-0 ps-3">{{ $booking->id }}</p>
                    </td>
                    <td>
                      <div class="d-flex">
                        <img src="{{ $booking->item->photo }}" class="avatar avatar-sm me-3" alt="item-image">
                        <div class="d-flex flex-column">
                          <h6 class="mb-0 text-sm">{{ $booking->item->name }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $booking->item->Category->name }}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $booking->user->name }}</p>
                      <p class="text-xs text-secondary mb-0">{{ $booking->user->email }}</p>
                    </td>
                    <td class="align-middle">
                      <div>
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
                      <span class="text-xs font-weight-bold">{{ $booking->start_date }}</span>
                    </td>
                    <td class="align-middle">
                      <span class="text-xs font-weight-bold">{{ $booking->end_date }}</span>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <a href="{{ route('bookings.approve', ['booking' => $booking->id]) }}" class="me-2">
                          <button type="button" class="btn btn-action btn-success mb-0" onclick="return confirm('Are you sure to approve this booking?')">
                            <i class="fas fa-check"></i>
                          </button>
                        </a>
                        <a href="{{ route('bookings.reject', ['booking' => $booking->id]) }}" class="me-2">
                          <button type="button" class="btn btn-action btn-danger mb-0" onclick="return confirm('Are you sure to reject this booking?')">
                          <i class="fas fa-times"></i>
                          </button>
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
