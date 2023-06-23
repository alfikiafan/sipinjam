@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  <div class="container-fluid px-3">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6 class="m-0">Usage Detail</h6>
            <p class="text-sm mb-0">View usage that you approved in detail.</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <img src="{{ asset($usage->booking->item->photo) }}" alt="Item Photo" class="img-fluid rounded mb-2" style="max-height: 150px; width: auto;">
                <h5 class="m-0">{{ $usage->booking->item->name }}</h5>
                <p>{{ $usage->booking->item->serial_number }}</p>
              </div>
              <div class="col-md-4">
                <p><strong>Item Status:</strong><br>
                  @if ($usage->status === 'awaiting use')
                    <span class="badge bg-primary badge-sm">{{ $usage->status }}</span>
                  @elseif ($usage->status === 'used')
                    <span class="badge bg-info badge-sm">{{ $usage->status }}</span>
                  @elseif ($usage->status === 'returned')
                    <span class="badge bg-success badge-sm">{{ $usage->status }}</span>
                  @else
                    <span class="badge bg-danger badge-sm">{{ $usage->status }}</span>
                  @endif
                </p>
                <p><strong>Category:</strong><br> {{ $usage->booking->item->category->name }}</p>
                <p><strong>Borrower:</strong><br> {{ $usage->booking->user->name }}</p>
              </div>
              <div class="col-md-4">
                <p><strong>Start Date:</strong><br> {{ $usage->booking->start_date }}</p>
                <p><strong>End Date:</strong><br> {{ $usage->booking->end_date }}</p>
                <p><strong>Due Date:</strong><br> {{ $usage->due_date }}</p>
                <p><strong>Approved at:</strong><br> {{ $usage->created_at }}</p>
              </div>
            </div>
            <hr>
            <div class="col-md-6 mt-4">
              <a href="{{ route('usages.index') }}" class="btn btn-info">Back</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection