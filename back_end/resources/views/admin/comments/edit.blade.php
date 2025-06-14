@extends('admin.dashboard')

@section('content')
    <h2>Change comment</h2>
    <form method="POST" action="{{ route('admin.comments.update', $comment) }}">
        @csrf
        @method('PUT')
        <div class="container row">
            <div class="col-md-6">
                <label class="form-label">Content:</label>
                <input style="width:80%" class="form-control" type="text" name="content" value="{{ old('content', $comment->content) }}"><br>
                @error('content')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="container row mb-3">
            <div class="col-md-6">
                <label class="form-label">User:</label>
                <select class="form-select" name="user_id" style="width:50%">
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $comment->user_id) == $user->id ? 'selected' : '' }}>{{$user->username}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Shoe:</label>
                <select class="form-select" name="shoe_id" style="width:50%">
                    @foreach ($shoes as $shoe)
                    <option value="{{ $shoe->id }}" {{ old('shoe_id', $comment->shoe_id) == $shoe->id ? 'selected' : '' }}>{{$shoe->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <button class="btn btn-success" type="submit">Change</button>
    </form>
@endsection
