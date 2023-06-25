@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="mx-3 mb-3">
  <div class="mb-4">
    <h6 class="m-0">Edit Profile</h6>
    <p class="text-sm mb-0">Take the opportunity to personalize and tailor your profile according to your preferences and individuality.</p>
  </div>
  <form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PUT')
    <div class="row">
      @can('administratorOrBorrower')
      <div class="col-md-6">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
          @error('name')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
          @error('phone')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}" required>
          @error('address')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label for="city">City</label>
          <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $user->city) }}" required>
          @error('city')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      @endcan
      <div class="col-md-12">
        <div class="form-group">
          <label for="about_me">About Me</label>
          <textarea class="form-control" id="about_me" name="about_me" rows="3" maxlength="500">{{ old('about_me', $user->about_me) }}</textarea>
          <small id="character_count" class="form-text text-muted">Type to check remaining character</small>
          @error('about_me')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>
    <button type="submit" class="btn bg-gradient-dark me-3">Save Changes</button>
    <a href="{{ route('profile.index') }}" class="btn bg-gradient-info">Cancel</a>
  </form>
</div>

@endsection