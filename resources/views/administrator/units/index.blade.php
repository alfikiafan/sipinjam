@extends('layouts.user_type.auth')

@section('content')

@include('components.notifications')

    <div class="mx-3 mb-3">
        <h2>Units</h2>
        <a href="{{ route('administrator.units.create') }}" class="btn btn-success">Add Unit</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($units as $unit)
                    <tr>
                        <td>{{ $unit->id }}</td>
                        <td>{{ $unit->name }}</td>
                        <td>{{ $unit->location }}</td>
                        <td>
                            <a href="{{ route('administrator.units.edit', $unit->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('administrator.units.destroy', $unit->id) }}" method="POST" class="d-inline">
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