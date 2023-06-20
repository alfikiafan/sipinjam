@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  <div class="container-fluid py-0">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Your Profile Information</h6>
          </div>
          <div class="card-body">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> {{ $user->role }}</p>
                <p><strong>Phone:</strong> {{ $user->phone }}</p>
                <div class="mt-4">
                    <a href="{{ route('borrower.profile.edit') }}" class="btn btn-dark me-3">Edit Profile</a>
                    <a href="{{ route('borrower.profile.changePassword') }}" class="btn btn-primary">Change Password</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
