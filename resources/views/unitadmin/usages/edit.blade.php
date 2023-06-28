@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="card mx-3 mb-3">
    <div class="card-header pb-3">
        <h6 class="m-0">Edit Usage</h6>
        <p class="text-sm mb-0">Feel free to edit the due date or update the note text specifically for your borrower's convenience and clarity.</p>
    </div>
    <div class="card-body pt-0">
        <form method="POST" action="{{ route('usages.update', $usage->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="due_date">Due Date</label>
                            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date', $usage->due_date) }}" required>
                            @error('due_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea class="form-control" id="note" name="note" rows="4" maxlength="300">{{ $usage->note }}</textarea>
                            <small id="character_count" class="form-text text-muted">Type to check remaining character</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 ms-4">
                    <p class="text-sm text-dark"><strong>Item:</strong><br> {{ $usage->booking->item->name }} (ID: {{ $usage->booking->item->id }})</p>
                    <p class="text-sm text-dark"><strong>Serial Number:</strong><br> {{ $usage->booking->item->serial_number }}</p>
                    <p class="text-sm text-dark"><strong>Borrower:</strong><br> {{ $usage->booking->user->name }} (ID: {{ $usage->booking->user->id }})</p>
                    <p class="text-sm text-dark"><strong>Quantity:</strong><br> {{ $usage->booking->quantity }}</p>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <button type="submit" class="btn bg-gradient-primary me-2">Update Usage</button>
                    <a href="{{ route('usages.index') }}" class="btn bg-gradient-info">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
