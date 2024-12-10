<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Missed Activities Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* General Background and Body */
        body {
            background: linear-gradient(to right, #7a6bcb, #6b9c8e); /* Blueish purple gradient */
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: #fff;  /* White background for the report section */
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .filter-form .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .filter-form .form-control {
            border-radius: 4px;
        }

        .filter-form .btn-primary {
            background-color: #5c6bc0;
            border: none;
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .filter-form .btn-primary:hover {
            background-color: #3f51b5;
        }

        .alert-warning {
            background-color: #ffeb3b;
            color: #333;
            border-color: #f9e15c;
            font-size: 1.1rem;
            padding: 15px;
            border-radius: 5px;
            margin-top: 30px;
        }

        .table {
            width: 100%;
            margin-top: 30px;
            border-radius: 8px;
            overflow: hidden;
        }

        .table th, .table td {
            text-align: center;
            padding: 15px;
            font-size: 1rem;
        }

        .table th {
            background-color: #5c6bc0;
            color: white;
        }

        .table td {
            background-color: #f9f9f9;
            color: #333;
        }

        .btn-back {
            background-color: #5c6bc0;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 1rem;
            display: inline-block;
            margin-top: 30px;
        }

        .btn-back:hover {
            background-color: #3f51b5;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Report Title -->
        <h1>Missed Activities Report</h1>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('admin.report') }}" class="filter-form">
            <div class="form-row">
                <div class="col-md-3">
                    <label for="date" class="d-block">Filter by Date</label>
                    <input type="date" class="form-control" name="date" value="{{ request()->input('date') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary mt-2">Filter</button>
                </div>
            </div>
        </form>

        <!-- No Data Message -->
        @if ($missedActivities->isEmpty())
            <div class="alert alert-warning text-center">
                No missed activities found for the selected date.
            </div>
        @else
            <!-- Missed Activities Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Patient's Name</th>
                        <th>Doctor's Name</th>
                        <th>Doctor's Appointment</th>
                        <th>Caregiver's Name</th>
                        <th>Morning Medicine</th>
                        <th>Afternoon Medicine</th>
                        <th>Night Medicine</th>
                        <th>Breakfast</th>
                        <th>Lunch</th>
                        <th>Dinner</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($missedActivities as $activity)
                        <tr>
                            <td>{{ $activity->patient_name }}</td>
                            <td>{{ $activity->doctor_name }}</td>
                            <td>{{ $activity->appointment_date }}</td>
                            <td>{{ $activity->caregiver_name }}</td>
                            <td>{{ $activity->morning_medicine ? 'Yes' : 'No' }}</td>
                            <td>{{ $activity->afternoon_medicine ? 'Yes' : 'No' }}</td>
                            <td>{{ $activity->night_medicine ? 'Yes' : 'No' }}</td>
                            <td>{{ $activity->breakfast ? 'Yes' : 'No' }}</td>
                            <td>{{ $activity->lunch ? 'Yes' : 'No' }}</td>
                            <td>{{ $activity->dinner ? 'Yes' : 'No' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Back to Dashboard Button -->
        <a href="{{ route('dashboard') }}" class="btn btn-back">Back to Dashboard</a>
    </div>

    <!-- Bootstrap JS (optional but recommended for responsive behavior) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
