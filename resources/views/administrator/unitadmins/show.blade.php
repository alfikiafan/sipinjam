@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="container-fluid px-3">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="m-0">Unit Admin Detail</h6>
          <p class="text-sm mb-0">View detail of your unit admin.</p>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <img src="{{ asset($unitadmin->photo) }}" alt="Unit Admin Photo" class="img-fluid rounded mb-2" style="max-height: 150px; width: auto;"><br>
              <h5 class="mb-0 mt-2 d-inline-block">{{ $unitadmin->name }}</h5>
              <p class="d-inline-block"></p>
              <p class="m-0 d-inline-block">(ID: {{ $unitadmin->id }})</p>
            </div>
            <div class="col-md-4">
              <p><strong>Unit:</strong><br> {{ $unitadmin->unit->name }} (ID: {{ $unitadmin->unit->id }})</p>
              <p><strong>Unit Location:</strong><br> {{ $unitadmin->unit->location }}</p>
              <p><strong>Added at:</strong><br> {{ $unitadmin->created_at }}</p>
            </div>
            <div class="col-md-4">
              <p><strong>Address:</strong><br> {{ $unitadmin->address }}</p>
              <p><strong>City:</strong><br> {{ $unitadmin->city }}</p>
            </div>
            <p><strong>About:</strong></p>
            <p>{{ $unitadmin->about_me }}</p>
          </div>
          <hr>
          <div class="col-md-6 mt-4">
            <a href="{{ route('unitadmins.index') }}" class="btn bg-gradient-info">Back</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection