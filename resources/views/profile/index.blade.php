@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  <div class="container-fluid px-3">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Your Profile Information</h6>
          </div>
            <div class="card-body">
              <p><strong>Name:</strong><br> {{ $user->name }}</p>
              <p><strong>Email:</strong><br> {{ $user->email }}</p>
              <p><strong>Role:</strong><br> {{ $user->role }}</p>
              <p><strong>Phone:</strong><br> {{ $user->phone }}</p>
              <div class="mt-4">
                  <a href="{{ route('profile.edit') }}" class="btn btn-dark me-3">Edit Profile</a>
                  <a href="{{ route('profile.changePassword') }}" class="btn btn-primary">Change Password</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
