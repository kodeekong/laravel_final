@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employees</h1>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search Form -->
    <form method="GET" action="{{ route('employees.index') }}">
        <div class="mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search by Name, Role, or Employee ID" value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Employees Table -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr>
                    <td>{{ $employee->employee_id }}</td>
                    <td>{{ $employee->user->first_name }} {{ $employee->user->last_name }}</td>
                    <td>{{ $employee->role }}</td>
                    <td>${{ number_format($employee->salary, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No employees found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Update Salary Form -->
    <h3>Update Salary</h3>
    <form method="POST" action="{{ route('employees.update-salary') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label for="emp_id" class="form-label">Employee ID</label>
                <input type="text" name="emp_id" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="new_salary" class="form-label">New Salary</label>
                <input type="number" name="new_salary" class="form-control" step="0.01" required>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update Salary</button>
    </form>
</div>
@endsection
