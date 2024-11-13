<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Missed Activities Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <!-- Navigation Bar (Optional, can be customized) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center">Missed Activities Report</h1>

        <!-- Date Filter Form -->
        <form method="GET" action="{{ route('admin.report.index') }}" class="mb-4">
            <div class="form-row">
                <div class="col-md-3">
                    <label for="date">Filter by Date</label>
                    <input type="date" class="form-control" name="date" value="{{ request()->input('date') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary mt-4">Filter</button>
                </div>
            </div>
        </form>

        <!-- Check if there are any missed activities -->
        @if ($missedActivities->isEmpty())
            <div class="alert alert-warning text-center">
                No missed activities found.
            </div>
        @else
            <!-- Table to display missed activities -->
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
                            <td>{{ $activity->morning_medicine }}</td>
                            <td>{{ $activity->afternoon_medicine }}</td>
                            <td>{{ $activity->night_medicine }}</td>
                            <td>{{ $activity->breakfast }}</td>
                            <td>{{ $activity->lunch }}</td>
                            <td>{{ $activity->dinner }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Optional: Add JavaScript or Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
