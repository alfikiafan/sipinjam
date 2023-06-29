@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="card mx-3 mb-3">
    <div class="card-header pb-3">
        <h6 class="m-0">Edit Unit Administrator Data</h6>
        <p class="text-sm mb-0">Update and manage unit administrator data, ensuring accurate and up-to-date records for effective administration and management.</p>
    </div>
    <div class="card-body pt-0">
        <form method="POST" action="{{ route('unitadmins.update', $unitadmin->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="unit_id">The unit in which the unit administrator works</label>
                        <select class="form-control" id="unit_id" name="unit_id" required>
                            <option value="">Select Unit</option>
                            @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" {{ $unitadmin->unit && $unitadmin->unit->id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        @error('unit')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $unitadmin->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $unitadmin->phone) }}" required>
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $unitadmin->address) }}">
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $unitadmin->city) }}">
                        @error('city')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn bg-gradient-primary me-2">Update Data</button>
                    <a href="{{ route('unitadmins.index') }}" class="btn bg-gradient-info">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
