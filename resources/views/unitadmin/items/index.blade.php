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
        <h6 class="m-0">Items table</h6>
        <p class="text-sm">See all items located in your unit</p>
      </div>
      <div>
        <h6 class="m-0 text-sm">Total number of:</h6>
        <p class="d-inline-block me-2 text-sm">Items: {{ $totalItems }}</p>
        <p class="d-inline-block me-2 text-sm">Categories: {{ $totalCategories }}</p>
        <p class="d-inline-block text-sm">Brands: {{ $totalBrands }}</p>
      </div>
      <div class="form-group mb-3">
        <form action="{{ route('items.index') }}" method="GET">
          <div class="input-group">
            <button class="input-group-text search-icon" type="submit"><i class="fas fa-search"></i></button>
            <input class="form-control px-2" name="search" placeholder="Search" type="text" value="{{ request('search') }}">
          </div>
        </form>
      </div>
      <div class="ml-auto p-0">
        <a href="{{ route('items.create') }}" class="btn bg-gradient-primary">Add Item</a>
      </div>
    </div>
  </div>
  <div class="card-body px-0 pt-0 pb-2">
    <div class="btn-group mb-2">
      <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ empty($status) ? 'tab-active' : '' }}" href="{{ route('items.index') }}">All Items</a>
      <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'available' ? 'tab-active' : '' }}" href="{{ route('items.index', ['status' => 'available']) }}">Available</a>
      <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'not available' ? 'tab-active' : '' }}" href="{{ route('items.index', ['status' => 'not available']) }}">Not Available</a>
      <a class="px-4 py-2 mb-0 btn btn-white text-normal {{ $status === 'empty' ? 'tab-active' : '' }}" href="{{ route('items.index', ['status' => 'empty']) }}">Empty</a>
    </div>
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class="text-secondary text-xxs font-weight-bolder pe-3">ID</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Item</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Brand</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Serial Number</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Quantity</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Status</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $item)
          <tr>
            <td>
              <p class="text-xs font-weight-bold mb-0 ps-3">{{ $item->id }}</p>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <img src="{{ asset($item->photo) }}" class="avatar avatar-sm me-3" alt="item-image">
                <div class="d-flex flex-column">
                  <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                  <p class="text-xs text-secondary mb-0">{{ $item->Category->name }}</p>
                </div>
              </div>
            </td>
            <td>
              <p class="text-xs font-weight-bold mb-0">{{ $item->brand }}</p>
            </td>
            <td class="align-middle">
              <span class="text-xs font-weight-bold">{{ $item->serial_number }}</span>
            </td>
            <td class="align-middle">
              <span class="text-xs font-weight-bold">{{ $item->quantity }}</span>
            </td>
            <td class="align-middle">
              @if ($item->status === 'available')
              <span class="badge bg-success badge-sm">{{ $item->status }}</span>
              @elseif ($item->status === 'empty')
              <span class="badge bg-danger badge-sm">{{ $item->status }}</span>
              @else
              <span class="badge bg-secondary badge-sm">{{ $item->status }}</span>
              @endif
            </td>
            <td>
              <div class="d-flex align-items-center">
                <a href="{{ route('items.show', ['item' => $item->id]) }}" class="me-2">
                  <button type="button" class="btn btn-action btn-info mb-0" title="Show detail about this item">
                    <i class="fas fa-eye"></i>
                  </button>
                </a>
                <a href="{{ route('items.edit', ['item' => $item->id]) }}">
                  <button type="button" class="btn btn-action btn-primary mb-0 me-1" title="Edit this item">
                    <i class="fas fa-pencil-alt"></i>
                  </button>
                </a>
                <form action="{{ route('items.destroy', ['item' => $item->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-action mb-0 ms-1 btn-danger" title="Delete this item">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
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
        <a class="page-link" href="{{ $items->previousPageUrl() }}" aria-label="Previous">
            <span aria-hidden="true"><i class="fas fa-chevron-left" aria-hidden="true"></i></span>
        </a>
    </li>

    @for ($i = 1; $i <= $items->lastPage(); $i++)
      <li class="page-item{{ $items->currentPage() == $i ? ' active' : '' }}">
          <a class="page-link" href="{{ $items->url($i) }}">{{ $i }}</a>
      </li>
    @endfor

    <li class="page-item">
      <a class="page-link" href="{{ $items->nextPageUrl() }}" aria-label="Next">
        <span aria-hidden="true"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
      </a>
    </li>
  </ul>
</div>

@endsection