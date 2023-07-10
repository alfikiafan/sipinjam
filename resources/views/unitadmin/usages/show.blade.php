@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="card mx-3 mb-4">
  <div class="card-header pb-0">
    <h6 class="m-0">Usage Detail</h6>
    <p class="text-sm mb-0">View usage that you approved in detail.</p>
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
                <p class="mb-1"><strong>{{ $usage->booking->user->name }}</strong> (ID: {{ $usage->booking->user->id }})</p>
                <p class="mb-0 text-sm">{{ $usage->booking->user->email }}</p>
                <p class="mb-0 text-sm">{{ $usage->booking->user->phone }}</p>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-4">
        <img src="{{ asset($usage->booking->item->photo) }}" alt="Item Photo" class="img-fluid rounded mb-2" style="max-height: 150px; width: auto;"><br>
        <h5 class="mb-0 mt-2 d-inline-block">{{ $usage->booking->item->name }}</h5>
        <p class="d-inline-block"></p>
        <p class="m-0 d-inline-block">(ID: {{ $usage->booking->item->id }})</p>
        <p class="m-0">Serial: {{ $usage->booking->item->serial_number }}</p>
      </div>
      <div class="col-md-4">
        <p><strong>Item Status:</strong><br>
          @if ($usage->status === 'awaiting use')
            <span class="badge bg-primary badge-sm">{{ $usage->status }}</span>
          @elseif ($usage->status === 'used')
            <span class="badge bg-info badge-sm">{{ $usage->status }}</span>
          @elseif ($usage->status === 'returned')
            <span class="badge bg-success badge-sm">{{ $usage->status }}</span>
          @elseif ($usage->status === 'late')
            <span class="badge bg-warning badge-sm">{{ $usage->status }}</span>
          @else
            <span class="badge bg-danger badge-sm">{{ $usage->status }}</span>
          @endif
        </p>
        <p><strong>Category:</strong><br> {{ $usage->booking->item->category->name }}</p>
        <p><strong>Quantity:</strong><br> {{ $usage->booking->quantity }}</p>
        <p><strong>Booked At:</strong><br> {{ $usage->booking->created_at }}</p>
      </div>
      <div class="col-md-4">
        <p><strong>Start Date:</strong><br> {{ $usage->booking->start_date }}</p>
        <p><strong>End Date:</strong><br> {{ $usage->booking->end_date }}</p>
        <p><strong>Due Date:</strong><br> {{ $usage->due_date }}</p>
        <p><strong>Approved at:</strong><br> {{ $usage->created_at }}</p>
      </div>
      <p><strong>Note:</strong></p>
      <p>{{ $usage->note }}</p>
    </div>
    <hr>
    <div class="col-md-6 mt-4">
      <a href="" class="btn bg-gradient-info me-2" id="backButton">Back</a>
      @if ($usage->status === 'used' || $usage->status === 'late')
        <a href="{{ route('usages.return.show', ['usage' => $usage->id]) }}" class="btn bg-gradient-success">Return</a>
      @elseif ($usage->status === 'awaiting use')
        <form action="{{ route('usages.set-used', ['usage' => $usage->id]) }}" method="POST" class="d-inline">
          @csrf
          @method('PUT')
          <button type="submit" class="btn bg-gradient-dark" onclick="return confirm('Are you sure to set the item in this usage to &quot;used&quot;?')" title="Set item(s) in this usage as &quot;used&quot;">Set as Used</button>
        </form>
      @endif
    </div>
  </div>
</div>

@endsection