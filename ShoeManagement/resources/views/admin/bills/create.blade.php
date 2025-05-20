@extends('admin.dashboard')

@section('content')
    <h2>Add bill</h2>
    <form method="POST" action="{{ route('admin.bills.store') }}">
        @csrf
        <div class="container row">
            <div class="col-md-6">
                <label class="form-label">Quantity:</label>
                <input style="width:80%" class="form-control" type="number" name="quantity" value="{{ old('quantity') }}"><br>
                @error('quantity')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Size:</label>
                <input style="width:80%" class="form-control" type="number" name="size" value="{{ old('size') }}"><br>
                @error('size')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="container row mb-3">
            <div class="col-md-6">
                <label class="form-label">User:</label>
                <select class="form-select" name="user_id" style="width:50%">
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{$user->username}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Shoe:</label>
                <select class="form-select" name="shoe_id" style="width:50%">
                    @foreach ($shoes as $shoe)
                    <option value="{{ $shoe->id }}" {{ old('shoe_id') == $shoe->id ? 'selected' : '' }}>{{$shoe->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <button class="btn btn-success" type="submit">Save</button>
    </form>
@endsection
