<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Employees</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* General Background and Body */
        body {
            background: linear-gradient(to right, #7a6bcb, #6b9c8e); /* Blue-purple gradient */
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: #fff; /* White background for the report section */
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }

        h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Buttons */
        .btn-primary {
            background-color: #5c6bc0;
            border: none;
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #3f51b5;
        }

        .btn-warning {
            background-color: #ffa000;
            border: none;
            font-size: 1rem;
            padding: 5px 15px;
            border-radius: 5px;
        }

        .btn-warning:hover {
            background-color: #ff8f00;
        }

        .btn-success {
            background-color: #4caf50;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-success:hover {
            background-color: #388e3c;
        }

        .btn-secondary {
            background-color: #f1f1f1;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-secondary:hover {
            background-color: #ddd;
        }

        /* Table Styling */
        .table th, .table td {
            text-align: center;
        }

        .table-bordered th, .table-bordered td {
            border-color: #ddd;
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            background-color: #5c6bc0;
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .modal-footer {
            border-radius: 0 0 10px 10px;
        }

        /* Form and Input Styling */
        .form-group label {
            font-size: 1rem;
            font-weight: bold;
            color: #333;
        }

        .form-group .form-control {
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .form-control:focus {
            border-color: #5c6bc0;
            box-shadow: 0 0 8px rgba(92, 107, 192, 0.5);
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
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>List of Employees</h2>
    <form method="GET" action="{{ route('admin.employees') }}" class="mb-4">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ request('name') }}" placeholder="Search by Name">
            </div>
            <div class="form-group col-md-3">
                <label for="role">Role</label>
                <select id="role" name="role" class="form-control">
                    <option value="">All Roles</option>
                    <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Supervisor" {{ request('role') == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                    <option value="Employee" {{ request('role') == 'Employee' ? 'selected' : '' }}>Employee</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="salary">Salary</label>
                <input type="number" id="salary" name="salary" class="form-control" value="{{ request('salary') }}" placeholder="Search by Salary">
            </div>
            <div class="form-group col-md-1 align-self-end">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Role</th>
            <th>Salary</th>
            @if(auth()->user()->role == 'Admin')
                <th>Actions</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @forelse($employeesPaginator as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                <td>{{ $employee->role }}</td>
                <td>${{ number_format($employee->salary, 2) }}</td>
                @if(auth()->user()->role == 'Admin')
                    <td>
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#updateSalaryModal-{{ $employee->emp_id }}">
                            Update Salary
                        </button>

                        <div class="modal fade" id="updateSalaryModal-{{ $employee->emp_id }}" tabindex="-1" role="dialog" aria-labelledby="updateSalaryLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="POST" action="{{ route('admin.employees.updateSalary') }}">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateSalaryLabel">Update Salary</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="emp_id" value="{{ $employee->emp_id }}">
                                            <div class="form-group">
                                                <label for="salary">New Salary</label>
                                                <input type="number" id="salary" name="salary" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Ok</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="{{ auth()->user()->role == 'Admin' ? 5 : 4 }}" class="text-center">No employees found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">Back to Dashboard</a>

    <div class="d-flex justify-content-center">
        {{ $employeesPaginator->appends(request()->query())->links() }}
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
