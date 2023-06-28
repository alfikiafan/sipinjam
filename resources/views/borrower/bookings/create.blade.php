@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="card mx-3 mb-3">
    <div class="card-header pb-3">
        <h6 class="m-0">Booking an Item</h6>
        <p class="text-sm mb-0">To create a booking, please specify the desired dates and quantity</p>
    </div>
    <div class="card-body pt-0">
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    
                    <div class="form-group">
                        <label for="item">Item</label>
                        <input type="text" class="form-control" id="item" value="{{ $item->name }}" readonly>
                    </div>
                    @error('item')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <input type="text" class="form-control" id="unit" value="{{ $item->Unit->name }}" readonly>
                    </div>
                    @error('unit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                    </div>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn bg-gradient-primary mt-3 mb-0 me-2">Submit</button>
            <a href="/items" class="btn bg-gradient-info mt-3 mb-0">Cancel</a>
        </form>
    </div>
</div>

@endsection