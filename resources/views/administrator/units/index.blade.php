@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="card mx-3 mb-3">
    <div class="card-header pb-3">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h6 class="m-0">Units table</h6>
                <p class="text-sm">Units are entities available for borrowing.</p>
            </div>
            <div>
                <h6 class="m-0 text-sm">Total units:</h6>
                <p class="d-inline-block me-2 text-sm">{{ $totalUnits }}</p>
            </div>
            <div class="form-group mb-3">
                <form action="{{ route('units.index') }}" method="GET">
                    <div class="input-group">
                        <button class="input-group-text search-icon" type="submit"><i class="fas fa-search"></i></button>
                        <input class="form-control px-2" name="search" placeholder="Search" type="text" value="{{ request('search') }}">
                    </div>
                </form>
            </div>
            <div class="ml-auto p-0">
                <a href="{{ route('units.create') }}" class="btn bg-gradient-primary">Add Unit</a>
            </div>
        </div>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-secondary text-xxs font-weight-bolder pe-3">ID</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Name</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Location</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Total Items</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Description</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($units as $unit)
                        <tr>
                            <td class="align-middle ps-4">
                                <span class="text-xs font-weight-bold">{{ $unit->id }}</span>
                            </td>
                            <td class="align-middle">
                                <span class="text-xs font-weight-bold">{{ $unit->name }}</span>
                            </td>
                            <td class="align-middle">
                                <span class="text-xs font-weight-bold">{{ $unit->location }}</span>
                            </td>
                            <td class="align-middle">
                                <span class="text-xs font-weight-bold">{{ $unit->items()->where('unit_id', $unit->id)->count() }}</span>
                            </td>
                            <td class="align-middle">
                                <span class="text-xs font-weight-bold">
                                @php
                                    $description = $unit->description;
                                    if (strlen($description) > 50) {
                                        $description = substr($description, 0, 50) . '...';
                                    }
                                    echo $description;
                                @endphp</span>
                            </td> 
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('units.show', ['unit' => $unit->id]) }}" class="me-2">
                                        <button type="button" class="btn btn-action btn-info mb-0" title="Show detail about this item">
                                        <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('units.edit', ['unit' => $unit->id]) }}">
                                        <button type="button" class="btn btn-action btn-primary mb-0 me-1" title="Edit this unit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                    </a>
                                    <form action="{{ route('units.destroy', ['unit' => $unit->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this unit?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-action mb-0 ms-1 btn-danger" title="Delete this unit">
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
        <a class="page-link" href="{{ $units->previousPageUrl() }}" aria-label="Previous">
            <span aria-hidden="true"><i class="fas fa-chevron-left" aria-hidden="true"></i></span>
        </a>
    </li>

    @for ($i = 1; $i <= $units->lastPage(); $i++)
      <li class="page-item{{ $units->currentPage() == $i ? ' active' : '' }}">
          <a class="page-link" href="{{ $units->url($i) }}">{{ $i }}</a>
      </li>
    @endfor

    <li class="page-item">
      <a class="page-link" href="{{ $units->nextPageUrl() }}" aria-label="Next">
        <span aria-hidden="true"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
      </a>
    </li>
  </ul>
</div>

@endsection
