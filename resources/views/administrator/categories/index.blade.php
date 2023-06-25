@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

    <div class="container-fluid px-3">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="m-0">Categories table</h6>
                                <p class="text-sm">See all categories</p>
                            </div>
                            <div>
                                <h6 class="m-0 text-sm">Total number of categories:</h6>
                                <p class="d-inline-block me-2 text-sm">{{ $categories->count() }}</p>
                            </div>
                            <div class="ml-auto p-0">
                                <a href="{{ route('administrator.categories.create') }}" class="btn bg-gradient-primary m-0">Add Category</a>
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
                                        <th class="text-secondary text-xxs font-weight-bolder px-2">Number of Items</th>
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
                                                @if ($category->item)
                                                    <span class="text-xs font-weight-bold">{{ $category->item->quantity }}</span>
                                                @else
                                                <span class="text-xs font-weight-bold">{{ $category->items()->where('category_id', $category->id)->count() }}</span>
                                                @endif                                            
                                            </td>                                            
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('administrator.categories.show', ['category' => $category->id]) }}" class="me-2">
                                                        <button type="button" class="btn btn-action btn-info mb-0" title="Show detail about this item">
                                                        <i class="fas fa-eye"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('administrator.categories.edit', ['category' => $category->id]) }}">
                                                        <button type="button" class="btn btn-action btn-primary mb-0 me-1" title="Edit this category">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                    </a>
                                                    <form action="{{ route('administrator.categories.destroy', ['category' => $category->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
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
            </div>
        </div>
    </div>
@endsection
