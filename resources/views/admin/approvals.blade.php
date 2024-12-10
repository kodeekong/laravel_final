<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Approvals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #7a6bcb, #6b9c8e); /* Blueish purple gradient */
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add shadow for depth */
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333; /* Dark color for text */
            text-align: center;
            margin-bottom: 30px;
        }

        .alert {
            font-size: 1.2rem;
            color: #333;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #5c6bc0; /* Blue */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1.1rem;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            background-color: #3f51b5;
        }

        .table {
            margin-top: 30px;
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
        }

        .table th, .table td {
            text-align: center;
            padding: 15px;
            font-size: 1.1rem;
        }

        .table th {
            background-color: #5c6bc0;
            color: white;
        }

        .table td {
            background-color: #f9f9f9;
            color: #333;
        }

        .btn-success, .btn-danger {
            font-size: 1rem;
            padding: 8px 15px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .btn-success {
            background-color: #4CAF50;
            color: white;
        }

        .btn-success:hover {
            background-color: #45a049;
        }

        .btn-danger {
            background-color: #f44336;
            color: white;
        }

        .btn-danger:hover {
            background-color: #e53935;
        }

        .form-buttons form {
            display: inline-block;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Approval Page</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">Back to Dashboard</a>

        <table class="table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingUsers as $user)
                    <tr>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td class="form-buttons">
                            <form action="{{ route('admin.approvals.approve', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                            <form action="{{ route('admin.approvals.reject', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No pending registrations.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
