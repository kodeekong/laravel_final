<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Patients</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Body Styles */
        body {
            background: linear-gradient(to right, #7a6bcb, #6b9c8e); /* Purple gradient background */
            color: #fff;
            font-family: Arial, sans-serif;
            padding-top: 20px;
        }

        /* Container Styles */
        .container {
            margin-top: 20px;
            margin-bottom: 20px;
            max-width: 1100px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Form Controls (Input fields) */
        .form-control {
            height: 38px;
            border-radius: 5px;
            background-color: #fff;
            color: #333;
            border: 1px solid #5c6bc0; /* Purple border */
        }

        .form-control:focus {
            border-color: #3f51b5; /* Darker purple on focus */
            box-shadow: 0 0 5px rgba(63, 81, 181, 0.5);
        }

        /* Button Styles */
        .btn-primary {
            background-color: #5c6bc0;
            border-color: #5c6bc0;
            padding: 12px 20px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #3f51b5;
            border-color: #3f51b5;
        }

        .btn-danger {
            background-color: #e74c3c;
            border-color: #e74c3c;
            padding: 12px 20px;
            border-radius: 5px;
        }

        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            text-align: center;
            padding: 10px;
        }

        table th {
            background-color: #5c6bc0;
            color: #fff;
        }

        table td {
            background-color: #f9f9f9;
            color: #333;
        }

        /* Pagination styles */
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .form-group {
            color:black;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>List of Patients</h2>

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.patients.index') }}" class="mb-4">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ request('name') }}" placeholder="Search by Name">
            </div>
            <div class="form-group col-md-2">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" class="form-control" value="{{ request('age') }}" placeholder="Search by Age">
            </div>
            <div class="form-group col-md-3">
                <label for="emergency_contact">Emergency Contact</label>
                <input type="text" id="emergency_contact" name="emergency_contact" class="form-control" value="{{ request('emergency_contact') }}" placeholder="Search by Emergency Contact">
            </div>
            <div class="form-group col-md-3">
                <label for="admission_date">Admission Date</label>
                <input type="date" id="admission_date" name="admission_date" class="form-control" value="{{ request('admission_date') }}">
            </div>
            <div class="form-group col-md-1 align-self-end">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <!-- Patients Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Emergency Contact</th>
                <th>Relation to Emergency</th>
                <th>Admission Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($patients as $patient)
                <tr>
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->emergency_contact }}</td>
                    <td>{{ $patient->relation_to_emergency }}</td>
                    <td>{{ $patient->admission_date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No patients found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Back to Dashboard Button -->
    <a href="{{ route('dashboard') }}" class="btn btn-danger">Back to Dashboard</a>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $patients->links() }}
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
