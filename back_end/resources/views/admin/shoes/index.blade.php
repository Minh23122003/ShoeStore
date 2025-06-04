@extends('admin.dashboard')

@section('content')
    <h2 class="mb-3">Shoe list</h2>
    <button class="btn btn-secondary mb-3">
        <a class="text-light text-decoration-none" href="{{ route('admin.shoes.create') }}">&#43; Add</a>
    </button>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Information</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Note</th>
                <th>Category</th>
                <th>Image</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shoes as $shoe)
                <tr>
                    <th>{{ $shoe->name }}</th>
                    <th>{{ $shoe->information }}</th>
                    <th>{{ $shoe->quantity }}</th>
                    <th>{{ $shoe->price }}</th>
                    <th>{{ $shoe->note }}</th>
                    <th>{{ $shoe->category->name }}</th>
                    <th><img src="/storage/shoes/GSTq0V3HXKl8Tr3t37NJPAGelZM6e7Hhx75rtBh5.png" width="100"></th>
                    <th><a class="text-dark text-decoration-none" href="{{ route('admin.shoes.edit', $shoe) }}">&#9998; Change</a></th>
                    <th>
                        <form action="{{ route('admin.shoes.destroy', $shoe) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn border-0" type="submit" onclick="return confirm('Do you want to delete this shoe?')">&#10006; Delete</button>
                        </form>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
