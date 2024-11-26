<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Additional Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Additional Information for Patient: {{ $patient->patient_id ?? 'N/A' }}</h2>
    
    <!-- Success or Error Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Patient ID Input -->
    <form method="GET" action="{{ route('admin.additional_info') }}">
        @csrf
        <div class="form-group">
            <label for="patient_id">Patient ID</label>
            <input type="text" class="form-control" id="patient_id" name="patient_id" value="{{ old('patient_id', $patient->patient_id ?? '') }}" placeholder="Enter Patient ID" required>
        </div>
        <button type="submit" class="btn btn-primary">Fetch Patient Info</button>
    </form>

    <!-- If patient data is found, show the update form -->
    @isset($patient)
        <form method="POST" action="{{ url('admin/'.$patient->patient_id.'/additional_info') }}">
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

            <!-- Admission Date -->
            <div class="form-group">
                <label for="admission_date">Admission Date</label>
                <input type="date" id="admission_date" class="form-control" name="admission_date" value="{{ old('admission_date', $patient->admission_date) }}">
            </div>

            <!-- Group -->
            <div class="form-group">
                <label for="group">Group</label>
                <input type="text" id="group" class="form-control" name="group" value="{{ old('group', $patient->group) }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('dashboard') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    @endisset
</div>

</body>
</html>
