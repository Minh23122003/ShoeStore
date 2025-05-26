@extends('admin.dashboard')

@section('content')
    <h2 class="mb-3">Bill list</h2>
    <button class="btn btn-secondary mb-3">
        <a class="text-light text-decoration-none" href="{{ route('admin.bills.create') }}">&#43; Add</a>
    </button>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <table class="table table-hover">
        <thead>
            <tr>
                <th>User</th>
                <th>Shoe</th>
                <th>Quantity</th>
                <th>Size</th>
                <th>Payment date</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bills as $bill)
                <tr>
                    <th>{{ $bill->user->username }}</th>
                    <th>{{ $bill->shoe->name }}</th>
                    <th>{{ $bill->quantity }}</th>
                    <th>{{ $bill->size }}</th>
                    <th>{{ $bill->payment_at == null ? 'Unpaid' : $bill->payment_at }}</th>
                    <th><a class="text-dark text-decoration-none" href="{{ route('admin.bills.edit', $bill) }}">&#9998; Change</a></th>
                    <th>
                        <form action="{{ route('admin.bills.destroy', $bill) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn border-0" type="submit" onclick="return confirm('Do you want to delete this bill?')">&#10006; Delete</button>
                        </form>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
