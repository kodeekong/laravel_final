<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Patient: {{ $patient->name }}</h1>

        <h3>Prescriptions</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Morning Medication</th>
                    <th>Afternoon Medication</th>
                    <th>Night Medication</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prescriptions as $prescription)
                    <tr>
                        <td>{{ $prescription->morning_med }}</td>
                        <td>{{ $prescription->afternoon_med }}</td>
                        <td>{{ $prescription->night_med }}</td>
                        <td>{{ $prescription->comment }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Add New Prescription</h3>
        <form action="{{ route('prescriptions.store', $patient->patient_id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="morning_med" class="form-label">Morning Medication</label>
                <input type="text" name="morning_med" class="form-control" id="morning_med">
            </div>

            <div class="mb-3">
                <label for="afternoon_med" class="form-label">Afternoon Medication</label>
                <input type="text" name="afternoon_med" class="form-control" id="afternoon_med">
            </div>

            <div class="mb-3">
                <label for="night_med" class="form-label">Night Medication</label>
                <input type="text" name="night_med" class="form-control" id="night_med">
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea name="comment" class="form-control" id="comment" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Prescription</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
