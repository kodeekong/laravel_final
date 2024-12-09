<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">

        <h1>Welcome to your Dashboard, {{ auth()->user()->first_name }}!</h1>

        <h3>You are logged in as: {{ auth()->user()->role }}</h3>

        @if(auth()->check() && (auth()->user()->role === 'Admin' || auth()->user()->role === 'Supervisor'))
            <div class="mb-4">
            <a href="{{ route('admin.approvals') }}" class="btn btn-primary">Go to Approval Page</a>
            <a href="{{ route('admin.report') }}" class="btn btn-secondary">Missed Activities Report</a>
            <a href="{{ route('appointments.create') }}" class="btn btn-info">Create Appointment</a>
            <a href="{{ route('admin.employees') }}" class="btn btn-primary">Employee salaries</a>
            <a href="{{ route('admin.additional_info', ['patient_id' => 1]) }}" class="btn btn-info">Patient Information</a>
            @endif
        @if(auth()->check() && auth()->user()->role === 'Admin')
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Create Roles</a>
            @endif
        @if(auth()->check() && auth()->user()->role === 'Doctor')
            <a href="{{ route('doctor.home') }}" class="btn btn-primary">Check Appointents</a>
        @endif
        @if(auth()->check() && (auth()->user()->role === 'Admin' || auth()->user()->role === 'Supervisor' || auth()->user()->role === 'Doctor' || auth()->user()->role === 'Caregiver'))
            <a href="{{ route('admin.patients.index') }}" class="btn btn-info">List of patients</a>
            @endif
            </div>
        <!-- For Admin and Supervisor only -->
        @if(auth()->check() && (auth()->user()->role === 'Admin' || auth()->user()->role === 'Supervisor'))
            <div class="mb-4">
                <a href="{{ route('rosters.index') }}" class="btn btn-primary">View Roster List</a>
                <!-- Roster Management link (visible to Admin and Supervisor) -->
                <a href="{{ route('admin.rosters.create') }}" class="btn btn-info">Create New Roster</a>
                </div>
        @endif
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
