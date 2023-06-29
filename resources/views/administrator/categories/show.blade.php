@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="card mx-3 mb-4">
  <div class="card-header pb-0">
    <h6 class="m-0">Category Detail</h6>
    <p class="text-sm mb-0">View detail of your category.</p>
  </div>
  <div class="card-body">
    <div class="row">
      <h5>{{ $category->name }}</h5>
      <div class="col-md-6">
        <p><strong>ID:</strong><br> {{ $category->id }}</p>
        <p><strong>Description:</strong><br> {{ $category->description }}</p>
      </div>
      <div class="col-md-6">
        <h5></h5>
        <p><strong>Total items:</strong><br> {{ $category->items()->where('category_id', $category->id)->count() }}</p>
        <p><strong>Added at:</strong><br> {{ $category->created_at }}</p>
      </div>
    </div>
    <hr>
    <div class="col-md-6 mt-4">
      <a href="" class="btn bg-gradient-info" id="backButton">Back</a>
    </div>
  </div>
</div>

@endsection