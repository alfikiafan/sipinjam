@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="card mx-3 mb-4">
  <div class="card-header pb-0">
    <div class="d-flex align-items-center justify-content-between">
      <div>
        <h6 class="m-0">Items table</h6>
        <p class="text-sm">See all available items that you can book.</p>
      </div>
      <div>
        <h6 class="m-0 text-sm">Total number of:</h6>
        <p class="d-inline-block me-2 text-sm">Items: {{ $totalItems }}</p>
        <p class="d-inline-block me-2 text-sm">Categories: {{ $totalCategories }}</p>
        <p class="d-inline-block text-sm">Brands: {{ $totalBrands }}</p>
      </div>
    </div>
  </div>
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class="text-secondary text-xxs font-weight-bolder pe-3">Unit</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Item</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Brand</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Serial Number</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Quantity</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $item)
          <tr>
            <td>
              <p class="text-xs font-weight-bold mb-0 ps-3">{{ $item->Unit->name }}</p>
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
            <td>
              <div class="d-flex align-items-center">
                <a href="{{ route('items.show', ['item' => $item->id]) }}" class="me-2">
                  <button type="button" class="btn btn-action btn-info mb-0" title="Show detail about this item">
                    <i class="fas fa-eye"></i>
                  </button>
                </a>
                <a href="{{ route('bookings.create', ['item' => $item->id]) }}">
                  <button type="button" class="btn btn-action btn-primary mb-0 me-1" title="Booking this item">
                    <i class="fas fa-plus"></i>
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
<div class="pagination-wrapper">
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