<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Missed Activities Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .back-to-dashboard {
            margin-top: 30px;
        }
        .filter-form {
            margin-bottom: 30px;
        }
        .form-row .col-md-3 {
            margin-bottom: 15px;
        }
        .table th, .table td {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <!-- Report Title -->
        <h1 class="text-center mb-4">Missed Activities Report</h1>

        <!-- Filter Form (aligned with space between input and button) -->
        <form method="GET" action="{{ route('admin.report') }}" class="filter-form">
            <div class="form-row align-items-end">
                <div class="col-md-3">
                    <label for="date">Filter by Date</label>
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

        <!-- Back to Dashboard Button (More user-friendly spot) -->
        <a href="{{ route('dashboard') }}" class="btn btn-primary back-to-dashboard">Back to Dashboard</a>
    </div>

    <!-- Bootstrap JS (optional but recommended for responsive behavior) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
