@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="container-fluid px-3">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="m-0">Return Item from Usage</h6>
          <p class="text-sm mb-0">This page allows you to return an item that has been used or expired in a usage.</p>
        </div>
        <div class="card-body">
          <div class="row gx-4">
            <p class="text-dark"><strong>Borrower:</strong></p>
              <div class="col-auto">
                  <div class="avatar avatar-xl position-relative">
                      <img src="{{ asset($usage->booking->user->photo) }}" alt="..." class="w-100 border-radius-lg shadow-sm image-hover">
                  </div>
              </div>
              <div class="col-auto my-auto">
                  <div class="h-100 me-3">
                      <p class="mb-1"><strong>{{ $usage->booking->user->name }}</strong></p>
                      <p class="mb-0 text-sm">{{ $usage->booking->user->email }}</p>
                      <p class="mb-0 text-sm">{{ $usage->booking->user->phone }}</p>
                  </div>
              </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-4">
              <img src="{{ asset($usage->booking->item->photo) }}" alt="Item Photo" class="img-fluid rounded mb-2" style="max-height: 150px; width: auto;">
              <h5 class="m-0">{{ $usage->booking->item->name }}</h5>
              <p>{{ $usage->booking->item->serial_number }}</p>
            </div>
            <div class="col-md-4">
              <p><strong>Category:</strong><br> {{ $usage->booking->item->category->name }}</p>
              <p><strong>Quantity:</strong><br> {{ $usage->booking->quantity }}</p>
              <p><strong>Approved at:</strong><br> {{ $usage->created_at }}</p>
            </div>
            <div class="col-md-4">
              <p><strong>Start Date:</strong><br> {{ $usage->booking->start_date }}</p>
              <p><strong>End Date:</strong><br> {{ $usage->booking->end_date }}</p>
              <p><strong>Due Date:</strong><br> {{ $usage->due_date }}</p>
            </div>
          </div>
          <hr>
          <form method="POST" action="{{ route('usages.return', ['usage' => $usage->id]) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
              <label for="note_text" class="form-label">Note</label>
              <textarea class="form-control" id="note_text" name="note_text" rows="4">{{ $usage->note_text }}</textarea>
            </div>
            <button type="submit" class="btn bg-gradient-primary me-2">Return</button>
            <a href="{{ route('usages.index') }}" class="btn bg-gradient-info">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection