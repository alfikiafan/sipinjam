@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  <div class="container-fluid px-3">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6 class="m-0">Return Item from Usage</h6>
            <p class="text-sm mb-0">This page allows you to return an item that has been used or expired in a usage.</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <img src="{{ asset($usage->booking->item->photo) }}" alt="Item Photo" class="img-fluid rounded mb-2" style="max-height: 150px; width: auto;">
                <h5 class="m-0">{{ $usage->booking->item->name }}</h5>
                <p>{{ $usage->booking->item->serial_number }}</p>
              </div>
              <div class="col-md-6">
                <p><strong>Category:</strong> {{ $usage->booking->item->category->name }}</p>
                <p><strong>Borrower:</strong> {{ $usage->booking->user->name }}</p>
                <p><strong>Start Date:</strong> {{ $usage->booking->start_date }}</p>
                <p><strong>End Date:</strong> {{ $usage->booking->end_date }}</p>
                <p><strong>Due Date:</strong> {{ $usage->due_date }}</p>
                <p><strong>Approved at:</strong> {{ $usage->created_at }}</p>
              </div>
            </div>
            <hr>
            <form method="POST" action="{{ route('usages.return', ['usage' => $usage->id]) }}">
              @csrf
              @method('PUT')
              <div class="mb-3">
                <label for="note_text" class="form-label">Note</label>
                <textarea class="form-control" id="note_text" name="note_text" rows="4">{{ $usage->note_text }}</textarea>
              </div>
              <button type="submit" class="btn btn-primary me-2">Return</button>
              <a href="{{ route('usages.index') }}" class="btn btn-info">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection