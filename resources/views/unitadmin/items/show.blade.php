@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  <div class="container-fluid px-3">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6 class="m-0">Item Detail</h6>
            <p class="text-sm mb-0">View detail of your item.</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <img src="{{ asset($item->photo) }}" alt="Item Photo" class="img-fluid rounded mb-2" style="max-height: 150px; width: auto;">
                <h5 class="m-0">{{ $item->name }}</h5>
                <p>{{ $item->serial_number }}</p>
              </div>
              <div class="col-md-4">
                <p><strong>Status:</strong><br>
                  @if ($item->status === 'available')
                    <span class="badge bg-success badge-sm">{{ $item->status }}</span>
                    @elseif ($item->status === 'empty')
                    <span class="badge bg-danger badge-sm">{{ $item->status }}</span>
                    @else
                    <span class="badge bg-secondary badge-sm">{{ $item->status }}</span>
                    @endif
                </p>
                <p><strong>Category:</strong><br> {{ $item->category->name }}</p>
                <p><strong>Brand:</strong><br> {{ $item->brand }}</p>
              </div>
              <div class="col-md-4">
                <p><strong>Status:</strong><br> {{ $item->status }}</p>
                <p><strong>Stock:</strong><br> {{ $item->quantity }}</p>
                <p><strong>Added at:</strong><br> {{ $item->created_at }}</p>
              </div>
            </div>
            <hr>
            <div class="col-md-6 mt-4">
              <a href="{{ route('items.index') }}" class="btn btn-info">Back</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection