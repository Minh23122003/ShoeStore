@extends('admin.dashboard')

@section('content')
    <h2 class="mb-3">Category list</h2>
    <button class="btn btn-secondary mb-3">
        <a class="text-light text-decoration-none" href="{{ route('admin.categories.create') }}">&#43; Add</a>
    </button>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th>{{ $category->name }}</th>
                    <th><a class="text-dark text-decoration-none" href="{{ route('admin.categories.edit', $category) }}">&#9998; Change</a></th>
                    <th>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn border-0" type="submit" onclick="return confirm('Do you want to delete this category?')">&#10006; Delete</button>
                        </form>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
