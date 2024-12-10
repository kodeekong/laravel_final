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
            background: linear-gradient(to right, #7a6bcb, #6b9c8e); /* Blue-purple gradient */
            margin: 0;
            padding: 0;
            color: #fff;
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
            background-color: #5c6bc0; /* Primary button color */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #3f51b5; /* Darker shade for hover */
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
            color: #333; /* Ensure the header text is dark for readability */
        }

        table td {
            color: #333; /* Ensure the ID text is black and readable */
        }

        .btn {
            padding: 8px 12px;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
            font-size: 0.9em;
        }

        .btn-primary {
            background-color: #5c6bc0; /* Primary button */
        }

        .btn-primary:hover {
            background-color: #3f51b5;
        }

        .btn-warning {
            background-color: #ffa000; /* Warning button */
        }

        .btn-warning:hover {
            background-color: #ff8f00;
        }

        .btn-danger {
            background-color: #f44336; /* Danger button */
        }

        .btn-danger:hover {
            background-color: #d32f2f;
        }

        /* Pagination Styling */
        .pagination .page-link {
            background-color: #5c6bc0;
            border: 1px solid #5c6bc0;
            color: white;
        }

        .pagination .page-link:hover {
            background-color: #3f51b5;
            border-color: #3f51b5;
        }

        .pagination .active .page-link {
            background-color: #3f51b5;
            border-color: #3f51b5;
        }

        /* Adjust Button Placement */
        .btn-back {
            background-color: #007bff;
            margin-bottom: 20px; /* Add some space at the top */
            display: inline-block;
            text-align: center;
            width: 200px; /* Fixed width for alignment */
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Moved the Back to Dashboard button to the top -->
    <a href="{{ route('dashboard') }}" class="btn btn-back">Back to Dashboard</a>

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

</body>
</html>
