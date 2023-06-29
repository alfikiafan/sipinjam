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
        <h6 class="m-0">Usages table</h6>
        <p class="text-sm">Review all bookings that you have approved.</p>
      </div>
      <div>
        <h6 class="m-0 text-sm">Total number of:</h6>
        <p class="d-inline-block me-2 text-sm">Usages: {{ $totalUsages }}</p>
        <p class="d-inline-block me-2 text-sm">Items: {{ $totalItems }}</p>
        <p class="d-inline-block text-sm">Borrowers: {{ $totalBorrowers }}</p>
      </div>
    </div>
  </div>
  <div class="card-body px-0 pt-0 pb-2">
    <div class="btn-group mb-2">
      <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ empty($status) ? 'tab-active' : '' }}" href="{{ route('usages.index') }}">All Usages</a>
      <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'awaiting use' ? 'tab-active' : '' }}" href="{{ route('usages.index', ['status' => 'awaiting use']) }}">Awaiting Use</a>
      <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'used' ? 'tab-active' : '' }}" href="{{ route('usages.index', ['status' => 'used']) }}">Used</a>
      <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'returned' ? 'tab-active' : '' }}" href="{{ route('usages.index', ['status' => 'returned']) }}">Returned</a>
      <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'late' ? 'tab-active' : '' }}" href="{{ route('usages.index', ['status' => 'late']) }}">Late</a>
      <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'expired' ? 'tab-active' : '' }}" href="{{ route('usages.index', ['status' => 'expired']) }}">Expired</a>
    </div>
    <div class="table-responsive p-0">
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-secondary text-xxs font-weight-bolder pe-2">ID</th>
                <th class="text-secondary text-xxs font-weight-bolder p-2">Book ID</th>
                <th class="text-secondary text-xxs font-weight-bolder p-2">Item</th>
                <th class="text-secondary text-xxs font-weight-bolder p-2">Item Status</th>
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
                  @elseif ($usage->status === 'expired')
                    <span class="badge bg-danger badge-sm">{{ $usage->status }}</span>
                  @else
                    <span class="badge bg-warning badge-sm">{{ $usage->status }}</span>
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
                    <a href="{{ route('usages.show', ['usage' => $usage->id]) }}" class="me-2">
                      <button type="button" class="btn btn-action btn-info mb-0" title="Show detail about this usage">
                        <i class="fas fa-eye"></i>
                      </button>
                    </a>
                    <a href="{{ route('usages.edit', ['usage' => $usage->id]) }}" class="me-2">
                      <button type="button" class="btn btn-action btn-primary mb-0" title="Edit this usage">
                        <i class="fas fa-pencil-alt"></i>
                      </button>
                    </a>
                    @if ($usage->status === 'awaiting use')
                    <div class="me-2">
                      <form action="{{ route('usages.set-used', ['usage' => $usage->id]) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <button type="submit" class="btn btn-action btn-warning mb-0" onclick="return confirm('Are you sure to set the item in this usage to &quot;used&quot;?')" title="Set item(s) in this usage as &quot;used&quot;">
                              <i class="fas fa-check"></i>
                          </button>
                      </form>
                    </div>
                    @endif
                    @if ($usage->status === 'used' || $usage->status === 'late')
                    <a href="{{ route('usages.return.show', ['usage' => $usage->id]) }}">
                      <button type="button" class="btn btn-action btn-success mb-0" title="Return item(s) in this usage">
                      <i class="fas fa-arrow-rotate-left"></i>
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
<div class="pagination-wrapper">
  <ul class="pagination pagination-info justify-content-center">
    <li class="page-item">
        <a class="page-link" href="{{ $usages->previousPageUrl() }}" aria-label="Previous">
            <span aria-hidden="true"><i class="ni ni-bold-left" aria-hidden="true"></i></span>
        </a>
    </li>

    @for ($i = 1; $i <= $usages->lastPage(); $i++)
      <li class="page-item{{ $usages->currentPage() == $i ? ' active' : '' }}">
          <a class="page-link" href="{{ $usages->url($i) }}">{{ $i }}</a>
      </li>
    @endfor

    <li class="page-item">
      <a class="page-link" href="{{ $usages->nextPageUrl() }}" aria-label="Next">
        <span aria-hidden="true"><i class="ni ni-bold-right" aria-hidden="true"></i></span>
      </a>
    </li>
  </ul>
</div>

@endsection
