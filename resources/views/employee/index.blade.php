@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employee</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('employees.index') }}">
        <div class="form-group">
            <label for="search_id">Emp ID:</label>
            <input type="text" name="search_id" id="search_id" class="form-control" value="{{ request('search_id') }}">
        </div>
        <div class="form-group">
            <label for="search_name">Name:</label>
            <input type="text" name="search_name" id="search_name" class="form-control" value="{{ request('search_name') }}">
        </div>
        <div class="form-group">
            <label for="search_role">Role:</label>
            <input type="text" name="search_role" id="search_role" class="form-control" value="{{ request('search_role') }}">
        </div>
        <div class="form-group">
            <label for="search_salary">Salary:</label>
            <input type="text" name="search_salary" id="search_salary" class="form-control" value="{{ request('search_salary') }}">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Employee Table -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->emp_id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->role }}</td>
                    <td>{{ $employee->salary }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Update Salary Form -->
    <form method="POST" action="{{ route('employees.updateSalary') }}">
        @csrf
        <div class="form-group">
            <label for="emp_id">Emp ID:</label>
            <input type="text" name="emp_id" id="emp_id" class="form-control">
        </div>
        <div class="form-group">
            <label for="new_salary">New Salary:</label>
            <input type="text" name="new_salary" id="new_salary" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">OK</button>
        <button type="reset" class="btn btn-danger">Cancel</button>
    </form>
</div>
@endsection
