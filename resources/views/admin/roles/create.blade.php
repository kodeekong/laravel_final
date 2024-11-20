<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Role</title>
    <style>
        /* Your custom styles */
    </style>
</head>
<body>

<div class="container">
    <h1>Create Role</h1>

    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">Back to Dashboard</a><br>

    <form method="POST" action="{{ route('admin.roles.store') }}">
        @csrf
        <div>
            <label for="role_name">Role Name:</label>
            <input type="text" id="role_name" name="role_name" value="{{ old('role_name') }}" required>
            @error('role_name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="access_level">Access Level:</label>
            <input type="text" id="access_level" name="access_level" value="{{ old('access_level') }}" required>
            @error('access_level')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Create Role</button>
    </form>
</div>

</body>
</html>
