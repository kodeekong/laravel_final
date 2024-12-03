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

    <!-- Success or Error Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Back to Dashboard Button -->
    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">Back to Dashboard</a>

    <!-- Form to search and fetch patient by Patient ID -->
    <form method="GET" action="{{ route('appointments.create') }}">
        @csrf
        <div class="form-group">
            <label for="patient_id">Patient ID</label>
            <input type="text" class="form-control" id="patient_id" name="patient_id" value="{{ old('patient_id') }}" placeholder="Enter Patient ID" required>
        </div>
        <button type="submit" class="btn btn-primary">Fetch Patient Info</button>
    </form>

    <!-- If patient data is found, show the appointment form -->
    @isset($patient)
        <form method="POST" action="{{ route('appointments.store') }}">
            @csrf

            <!-- Patient Information (readonly) -->
            <div class="form-group">
                <label for="patient_name">Patient Name</label>
                <input type="text" id="patient_name" class="form-control" value="{{ $patient->user->first_name }} {{ $patient->user->last_name }}" readonly>
            </div>

            <div class="form-group">
                <label for="patient_id">Patient ID</label>
                <input type="text" id="patient_id" class="form-control" value="{{ $patient->patient_id }}" readonly>
            </div>

            <!-- Doctor Selection -->
            <div class="form-group">
                <label for="doctor_id">Select Doctor</label>
                <select name="doctor_id" class="form-control" required>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->first_name }} {{ $doctor->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Appointment Date -->
            <div class="form-group">
                <label for="appointment_date">Appointment Date</label>
                <input type="date" name="appointment_date" class="form-control" required>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-success">Schedule Appointment</button>
            </div>
        </form>
    @endisset
</div>

</body>
</html>
