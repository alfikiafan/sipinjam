@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Bookings table</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Item</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Start Date</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">End Date</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($bookings as $booking)
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="../assets/img/item-image.jpg" class="avatar avatar-sm me-3" alt="item-image">
                        <div class="d-flex flex-column">
                          <h6 class="mb-0 text-sm">Item Name</h6>
                          <p class="text-xs text-secondary mb-0">Category</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">User Name</p>
                      <p class="text-xs text-secondary mb-0">Email</p>
                    </td>
                    <td class="align-middle text-center">
                      <span class="badge bg-success badge-sm">Approved</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-xs font-weight-bold text-secondary">Start Date</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-xs font-weight-bold text-secondary">End Date</span>
                    </td>
                    <td class="align-middle">
                      <a href="{{ route('bookings.edit', $booking->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit booking">
                        Edit
                      </a>
                      <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete booking">
                          Delete
                        </button>
                      </form>
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
