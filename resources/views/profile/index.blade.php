@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

    <div class="container-fluid">
        <div class="page-header min-height-150 border-radius-xl mt-4" style="background-image: url('../assets/img/curved.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto mx-2">
                    <div class="avatar avatar-xl position-relative avatar-profile">
                        <img src="{{ asset(Auth::user()->photo) }}" alt="..." class="w-100 border-radius-lg shadow-sm image-hover">
                        <label for="photo-upload" class="edit-profile-btn" id="edit-profile">
                            Change Image
                        </label>
                        <form action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data" id="profile-form">
                            @csrf
                            <input id="photo-upload" type="file" name="photo" accept="image/*" class="upload-input">
                        </form>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">{{ $user->name }}</h5>
                        <p class="mb-0 font-weight-bold text-sm">{{ $user->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="card mx-4 mb-3">
            <div class="card-header pb-0 px-4">
                <h6 class="mb-0">Profile Information</h6>
            </div>
            <div class="card-body p-4">
                <p class="text-sm">
                    {{ $user->about_me }}
                </p>
                <hr class="horizontal gray-light my-4">
                <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Name:</strong> &nbsp; {{ $user->name }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Phone:</strong> &nbsp; {{ $user->phone }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Address:</strong> &nbsp; {{ $user->address }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">City:</strong> &nbsp; {{ $user->city }}</li>
                </ul>
                <div class="mt-4">
                    <a href="{{ route('profile.edit') }}" class="btn bg-gradient-dark me-3">Edit Profile</a>
                    <a href="{{ route('profile.changePassword') }}" class="btn bg-gradient-primary">Change Password</a>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>

@endsection