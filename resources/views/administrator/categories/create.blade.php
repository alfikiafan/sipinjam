@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="mx-3 mb-3">
    <div class="mb-4">
        <h6 class="m-0">Add a New Category</h6>
        <p class="text-sm mb-0">Easily add a new category to improve item organization.</p>
    </div>
        <form method="POST" action="{{ route('administrator.categories.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"></textarea>
                        <small id="character_count" class="form-text text-muted">Type to check remaining character</small>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn bg-gradient-primary me-2">Add Category</button>
                    <a href="{{ route('administrator.categories.index') }}" class="btn bg-gradient-info">Cancel</a>
                </div>
            </div>
        </form>
    </div>

@endsection