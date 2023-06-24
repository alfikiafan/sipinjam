@extends('layouts.user_type.auth')

@section('content')

units/create administrator
<div class="mx-3 mb-3">
        <form method="POST" action="{{ route('administrator.units.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Unit Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Unit Location</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn bg-gradient-primary">Create Unit</button>
            <a href="{{ route('administrator.units.index') }}" class="btn bg-gradient-info">Cancel</a>
        </form>
    </div>
@endsection