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
        </p>
        <p><strong>Category:</strong><br>{{ $item->category->name }}</p>
        <p><strong>Brand:</strong><br>{{ $item->brand }}</p>
      </div>
      <div class="col-md-4">
        <p><strong>Serial number:</strong><br>{{ $item->serial_number }}</p>
        <p><strong>Unit:</strong><br>{{ $item->unit->name }}</p>
        <p><strong>Amount available:</strong><br>{{ $item->quantity }}</p>
      </div>
      <hr>
      <div class="row gx-4">
        <p class="text-dark"><strong>Responsible unit admin(s):</strong></p>
        @foreach ($unitAdmins as $admin)
        <div class="col-md-4 mb-4 pe-4">
          <div class="row-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="{{ asset($admin->photo) }}" alt="..." class="w-100 border-radius-lg shadow-sm image-hover">
            </div>
          </div>
          <div class="row-auto my-auto">
            <div class="h-100 me-3">
              <p class="mb-1"><strong>{{ $admin->name }}</strong></p>
              <p class="mb-0 text-sm">{{ $admin->email }}</p>
              <p class="mb-0 text-sm">{{ $admin->phone }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <hr>
      <div class="col-md-6 mt-4">
        <a href="" class="btn bg-gradient-info" id="backButton">Back</a>
      </div>
    </div>
  </div>
</div>

@endsection