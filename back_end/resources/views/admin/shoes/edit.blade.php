@extends('admin.dashboard')

@section('content')
    <h2>Change shoe</h2>
    <form method="POST" action="{{ route('admin.shoes.update', $shoe) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container row">
            <div class="col-md-6">
                <label class="form-label">Name:</label>
                <input style="width:80%" class="form-control" type="text" name="name" value="{{ old('name', $shoe->name) }}"><br>
                @error('name')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Information:</label>
                <input style="width:80%" class="form-control" type="text" name="information" value="{{ old('information', $shoe->information) }}"><br>
                @error('information')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="container row">
            <div class="col-md-6">
                <label class="form-label">Quantity:</label>
                <input style="width:80%" class="form-control" type="number" name="quantity" value="{{ old('quantity', $shoe->quantity) }}"><br>
                @error('quantity')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Price:</label>
                <input style="width:80%" class="form-control" type="number" name="price" value="{{ old('price', $shoe->price) }}"><br>
                @error('price')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="container row">
            <div class="col-md-6">
                <label class="form-label">Note:</label>
                <input style="width:80%" class="form-control" type="text" name="note" value="{{ old('note', $shoe->note) }}"><br>
                @error('note')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Category:</label>
                <select class="form-select" name="category_id" style="width:50%">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $shoe->category_id) == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Choose image:</label>
            <input style="width:50%" class="form-control" type="file" name="image">
            @error('image')
                <div class="text-danger mb-3">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success" type="submit">Change</button>
    </form>
@endsection
