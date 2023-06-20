@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  <div class="container-fluid py-0 mx-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Usage List</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Booking ID</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Item</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Start Date</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">End Date</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usages as $usage)
                    <tr>
                        <td>
                            <p class="text-xs font-weight-bold mb-0 ps-3">{{ $usage->id }}</p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $usage->booking_id }}</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $usage->booking->item->photo }}" class="avatar avatar-sm me-3" alt="usage-image">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-0 text-sm">{{ $usage->booking->item->name }}</h6>
                                    <p class="text-xs text-secondary mb-0">{{ $usage->booking->item->Category->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-xs font-weight-bold">{{ $usage->booking->start_date }}</span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-xs font-weight-bold">{{ $usage->booking->end_date }}</span>
                        </td>
                        <td class="align-middle">
                            <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                            <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2"></i>Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection