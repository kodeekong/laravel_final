<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">

        <h1>Welcome to your Dashboard, {{ auth()->user()->first_name }}!</h1>

        <p>You are logged in as: {{ auth()->user()->role }}</p>

        @if(auth()->check() && auth()->user()->role === 'Admin')
            <a href="{{ route('admin.approvals') }}" class="btn btn-primary">Go to Approval Page</a>
            @endif
        @if(auth()->check() && auth()->user()->role === 'Admin')
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Create Roles</a>
            @endif

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>