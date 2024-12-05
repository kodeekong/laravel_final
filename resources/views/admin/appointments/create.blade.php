<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Appointment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Create Appointment</h2>
    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">Back to Dashboard</a>

    <form method="GET" action="{{ route('appointments.create') }}">
        <div class="form-group">
            <label for="patient_id">Patient ID</label>
            <input type="text" class="form-control" id="patient_id" name="patient_id" value="{{ old('patient_id') }}" placeholder="Enter Patient ID" required>
        </div>
        <button type="submit" class="btn btn-primary">Fetch Patient Info</button>
    </form>

    @isset($patient)
        <form method="POST" action="{{ route('appointments.store') }}">
            @csrf

            <div class="form-group">
                <label for="patient_name">Patient Name</label>
                <input type="text" id="patient_name" class="form-control" value="{{ $patient->user->first_name }} {{ $patient->user->last_name }}" readonly>
            </div>

            <div class="form-group">
                <label for="patient_id">Patient ID</label>
                <input type="text" id="patient_id" name="patient_id" class="form-control" value="{{ $patient->patient_id }}" readonly>
            </div>

            <div class="form-group">
                <label for="doctor_id">Select Doctor</label>
                <select name="doctor_id" class="form-control" required>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->first_name }} {{ $doctor->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="date">Appointment Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Schedule Appointment</button>
            </div>
        </form>
    @endisset
</div>

</body>
</html>
