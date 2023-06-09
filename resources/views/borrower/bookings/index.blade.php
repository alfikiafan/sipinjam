@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')
@php
  $status = request('status');
@endphp

<div class="card mx-3 mb-4">
  <div class="card-header pb-0">
    <div class="d-flex align-items-center justify-content-between">
      <div>
        <h6 class="m-0">Bookings table</h6>
        <p class="text-sm">View all the bookings you have made.</p>
      </div>
      <div>
        <h6 class="m-0 text-sm">Total number of:</h6>
        <p class="d-inline-block me-2 text-sm">Bookings: {{ $totalBookings }}</p>
        <p class="d-inline-block text-sm">Items: {{ $totalItems }}</p>
      </div>
      <div class="form-group mb-3">
        <form action="{{ route('bookings.index') }}" method="GET">
          <div class="input-group">
            <button class="input-group-text search-icon" type="submit"><i class="fas fa-search"></i></button>
            <input class="form-control px-2" name="search" placeholder="Search" type="text" value="{{ request('search') }}">
          </div>
        </form>
      </div>
      <div class="ml-auto p-0">
        <a href="{{ route('items.index') }}" class="btn bg-gradient-primary">Book Item</a>
      </div>
    </div>
  </div>
  <div class="card-body px-0 pt-0 pb-2">
    <div class="btn-group mb-2">
      <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ empty($status) ? 'tab-active' : '' }}" href="{{ route('bookings.index') }}">All Bookings</a>
      <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'pending' ? 'tab-active' : '' }}" href="{{ route('bookings.index', ['status' => 'pending']) }}">Pending</a>
      <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'approved' ? 'tab-active' : '' }}" href="{{ route('bookings.index', ['status' => 'approved']) }}">Approved</a>
      <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'rejected' ? 'tab-active' : '' }}" href="{{ route('bookings.index', ['status' => 'rejected']) }}">Rejected</a>
      <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'cancelled' ? 'tab-active' : '' }}" href="{{ route('bookings.index', ['status' => 'cancelled']) }}">Cancelled</a>
      <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'expired' ? 'tab-active' : '' }}" href="{{ route('bookings.index', ['status' => 'expired']) }}">Expired</a>
    </div>
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class="text-xxs font-weight-bolder pe-2">ID</th>
            <th class="text-xxs font-weight-bolder px-2">Item</th>
            <th class="text-xxs font-weight-bolder px-2">Quantity</th>
            <th class="text-xxs font-weight-bolder px-2">Status</th>
            <th class="text-xxs font-weight-bolder px-2">Start Date</th>
            <th class="text-xxs font-weight-bolder px-2">End Date</th>
            @if ($status === 'approved' || $status === null)
            <th class="text-xxs font-weight-bolder px-2">Due Date</th>
            @endif
            <th class="text-xxs font-weight-bolder px-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bookings as $booking)
          <tr>
              <td>
                  <p class="text-xs font-weight-bold mb-0 ps-3">{{ $booking->id }}</p>
              </td>
              <td>
                  <div class="d-flex">
                  <img src="{{ asset($booking->item->photo) }}" class="avatar avatar-sm me-3" alt="item-image">
                  <div class="d-flex flex-column">
                      <h6 class="mb-0 text-sm">{{ $booking->item->name }}</h6>
                      <p class="text-xs text-secondary mb-0">{{ $booking->item->Category->name }}</p>
                  </div>
                  </div>
              </td>
              <td>
                  <p class="text-xs font-weight-bold mb-0">{{ $booking->quantity }}</p>
              </td>
              <td class="align-middle">
                  <div>
                  @if ($booking->status === 'pending')
                      <span class="badge bg-primary badge-sm">{{ $booking->status }}</span>
                  @elseif ($booking->status === 'rejected')
                      <span class="badge bg-danger badge-sm">{{ $booking->status }}</span>
                  @elseif ($booking->status === 'cancelled')
                      <span class="badge bg-info badge-sm">{{ $booking->status }}</span>
                  @elseif ($booking->status === 'approved')
                      <span class="badge bg-success badge-sm">{{ $booking->status }}</span>
                  @else
                      <span class="badge bg-danger badge-sm">{{ $booking->status }}</span>
                  @endif
                  </div>
              </td>
              <td class="align-middle">
                  <span class="text-xs font-weight-bold">{{ $booking->start_date }}</span>
              </td>
              <td class="align-middle">
                  <span class="text-xs font-weight-bold">{{ $booking->end_date }}</span>
              </td>
              @if ($status === 'approved' || $status === null)
              <td class="align-middle">
                  <span class="text-xs font-weight-bold">
                  @if ($booking->usage)
                      {{ $booking->usage->due_date }}
                  @endif
                  </span>
              </td>
              @endif
              <td>
                  <div class="d-flex align-items-center">
                  <a href="{{ route('bookings.show', ['booking' => $booking->id]) }}" class="me-2">
                      <button type="button" class="btn btn-action btn-info mb-0" title="Show detail about this booking">
                      <i class="fas fa-eye"></i>
                      </button>
                  </a>
                  @if ($booking->status === 'approved')
                  <a href="{{ route('bookings.approval', ['booking' => $booking->id]) }}" class="me-2" target="blank">
                      <button type="button" class="btn btn-action btn-success mb-0" title="Print this booking approval">
                      <i class="fas fa-print"></i>
                      </button>
                  </a>
                  @endif
                  @if ($booking->status === 'pending')
                  <a href="{{ route('bookings.cancel', ['booking' => $booking->id]) }}">
                      <button type="button" class="btn btn-action btn-danger mb-0" title="Cancel this booking" onclick="return confirm('Are you sure to cancel this booking?')">
                      <i class="fas fa-times"></i>
                      </button>
                  </a>
                  @endif
                  </div>
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="mb-4">
  <ul class="pagination pagination-info justify-content-center">
    <li class="page-item">
        <a class="page-link" href="{{ $bookings->previousPageUrl() }}" aria-label="Previous">
            <span aria-hidden="true"><i class="fas fa-chevron-left" aria-hidden="true"></i></span>
        </a>
    </li>

    @for ($i = 1; $i <= $bookings->lastPage(); $i++)
      <li class="page-item{{ $bookings->currentPage() == $i ? ' active' : '' }}">
          <a class="page-link" href="{{ $bookings->url($i) }}">{{ $i }}</a>
      </li>
    @endfor

    <li class="page-item">
      <a class="page-link" href="{{ $bookings->nextPageUrl() }}" aria-label="Next">
        <span aria-hidden="true"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
      </a>
    </li>
  </ul>
</div>

@endsection
