@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="card mx-3 mb-4">
  <div class="card-header pb-0">
    <h6 class="m-0">Item Detail</h6>
    <p class="text-sm mb-0">Show detail the item</p>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-4">
        <img src="{{ asset($item->photo) }}" alt="Item Photo" class="img-fluid rounded" style="max-height: 150px; width: auto;">
        <h5 class="m-0">{{ $item->name }}</h5>
        <p>{{ $item->serial_number }}</p>
      </div>
      <div class="col-md-4">
        <p><strong>Status:</strong><br>
          <span class="badge bg-primary badge-sm">{{ $item->status }}</span>
          <p><strong>Category:</strong><br>{{ $item->category->name }}</p>
          <p><strong>Quantity:</strong><br>{{ $item->quantity }}</p>
        </div>
        <div class="col-md-4">
          <p><strong>Created At:</strong><br>{{ $item->created_at }}</p>
        </p>
        <p><strong>Admin Unit:</strong><br>
            <span>
              @php
                  $user = App\Models\User::find($item->unit_id);
              @endphp
              @if ($user)
                  {{ $user->name }}
              @endif
          </span>
          </p>
        </div>
      </div>
      <hr>
      <div class="col-md-6 mt-4">
        <a href="{{ route('items.index') }}" class="btn bg-gradient-info">Back</a>
      </div>
    </div>
  </div>
</div>

@endsection