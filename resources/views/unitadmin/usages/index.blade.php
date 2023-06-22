@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

@php
  $status = request('status');
@endphp

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  <div class="container-fluid px-3">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6 class="m-0">Usages table</h6>
            <p class="text-sm">Review all bookings that you have approved.</p>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="btn-group mb-2">
              <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ empty($status) ? 'tab-active' : '' }}" href="{{ route('items.index') }}">All Items</a>
              <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'awaiting use' ? 'tab-active' : '' }}" href="{{ route('items.index', ['status' => 'awaiting use']) }}">Awaiting Use</a>
              <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'used' ? 'tab-active' : '' }}" href="{{ route('items.index', ['status' => 'used']) }}">Used</a>
              <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'returned' ? 'tab-active' : '' }}" href="{{ route('items.index', ['status' => 'empty']) }}">Returned</a>
              <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'expired' ? 'tab-active' : '' }}" href="{{ route('items.index', ['status' => 'expired']) }}">Expired</a>
            </div>
            <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-secondary text-xxs font-weight-bolder pe-2">ID</th>
                        <th class="text-secondary text-xxs font-weight-bolder p-2">Book ID</th>
                        <th class="text-secondary text-xxs font-weight-bolder p-2">Item</th>
                        <th class="text-secondary text-xxs font-weight-bolder p-2">Status</th>
                        <th class="text-secondary text-xxs font-weight-bolder p-2">Start Date</th>
                        <th class="text-secondary text-xxs font-weight-bolder p-2">End Date</th>
                        <th class="text-secondary text-xxs font-weight-bolder p-2">Due Date</th>
                        <th class="text-secondary text-xxs font-weight-bolder p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usages as $usage)
                    <tr>
                        <td>
                            <p class="text-xs font-weight-bold mb-0 ps-3">{{ $usage->id }}</p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $usage->booking_id }}</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($usage->booking->item->photo) }}" class="avatar avatar-sm me-3" alt="usage-image">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-0 text-sm">{{ $usage->booking->item->name }}</h6>
                                    <p class="text-xs text-secondary mb-0">{{ $usage->booking->item->Category->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                          @if ($usage->status === 'awaiting use')
                            <span class="badge bg-primary badge-sm">{{ $usage->status }}</span>
                          @elseif ($usage->status === 'used')
                            <span class="badge bg-info badge-sm">{{ $usage->status }}</span>
                          @elseif ($usage->status === 'returned')
                            <span class="badge bg-success badge-sm">{{ $usage->status }}</span>
                          @else
                            <span class="badge bg-danger badge-sm">{{ $usage->status }}</span>
                          @endif
                        </td>
                        <td class="align-middle">
                            <span class="text-xs font-weight-bold">{{ $usage->booking->start_date }}</span>
                        </td>
                        <td class="align-middle">
                            <span class="text-xs font-weight-bold">{{ $usage->booking->end_date }}</span>
                        </td>
                        <td class="align-middle">
                            <span class="text-xs font-weight-bold">{{ $usage->due_date }}</span>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <a href="" class="me-2">
                              <button type="button" class="btn btn-action btn-info mb-0">
                                <i class="fas fa-eye"></i>
                              </button>
                            </a>
                            <a href="">
                              <button type="button" class="btn btn-action btn-primary mb-0">
                                <i class="fas fa-pencil-alt"></i>
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
