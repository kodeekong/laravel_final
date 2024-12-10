<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Role</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            color: #fff;
            background-color: #4caf50;
            border-radius: 5px;
        }

        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 1.1em;
            color: #333;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 15px;
            font-size: 1em;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Table Styles */
        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f4f7fc;
        }

        .btn {
            padding: 8px 12px;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
            font-size: 0.9em;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-warning {
            background-color: #ff9800;
        }

        .btn-warning:hover {
            background-color: #f57c00;
        }

        .btn-danger {
            background-color: #f44336;
        }

        .btn-danger:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Create Role</h1>

    <!-- Display success message -->
    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

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

<!-- Roles List -->
<div class="container">
    <h1>Roles List</h1>

    <!-- Table to display roles -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Role Name</th>
                <th>Access Level</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->role_name }}</td>
                    <td>{{ $role->access_level }}</td>
                    <td>
                        <!-- Edit and Delete buttons -->
                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this role?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<a href="{{ route('dashboard') }}" class="btn btn-danger">Back to Dashboard</a>

</body>
</html>
