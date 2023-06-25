@extends('layouts.user_type.auth')

@section('content')

@include('components.notifications')

<div class="mx-3 mb-3">
    <div class="mb-4">
        <h6 class="m-0">Edit Item</h6>
        <p class="text-sm mb-0">Edit unit detail</p>
    </div>
        <form method="POST" action="{{ route('administrator.units.update', $unit->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Unit Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $unit->name }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Unit Location</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $unit->location }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn bg-gradient-primary me-2">Edit Unit</button>
                    <a href="{{ route('administrator.units.index') }}" class="btn bg-gradient-info">Cancel</a>
                </div>
            </div>
        </form>
    </div>

@endsection