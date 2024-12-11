<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Management System</title>
    <!-- Link to Bootstrap CSS for Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #7a6bcb, #6b9c8e); /* Blueish purple gradient */
            color: #fff;
            font-family: Arial, sans-serif;
            padding-top: 20px;
        }

        /* Header for the title */
        .title {
            font-size: 2rem;
            font-weight: bold;
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Container for the entire page */
        .container {
            margin-top: 20px;
            margin-bottom: 20px;
            max-width: 1100px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        /* Nav box styling */
        .navbar-box {
            background-color: white; /* White background for the box */
            border-radius: 10px;
            padding: 20px;
            position: relative;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        /* Nav Links Styling */
        .nav-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 15px;
            margin-bottom: 20px;
            width: 100%; /* Ensure full width for nav links */
        }

        .nav-links a {
            font-size: 1rem;
            color: #fff;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            background-color: #5c6bc0;
            text-align: center;
            width: 220px;
        }

        .nav-links a:hover {
            background-color: #3f51b5;
            color: #fff;
        }

        /* Welcome and Logout section (Positioned at the Bottom Right) */
        .user-info {
            text-align: right;
            width: 100%;
            margin-top: 10px; /* Add space between nav links and user info */
        }

        .user-info span {
            display: block;
            margin-bottom: 5px;
            font-size: 1rem;
            font-weight: bold;
        }

        .logout-btn {
            background-color: #d9534f;
            border: none;
            color: #fff;
            padding: 1.5px 11px;
            font-size: 0.9rem;
            margin: 10px 0;
            width: auto;
        }

        .logout-btn:hover {
            background-color: #c9302c;
        }

        /* Styling for the Welcome and Role text */
        .user-info h5, .user-info h2 {
            margin: 0;
            padding: 0;
            color: black;
        }

        .user-info h2 {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .user-info h5 {
            font-size: 1rem;
            color: black;
        }

    </style>
</head>
<body>

    <!-- Main Content -->
    <div class="container">
        <!-- Home Management System Title -->
        <div class="title">
            <h2>GRANDO HILLS</h2>
        </div>

        <!-- Navbar Box for Nav Links and User Info -->
        <div class="navbar-box">
            <!-- Nav Links Container -->
            <div class="nav-links">
                @if(auth()->check() && (auth()->user()->role === 'Admin' || auth()->user()->role === 'Supervisor'))
                    <a href="{{ route('admin.approvals') }}" class="btn btn-custom">Go to Approval Page</a>
                    <!-- <a href="{{ route('admin.report') }}" class="btn btn-custom">Missed Activities Report</a> -->
                    <a href="{{ route('appointments.create') }}" class="btn btn-custom">Create Appointment</a>
                    <a href="{{ route('admin.employees') }}" class="btn btn-custom">Employee Salaries</a>
                    <a href="{{ route('admin.additional_info', ['patient_id' => 1]) }}" class="btn btn-custom">Patient Information</a>
                @endif

                @if(auth()->check() && auth()->user()->role === 'Admin')
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-custom">Create Roles</a>
                @endif

                @if(auth()->check() && auth()->user()->role === 'Doctor')
                    <a href="{{ route('doctor.home') }}" class="btn btn-custom">Check Appointments</a>
                @endif

                @if(auth()->check() && (auth()->user()->role === 'Admin' || auth()->user()->role === 'Supervisor'))
                    <a href="{{ route('rosters.index') }}" class="btn btn-custom">View Roster List</a>
                    <a href="{{ route('admin.rosters.create') }}" class="btn btn-custom">Create New Roster</a>
                @endif

                @if(auth()->check() && (auth()->user()->role === 'Admin' || auth()->user()->role === 'Supervisor' || auth()->user()->role === 'Doctor' || auth()->user()->role === 'Caregiver'))
                    <a href="{{ route('admin.patients.index') }}" class="btn btn-custom">List of Patients</a>
                @endif
            </div>

            <!-- Welcome and Logout Section -->
            <div class="user-info">
                <!-- Welcome message and user role -->
                <h2>Welcome, {{ auth()->user()->first_name }}!</h2>
                <h5>You are {{ auth()->user()->role }}</h5>

                <!-- Logout Form -->
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
