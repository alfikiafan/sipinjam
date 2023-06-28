@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')
@php
  $status = request('status');
@endphp

<div class="container-fluid px-3">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="m-0">Bookings table</h6>
              <p class="text-sm">View all bookings from you.</p>
            </div>
            <div>
              <h6 class="m-0 text-sm">Total number of:</h6>
              <p class="d-inline-block me-2 text-sm">Bookings: {{ $bookings->count() }}</p>
              <p class="d-inline-block me-2 text-sm">Approved: {{ $bookings->where('status', 'approved')->count() }}</p>
              <p class="d-inline-block text-sm">Items: {{ $bookings->pluck('item_id')->unique()->count() }}</p>
            </div>
            <div class="ml-auto p-0">
              <a href="{{ route('items.index') }}" class="btn bg-gradient-primary m-0">Book Item</a>
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
                  <th class="text-xxs font-weight-bolder px-2">Due Date</th>
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
                    <td class="align-middle">
                        <span class="text-xs font-weight-bold">
                            @if ($booking->usages)
                                @foreach ($booking->usages as $usage)
                                    @if ($usage->booking_id === $booking->id)
                                        {{ $usage->due_date }}
                                    @endif
                                @endforeach
                            @endif
                        </span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                        <a href="{{ route('bookings.show', ['booking' => $booking->id]) }}" class="me-2">
                            <button type="button" class="btn btn-action btn-info mb-0" title="Show detail about this booking">
                            <i class="fas fa-eye"></i>
                            </button>
                        </a>
                        <a href="{{ route('bookings.approval', ['booking' => $booking->id]) }}" class="me-2" target="blank">
                            <button type="button" class="btn btn-action btn-success mb-0" title="Print this booking approval">
                            <i class="fas fa-print"></i>
                            </button>
                        </a>
                        <a href="{{ route('bookings.cancel', ['booking' => $booking->id]) }}">
                            <button type="button" class="btn btn-action btn-danger mb-0" title="Cancel this booking" onclick="return confirm('Are you sure to cancel this booking?')">
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

@endsection
