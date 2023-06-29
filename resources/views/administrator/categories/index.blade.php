@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="card mx-3 mb-4">
    <div class="card-header pb-0">
        <div class="d-flex align-items-center justify-content-between">
            <div>
            <h6 class="m-0">Categories table</h6>
            <p class="text-sm">Categories classify items to make it easier to manage through them.</p>
            </div>
            <div>
                <h6 class="m-0 text-sm">Total categories:</h6>
                <p class="d-inline-block me-2 text-sm">{{ $categories->total() }}</p>
            </div>
            <div class="ml-auto p-0">
                <a href="{{ route('categories.create') }}" class="btn bg-gradient-primary m-0">Add Category</a>
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
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Total Items</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Description</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="align-middle ps-4">
                                <span class="text-xs font-weight-bold">{{ $category->id }}</span>
                            </td>                                              
                            <td class="align-middle">
                                <span class="text-xs font-weight-bold">{{ $category->name }}</span>
                            </td>                                              
                            <td class="align-middle">
                                <span class="text-xs font-weight-bold">{{ $category->items()->where('category_id', $category->id)->count() }}</span>
                            </td>
                            <td class="align-middle">
                                <span class="text-xs font-weight-bold">
                                @php
                                    $description = $category->description;
                                    if (strlen($description) > 70) {
                                        $description = substr($description, 0, 70) . '...';
                                    }
                                    echo $description;
                                @endphp</span>
                            </td> 
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('categories.show', ['category' => $category->id]) }}" class="me-2">
                                        <button type="button" class="btn btn-action btn-info mb-0" title="Show detail about this item">
                                        <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}">
                                        <button type="button" class="btn btn-action btn-primary mb-0 me-1" title="Edit this category">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                    </a>
                                    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-action mb-0 ms-1 btn-danger" title="Delete this category">
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
<div class="pagination-wrapper">
  <ul class="pagination pagination-info justify-content-center">
    <li class="page-item">
        <a class="page-link" href="{{ $categories->previousPageUrl() }}" aria-label="Previous">
            <span aria-hidden="true"><i class="ni ni-bold-left" aria-hidden="true"></i></span>
        </a>
    </li>

    @for ($i = 1; $i <= $categories->lastPage(); $i++)
      <li class="page-item{{ $categories->currentPage() == $i ? ' active' : '' }}">
          <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
      </li>
    @endfor

    <li class="page-item">
      <a class="page-link" href="{{ $categories->nextPageUrl() }}" aria-label="Next">
        <span aria-hidden="true"><i class="ni ni-bold-right" aria-hidden="true"></i></span>
      </a>
    </li>
  </ul>
</div>

@endsection
