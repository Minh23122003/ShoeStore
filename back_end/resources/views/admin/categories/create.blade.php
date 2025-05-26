@extends('admin.dashboard')

@section('content')
    <h2>Add category</h2>
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <label class="form-label">Name:</label>
        <input style="width:50%" class="form-control" type="text" name="name" value="{{ old('name') }}"><br>
        @error('name')
            <div class="text-danger mb-3">{{ $message }}</div>
        @enderror

        <button class="btn btn-success" type="submit">Save</button>
    </form>
@endsection
