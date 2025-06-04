<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="bg-info ms-auto me-auto text-center" style="width:20%; margin-top:250px">
        <h2>Log in admin</h2>
        @if(session('error'))
            <p style="color:red">{{ session('error') }}</p>
        @endif
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <label>Username:</label><br>
            <input type="text" name="username" required><br><br>

            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>

            <button type="submit" class="mb-3">Log in</button>
        </form>
    </div>
</body>
</html>