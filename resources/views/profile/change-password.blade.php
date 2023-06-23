@extends('layouts.user_type.auth')

@section('content')

<div class="mx-3 mb-3">
  <div class="mb-4">
    <h6 class="m-0">Change Password</h6>
    <p class="text-sm mb-0">Change your password to something that is both secure and easy to remember.</p>
  </div>
  <form method="POST" action="{{ route('profile.updatePassword') }}">
  @csrf
  @method('PUT')
  <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="current_password">Current Password</label>
          <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" placeholder="Enter current password">
          @error('current_password')
              <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="password">New Password</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter new password">
          @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="password_confirmation">Confirm Password</label>
          <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
          @error('password_confirmation')
              <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>
    <button type="submit" class="btn bg-gradient-dark me-3">Change Password</button>
    <a href="{{ route('profile.index') }}" class="btn bg-gradient-info">Cancel</a>
  </form>
</div>
@endsection
