@extends('layouts.user_type.auth')

@section('content')

<form method="POST" action="{{ route('profile.update') }}">
  @csrf
  @method('PUT')
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-dark me-3">Save Changes</button>
  <a href="{{ route('profile.index') }}" class="btn btn-info">Cancel</a>
</form>

@endsection