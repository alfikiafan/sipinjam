@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

@php
  $status = request('status');
@endphp

<div class="card mx-3 mb-4">
  <div class="card-header pb-0">
    <div class="d-flex align-items-center justify-content-between">
      <div>
        <h6 class="m-0">Unit administrators table</h6>
        <p class="text-sm">See all unit admin in your organization</p>
      </div>
      <div>
        <h6 class="m-0 text-sm">Total number of:</h6>
        <p class="d-inline-block me-2 text-sm">Unit Admins: {{ $totalUnitAdmins }}</p>
        <p class="d-inline-block me-2 text-sm">Units: {{ $totalUnits }}</p>
      </div>
      <div class="form-group mb-3">
        <form action="{{ route('unitadmins.index') }}" method="GET">
        <div class="input-group">
          <button class="input-group-text search-icon" type="submit"><i class="fas fa-search"></i></button>
          <input class="form-control px-2" name="search" placeholder="Search" type="text" value="{{ request('search') }}">
        </div>
        </form>
      </div>
      <div class="ml-auto p-0">
        <a href="{{ route('unitadmins.create') }}" class="btn bg-gradient-primary">Add Unit Admins</a>
      </div>
    </div>
  </div>
  <div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class="text-secondary text-xxs font-weight-bolder pe-3">ID</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Unit Admin</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Unit</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Phone</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Address</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($unitadmins as $unitadmin)
          <tr>
            <td>
              <p class="text-xs font-weight-bold mb-0 ps-3">{{ $unitadmin->id }}</p>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <img src="{{ asset($unitadmin->photo) }}" class="avatar avatar-sm me-3" alt="unitadmin-image">
                <div class="d-flex flex-column">
                  <h6 class="mb-0 text-sm">{{ $unitadmin->name }}</h6>
                  <p class="text-xs text-secondary mb-0">{{ $unitadmin->email }}</p>
                </div>
              </div>
            </td>
            <td>
              <p class="text-xs font-weight-bold mb-0">{{ $unitadmin->unit->name }}</p>
            </td>
            <td>
              <p class="text-xs font-weight-bold mb-0">{{ $unitadmin->phone }}</p>
            </td>
            <td class="align-middle">
              <span class="text-xs font-weight-bold">
              @php
                  $address = $unitadmin->address;
                  if (strlen($address) > 25) {
                      $address = substr($address, 0, 25) . '...';
                  }
                  echo $address;
              @endphp
              </span>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <a href="{{ route('unitadmins.show', ['unitadmin' => $unitadmin->id]) }}" class="me-2">
                  <button type="button" class="btn btn-action btn-info mb-0" title="Show detail about this unit admin">
                    <i class="fas fa-eye"></i>
                  </button>
                </a>
                <a href="{{ route('unitadmins.edit', ['unitadmin' => $unitadmin->id]) }}">
                  <button type="button" class="btn btn-action btn-primary mb-0 me-1" title="Edit this unit admin data">
                    <i class="fas fa-pencil-alt"></i>
                  </button>
                </a>
                <form action="{{ route('unitadmins.destroy', ['unitadmin' => $unitadmin->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this unit admin data?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-action mb-0 ms-1 btn-danger" title="Delete this unit admin data">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="mb-4">
  <ul class="pagination pagination-info justify-content-center">
    <li class="page-item">
        <a class="page-link" href="{{ $unitadmins->previousPageUrl() }}" aria-label="Previous">
            <span aria-hidden="true"><i class="fas fa-chevron-left" aria-hidden="true"></i></span>
        </a>
    </li>

    @for ($i = 1; $i <= $unitadmins->lastPage(); $i++)
      <li class="page-item{{ $unitadmins->currentPage() == $i ? ' active' : '' }}">
          <a class="page-link" href="{{ $unitadmins->url($i) }}">{{ $i }}</a>
      </li>
    @endfor

    <li class="page-item">
      <a class="page-link" href="{{ $unitadmins->nextPageUrl() }}" aria-label="Next">
        <span aria-hidden="true"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
      </a>
    </li>
  </ul>
</div>

@endsection