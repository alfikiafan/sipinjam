@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="mx-3 mb-3">
    <div class="mb-4">
    <h6 class="m-0">Edit Item</h6>
    <p class="text-sm mb-0">Feel empowered to modify this item by changing its status, adjusting the quantity, or making any necessary edits to its details.</p>
  </div>
    <form method="POST" action="{{ route('items.update', $item->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="categories_id">Category</label>
                    <select class="form-control" id="categories_id" name="categories_id" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $item->categories_id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('categories_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $item->name) }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $item->brand) }}" required>
                    @error('brand')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="serial_number">Serial Number</label>
                    <input type="text" class="form-control" id="serial_number" name="serial_number" value="{{ old('serial_number', $item->serial_number) }}">
                    @error('serial_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                    @error('photo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $item->quantity) }}" min="0" required>
                    @error('quantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="">Select Status</option>
                        <option value="available" {{ old('status', $item->status) == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="not available" {{ old('status', $item->status) == 'not available' ? 'selected' : '' }}>Not Available</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn bg-gradient-primary me-2">Update Item</button>
                <a href="/items" class="btn bg-gradient-info">Cancel</a>
            </div>
        </div>
    </form>
</div>

@endsection
