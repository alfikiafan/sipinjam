@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="card mx-3 mb-4">
  <div class="card-header pb-0">
    <h6 class="m-0">Unit Detail</h6>
    <p class="text-sm mb-0">View detail of the unit.</p>
  </div>
  <div class="card-body">
    <div class="row">
      <h5>{{ $unit->name }}</h5>
      <div class="col-md-6">
        <p><strong>ID:</strong><br> {{ $unit->id }}</p>
        <p><strong>Description:</strong><br> {{ $unit->description }}</p>
      </div>
      <div class="col-md-6">
          <p><strong>Location</strong><br> {{ $unit->location }}</p>
          <p><strong>Total items:</strong><br> {{ $unit->items()->where('unit_id', $unit->id)->count() }}</p>
          <p><strong>Added at:</strong><br> {{ $unit->created_at }}</p>
      </div>
    </div>
    <hr>
    <div class="row gx-4">
      <p class="text-dark"><strong>Unit Admins:</strong></p>
      @foreach ($unitAdmins as $admin)
      <div class="col-md-4 mb-4 pe-4">
        <div class="row-auto">
          <div class="avatar avatar-xl position-relative">
            <img src="{{ asset($admin->photo) }}" alt="..." class="w-100 border-radius-lg shadow-sm image-hover">
          </div>
        </div>
        <div class="row-auto my-auto">
          <div class="h-100 me-3">
            <p class="mb-1"><strong>{{ $admin->name }}</strong> (ID: {{ $admin->id }})</p>
            <p class="mb-0 text-sm">{{ $admin->email }}</p>
            <p class="mb-0 text-sm">{{ $admin->phone }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <hr>
    <div class="col-md-6 mt-4">
      <a href="{{ route('administrator.units.index') }}" class="btn bg-gradient-info">Back</a>
    </div>
  </div>
</div>

@endsection