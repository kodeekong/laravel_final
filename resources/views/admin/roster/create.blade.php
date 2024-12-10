<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Roster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Body Styles */
        body {
            background: linear-gradient(to right, #7a6bcb, #6b9c8e); /* Purple gradient background */
            color: #fff;
            font-family: Arial, sans-serif;
            padding-top: 20px;
        }

        /* Container for the form */
        .container {
            margin-top: 20px;
            margin-bottom: 20px;
            max-width: 1100px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Light shadow for a clean look */
        }

        /* Card styling for form sections */
        .card {
            background-color: #fff;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #5c6bc0; /* Purple color for header */
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 15px;
        }

        .card-body {
            padding: 20px;
        }

        /* Form Control (Input Fields and Select Boxes) */
        .form-control {
            height: 38px;
            border-radius: 5px;
            background-color: #fff;
            color: #333;  /* Dark text for better contrast */
            border: 1px solid #5c6bc0; /* Purple border */
        }

        .form-control:focus {
            border-color: #3f51b5; /* Slightly darker purple on focus */
            box-shadow: 0 0 5px rgba(63, 81, 181, 0.5); /* Purple shadow on focus */
        }

        /* Button Styles */
        .btn-custom {
            background-color: #5c6bc0;
            color: #fff;
            padding: 12px 20px;
            border-radius: 5px;
            text-align: center;
            width: 220px;
            text-decoration: none;
        }

        .btn-custom:hover {
            background-color: #3f51b5;
        }

        .btn-success {
            background-color: #5c6bc0;
            border-color: #5c6bc0;
            padding: 12px 20px;
            border-radius: 5px;
        }

        .btn-success:hover {
            background-color: #3f51b5;
            border-color: #3f51b5;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 12px 20px;
            border-radius: 5px;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        /* Error Message Styling */
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 5px;
        }

        /* Back to Dashboard Button */
        .btn-back {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 12px 20px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .btn-back:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        /* Additional Styling */
        .form-group {
            margin-bottom: 1.5rem;
            color:black;
        }

        h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .alert ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        .alert li {
            list-style-type: none;
        }


    </style>
</head>
<body>

<div class="container mt-5">
    <h1>Create New Roster</h1>

    <!-- Display errors if validation fails -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.rosters.store') }}">
        @csrf

        <!-- Date -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Roster Date</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="date">Select Date</label>
                    <input type="date" id="date" class="form-control" name="date" required>
                </div>
            </div>
        </div>

        <!-- Supervisor -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Supervisor</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="supervisor_id">Select Supervisor</label>
                    <select class="form-control" id="supervisor_id" name="supervisor_id" required>
                        <option value="">Select</option>
                        @foreach($supervisors as $supervisor)
                            <option value="{{ $supervisor->id }}">{{ $supervisor->first_name }} {{ $supervisor->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Doctor -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Doctor</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="doctor_id">Select Doctor</label>
                    <select class="form-control" id="doctor_id" name="doctor_id" required>
                        <option value="">Select</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->first_name }} {{ $doctor->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Caregiver 1 -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Caregiver 1</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="caregiver_1">Select Caregiver 1</label>
                    <select class="form-control" id="caregiver_1" name="caregiver_ids[]" required>
                        <option value="">Select</option>
                        @foreach($caregivers as $caregiver)
                            <option value="{{ $caregiver->id }}">{{ $caregiver->first_name }} {{ $caregiver->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Caregiver 2 -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Caregiver 2</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="caregiver_2">Select Caregiver 2</label>
                    <select class="form-control" id="caregiver_2" name="caregiver_ids[]" required>
                        <option value="">Select</option>
                        @foreach($caregivers as $caregiver)
                            <option value="{{ $caregiver->id }}">{{ $caregiver->first_name }} {{ $caregiver->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Caregiver 3 -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Caregiver 3</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="caregiver_3">Select Caregiver 3</label>
                    <select class="form-control" id="caregiver_3" name="caregiver_ids[]" required>
                        <option value="">Select</option>
                        @foreach($caregivers as $caregiver)
                            <option value="{{ $caregiver->id }}">{{ $caregiver->first_name }} {{ $caregiver->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Caregiver 4 -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Caregiver 4</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="caregiver_4">Select Caregiver 4</label>
                    <select class="form-control" id="caregiver_4" name="caregiver_ids[]" required>
                        <option value="">Select</option>
                        @foreach($caregivers as $caregiver)
                            <option value="{{ $caregiver->id }}">{{ $caregiver->first_name }} {{ $caregiver->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success mt-3">Save Roster</button>
    </form>

    <!-- Back to Dashboard Button -->
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
