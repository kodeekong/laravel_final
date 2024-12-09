<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Welcome, Dr. {{ auth()->user()->name }}</h1>

        <div class="row">
            <div class="col-md-6">
                <h3>Upcoming Appointments</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($upcomingAppointments as $appointment)
                        <tr>
                            <td>
                                {{ $appointment->patient->user->first_name ?? 'N/A' }} 
                                {{ $appointment->patient->user->last_name ?? 'N/A' }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($appointment->date)->format('Y-m-d ') }}</td>
                            <td>
                                <a href="{{ route('doctor.viewPatient', $appointment->patient->patient_id) }}" class="btn btn-info">View</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <h3>Completed Appointments</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($completedAppointments as $appointment)
                            <tr>
                                <td>{{ $appointment->patient->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->date)->format('Y-m-d H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-danger">Back to dashboard</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
