@extends('layouts.user_type.auth')

@section('content')

<form method="POST" action="{{ route('borrower.profile.update') }}">
  @csrf
  @method('PUT')
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-dark">Save Changes</button>
</form>

@endsection