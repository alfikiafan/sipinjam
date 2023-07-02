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
                <div class="col-md-4">
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                    
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                    </div>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

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
                <div class="col-md-4 pe-2">
                    <p><strong>Unit:</strong><br>{{ $item->unit->name }}</p>
                    <p><strong>Category:</strong><br>{{ $item->category->name }}</p>
                    <p><strong>Brand:</strong><br>{{ $item->brand }}</p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset($item->photo) }}" alt="Item Photo" class="img-fluid rounded" style="max-height: 150px; width: auto;">
                    <h5 class="m-0">{{ $item->name }}</h5>
                    <p>{{ $item->serial_number }}</p>
                </div>
            </div>
            <button type="submit" class="btn bg-gradient-primary mt-3 mb-0 me-2">Submit</button>
            <a href="{{ route('items.index') }}" class="btn bg-gradient-info mt-3 mb-0">Cancel</a>
        </form>
    </div>
</div>

@endsection