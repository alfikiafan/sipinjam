@extends('layouts.user_type.auth')

@section('content')

@include('components.notifications')

    <div class="mx-3 mb-3">
        <form method="POST" action="{{ route('administrator.categories.update', $category->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $category->name }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn bg-gradient-primary">Update Category</button>
            <a href="{{ route('administrator.categories.index') }}" class="btn bg-gradient-info">Cancel</a>
        </form>
    </div>
@endsection