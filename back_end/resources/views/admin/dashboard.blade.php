<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="" style="margin-bottom: 70px">
        <nav class="navbar navbar-expand-sm bg-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('admin') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-dark">
                                Log out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container-fluid row">
        <div class="col-md-3">
            <div class="bg-info d-flex align-items-center ps-2" style="height: 50px">Tables list</div>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th width="150"><a class="text-dark text-decoration-none" href="{{ route('admin.categories.index') }}">categories</a></th>
                        <th width="100"><a class="text-dark text-decoration-none" href="{{ route('admin.categories.create') }}">&#43; Add</a></th>
                        <th><a class="text-dark text-decoration-none" href="{{ route('admin.categories.index') }}">&#9998; Change</a></th>
                    </tr>
                    <tr>
                        <th width="150"><a class="text-dark text-decoration-none" href="{{ route('admin.users.index') }}">users</a></th>
                        <th width="100"><a class="text-dark text-decoration-none" href="{{ route('admin.users.create') }}">&#43; Add</a></th>
                        <th><a class="text-dark text-decoration-none" href="{{ route('admin.users.index') }}">&#9998; Change</a></th>
                    </tr>
                    <tr>
                        <th width="150"><a class="text-dark text-decoration-none" href="{{ route('admin.shoes.index') }}">shoes</a></th>
                        <th width="100"><a class="text-dark text-decoration-none" href="{{ route('admin.shoes.create') }}">&#43; Add</a></th>
                        <th><a class="text-dark text-decoration-none" href="{{ route('admin.shoes.index') }}">&#9998; Change</a></th>
                    </tr>
                    <tr>
                        <th width="150"><a class="text-dark text-decoration-none" href="{{ route('admin.bills.index') }}">bills</a></th>
                        <th width="100"><a class="text-dark text-decoration-none" href="{{ route('admin.bills.create') }}">&#43; Add</a></th>
                        <th><a class="text-dark text-decoration-none" href="{{ route('admin.bills.index') }}">&#9998; Change</a></th>
                    </tr>
                    <tr>
                        <th width="150"><a class="text-dark text-decoration-none" href="{{ route('admin.ratings.index') }}">ratings</a></th>
                        <th width="100"><a class="text-dark text-decoration-none" href="{{ route('admin.ratings.create') }}">&#43; Add</a></th>
                        <th><a class="text-dark text-decoration-none" href="{{ route('admin.ratings.index') }}">&#9998; Change</a></th>
                    </tr>
                    <tr>
                        <th width="150"><a class="text-dark text-decoration-none" href="{{ route('admin.comments.index') }}">comments</a></th>
                        <th width="100"><a class="text-dark text-decoration-none" href="{{ route('admin.comments.create') }}">&#43; Add</a></th>
                        <th><a class="text-dark text-decoration-none" href="{{ route('admin.comments.index') }}">&#9998; Change</a></th>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-9" style="padding-left:100px">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
