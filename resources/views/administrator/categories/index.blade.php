


@extends('layouts.user_type.auth')

@section('content')

categories administrator
@include('components.notifications')
    <div class="mx-3 mb-3">
        <h2>Categories</h2>
        <a href="{{ route('administrator.categories.create') }}" class="btn btn-success">Add Category</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('administrator.categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('administrator.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


