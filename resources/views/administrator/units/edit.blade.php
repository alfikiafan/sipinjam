@extends('layouts.user_type.auth')

@section('content')

@include('components.notifications')

    <div class="mx-3 mb-3">
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

            <button type="submit" class="btn bg-gradient-primary">Update Unit</button>
            <a href="{{ route('administrator.units.index') }}" class="btn bg-gradient-info">Cancel</a>
        </form>
    </div>

@endsection