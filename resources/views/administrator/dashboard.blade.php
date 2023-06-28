@extends('layouts.user_type.auth')

@section('content')

@include('components.notifications')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card h-100">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Units</p>
                                <h5 class="font-weight-bolder mb-0">{{ $totalUnits }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-lg fa-building opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card h-100">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Unit Admin</p>
                                <h5 class="font-weight-bolder mb-0">{{ $totalUnitadmins }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-lg fa-user-cog opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card h-100">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Categories</p>
                                <h5 class="font-weight-bolder mb-0">{{ $totalCategories }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-lg fa-cubes opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex flex-column h-100">
                            <h5 class="font-weight-bolder ps-3">Welcome,</h5>
                            <p class="mb-1 ps-3 text-sm">You are logged in as Administrator</p>
                            <p class="mb-1 ps-3 text-sm">Choose a menu below to get started:</p>
                            <div class="card my-3 overflow-hidden"
                                style="background-image: url('{{ asset('assets/img/curved-images/curved14.jpg') }}');">
                                <span class="mask bg-gradient-dark"></span>
                                <div class="card-body overflow-hidden position-relative border-radius-xl p-3">
                                    <h6 class="card-title text-white">Categories</h6>
                                    <p class="card-text text-sm mb-2 text-white">Manage the list of Categories.</p>
                                    <a href="{{ route('administrator.categories.index') }}"
                                        class="text-primary font-weight-bold underline">See More</a>
                                </div>
                            </div>
                            <div class="card mb-3 overflow-hidden"
                                style="background-image: url('{{ asset('assets/img/curved-images/curved14.jpg') }}');">
                                <span class="mask bg-gradient-dark"></span>
                                <div class="card-body overflow-hidden position-relative border-radius-xl p-3">
                                    <h6 class="card-title text-white">Unit Admin</h6>
                                    <p class="card-text text-sm mb-2 text-white">See who is the admin for certain unit.</p>
                                    <a href="{{ route('unitadmins.index') }}"
                                        class="text-primary font-weight-bold underline">See More</a>
                                </div>
                            </div>
                            <div class="card mb-3 overflow-hidden"
                                style="background-image: url('{{ asset('assets/img/curved-images/curved14.jpg') }}');">
                                <span class="mask bg-gradient-dark"></span>
                                <div class="card-body overflow-hidden position-relative border-radius-xl p-3">
                                    <h6 class="card-title text-white">Unit</h6>
                                    <p class="card-text text-sm mb-2 text-white">Manage the list of Units.</p>
                                    <a href="{{ route('administrator.units.index') }}"
                                        class="text-primary font-weight-bold underline">See More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection