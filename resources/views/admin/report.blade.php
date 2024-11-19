<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Missed Activities Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-4">
        <h1 class="text-center">Missed Activities Report</h1>

        <form method="GET" action="{{ route('admin.report') }}" class="mb-4">
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

        @if ($missedActivities->isEmpty())
            <div class="alert alert-warning text-center">
                No missed activities found.
            </div>
        @else
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

</body>
</html>