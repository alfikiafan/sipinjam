@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

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
                    <label for="note_text" class="form-label">Note</label>
                    <textarea class="form-control" id="note_text" name="note_text" rows="4">{{ $usage->note_text }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-md-5 ms-4">
            <p><strong>Item:</strong><br> {{ $usage->booking->item->name }}</p>
            <p><strong>Serial Number:</strong><br> {{ $usage->booking->item->serial_number }}</p>
            <p><strong>Borrower:</strong><br> {{ $usage->booking->user->name }}</p>
            <p><strong>Quantity:</strong><br> {{ $usage->booking->quantity }}</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary me-2">Update Usage</button>
            <a href="{{ route('usages.index') }}" class="btn btn-info">Cancel</a>
        </div>
    </div>
</form>

@endsection
