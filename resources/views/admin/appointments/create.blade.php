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
    <h2>Appointments for {{ $patient->patient_id ?? 'N/A' }}</h2>

    <!-- Success or Error Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">Back to Dashboard</a>

    <!-- Patient ID Input for fetching Patient Data -->
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

            <!-- Patient Name (non-editable) -->
            <div class="form-group">
                <label for="patient_name">Patient Name</label>
                <input type="text" id="patient_name" class="form-control" value="{{ $patient->user->first_name }} {{ $patient->user->last_name }}" readonly>
            </div>

            <!-- Patient ID (readonly) -->
            <div class="form-group">
                <label for="patient_id">Patient ID</label>
                <input type="text" id="patient_id" class="form-control" value="{{ $patient->patient_id }}" readonly>
            </div>

            <!-- Select Doctor -->
            <div class="form-group">
                <label for="doctor_id">Doctor</label>
                <select id="doctor_id" class="form-control" name="doctor_id" required>
                    <option value="">Select Doctor</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->first_name }} {{ $doctor->last_name }}</option>
                    @endforeach
                </select>
                @error('doctor_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Appointment Date -->
            <div class="form-group">
                <label for="appointment_date">Appointment Date</label>
                <input type="date" id="appointment_date" class="form-control" name="appointment_date" value="{{ old('appointment_date') }}" required>
                @error('appointment_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Schedule Appointment</button>
                <a href="{{ route('dashboard') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    @endisset
</div>

</body>
</html>
