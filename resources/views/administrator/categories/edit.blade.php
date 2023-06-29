@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="card mx-3 mb-3">
    <div class="card-header pb-3">
        <h6 class="m-0">Edit Item</h6>
        <p class="text-sm mb-0"></p>
    </div>
    <div class="card-body pt-0">
        <form method="POST" action="{{ route('categories.update', $category->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $category->name }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ $category->description }}</textarea>
                <small id="character_count" class="form-text text-muted">Type to check remaining character</small>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn bg-gradient-primary me-2">Edit Category</button>
                    <a href="{{ route('categories.index') }}" class="btn bg-gradient-info">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection