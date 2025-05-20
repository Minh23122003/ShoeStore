@extends('admin.dashboard')

@section('content')
    <h2>Change user</h2>
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')
        <div class="container row">
            <div class="col-md-6">
                <label class="form-label">Username:</label>
                <input style="width:80%" class="form-control" type="text" name="username" value="{{ old('username', $user->username) }}"><br>
                @error('username')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Password:</label>
                <input style="width:80%" class="form-control" type="password" name="password" value="{{ old('password') }}"><br>
                @error('password')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="container row">
            <div class="col-md-6">
                <label class="form-label">Name:</label>
                <input style="width:80%" class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}"><br>
                @error('name')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Email:</label>
                <input style="width:80%" class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}"><br>
                @error('email')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="container row">
            <div class="col-md-6">
                <label class="form-label">Address:</label>
                <input style="width:80%" class="form-control" type="text" name="address" value="{{ old('address', $user->address) }}"><br>
                @error('address')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone:</label>
                <input style="width:80%" class="form-control" type="number" name="phone" value="{{ old('phone', $user->phone) }}"><br>
                @error('phone')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Admin:</label>
            <select class="form-select" name="is_admin" style="width:20%">
                <option value="1" {{ old('is_admin', $user->is_admin) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('is_admin', $user->is_admin) == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button class="btn btn-success" type="submit">Change</button>
    </form>
@endsection
