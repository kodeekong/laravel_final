<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Add any stylesheets or meta tags here -->
</head>
<body>
    <div class="container">
        <h1>Welcome to your Dashboard, {{ $user->first_name }}!</h1>

        <p>You are logged in as: {{ $user->role }}</p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>