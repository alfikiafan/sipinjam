@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="container-fluid px-3">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="m-0">Category Detail</h6>
          <p class="text-sm mb-0">View detail of your category.</p>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <h5 class="mb-0 mt-2 d-inline-block">{{ $category->name }}</h5>
              <p class="d-inline-block"></p>
              <p class="m-0 d-inline-block">(ID: {{ $category->id }})</p>
            </div>
            <div class="col-md-4">
              <p><strong>Number of items:</strong><br> {{ $category->items()->where('category_id', $category->id)->count() }}</p>
              <p><strong>Added at:</strong><br> {{ $category->created_at }}</p>
            </div>
          </div>
          <hr>
          <div class="col-md-6 mt-4">
            <a href="{{ route('administrator.categories.index') }}" class="btn bg-gradient-info">Back</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection