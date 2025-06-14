@extends('admin.dashboard')

@section('content')
    <h2 class="mb-3">Comment list</h2>
    <button class="btn btn-secondary mb-3">
        <a class="text-light text-decoration-none" href="{{ route('admin.comments.create') }}">&#43; Add</a>
    </button>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <table class="table table-hover">
        <thead>
            <tr>
                <th>User</th>
                <th>Shoe</th>
                <th>Content</th>
                <th>Created date</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $comment)
                <tr>
                    <th>{{ $comment->user->username }}</th>
                    <th>{{ $comment->shoe->name }}</th>
                    <th>{{ $comment->content }}</th>
                    <th>{{ $comment->created_at }}</th>
                    <th><a class="text-dark text-decoration-none" href="{{ route('admin.comments.edit', $comment) }}">&#9998; Change</a></th>
                    <th>
                        <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn border-0" type="submit" onclick="return confirm('Do you want to delete this rating?')">&#10006; Delete</button>
                        </form>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
