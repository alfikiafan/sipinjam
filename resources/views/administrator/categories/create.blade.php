extends('layouts.user_type.auth')

@section('content')

categories/create administrator
    <div class="mx-3 mb-3">
        <form method="POST" action="{{ route('administrator.categories.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn bg-gradient-primary">Add Category</button>
                        <a href="/items" class="btn bg-gradient-info">Cancel</a>
                    </div>
                </div>
            <button type="submit" class="btn bg-gradient-primary">Create Category</button>
            <a href="{{ route('administrator.categories.index') }}" class="btn bg-gradient-info">Cancel</a>
        </form>
    </div>

@endsection