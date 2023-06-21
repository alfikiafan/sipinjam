@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  <div class="container-fluid px-3">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
              <div>
                <h6 class="m-0">Items table</h6>
                <p class="text-sm">See all items located in your unit</p>
              </div>
              <div>
                <h6 class="m-0 text-sm">Total number of:</h6>
                <p class="d-inline-block me-2 text-sm">Items: {{ $items->count() }}</p>
                <p class="d-inline-block me-2 text-sm">Categories: {{ $items->pluck('categories_id')->unique()->count() }}</p>
                <p class="d-inline-block text-sm">Brands: {{ $items->pluck('brand')->unique()->count() }}</p>
              </div>
              <div class="ml-auto p-0">
                <a href="{{ route('items.create') }}" class="btn btn-primary m-0">Add Item</a>
              </div>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
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
                        <a href="{{ route('items.edit', ['item' => $item->id]) }}">
                          <button type="button" class="btn btn-action btn-primary mb-0 me-1">
                            <i class="fas fa-pencil-alt"></i>
                          </button>
                        </a>
                        <form action="{{ route('items.destroy', ['item' => $item->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-action mb-0 ms-1 btn-danger">
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
      </div>
    </div>
  </div>
</main>

@endsection