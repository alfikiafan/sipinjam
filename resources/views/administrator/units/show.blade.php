@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="container-fluid px-3">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="m-0">Unit Detail</h6>
          <p class="text-sm mb-0">View detail of the unit.</p>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <h5 class="mb-0 mt-2 d-inline-block">{{ $unit->name }}</h5>
              <p class="d-inline-block"></p>
              <p class="m-0 d-inline-block">(ID: {{ $unit->id }})</p>
            </div>
            <div class="col-md-4">
                <p><strong>Location</strong><br> {{ $unit->location }}</p>
                <p><strong>Added at:</strong><br> {{ $unit->created_at }}</p>
            </div>
          </div>
          <hr>
          <div class="col-md-6 mt-4">
            <a href="{{ route('administrator.units.index') }}" class="btn bg-gradient-info">Back</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection