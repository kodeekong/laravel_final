<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Additional Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General Background and Body */
        body {
            background: linear-gradient(to right, #7a6bcb, #6b9c8e); /* Blue-purple gradient */
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: #fff; /* White background for the report section */
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }

        h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Buttons */
        .btn-primary {
            background-color: #5c6bc0;
            border: none;
            font-size: 1rem;
            padding: 8px 15px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #3f51b5;
        }

        .btn-success {
            background-color: #4caf50;
            border: none;
            padding: 8px 15px;
            font-size: 1rem;
            border-radius: 5px;
        }

        .btn-success:hover {
            background-color: #388e3c;
        }

        .btn-danger {
            background-color: #d9534f;
            border: none;
            padding: 8px 15px;
            font-size: 1rem;
            border-radius: 5px;
        }

        .btn-danger:hover {
            background-color: #c9302c;
        }

        /* Spacing adjustments for buttons */
        .btn {
            margin-bottom: 10px; /* Added vertical margin between buttons */
        }

        /* Form and Input Styling */
        .form-group label {
            font-size: 1rem;
            font-weight: bold;
            color: #333;
        }

        .form-group .form-control {
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .form-control:focus {
            border-color: #5c6bc0;
            box-shadow: 0 0 8px rgba(92, 107, 192, 0.5);
        }

        /* Error Message Styling */
        .text-danger {
            color: #f44336;
            font-size: 0.9rem;
        }

    </style>
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

    <!-- Back to Dashboard Button -->
    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">Back to Dashboard</a>

    <!-- Patient ID Input for fetching Patient Data -->
    <form method="GET" action="{{ route('admin.additional_info') }}">
        @csrf
        <div class="form-group">
            <label for="patient_id">Patient ID</label>
            <input type="text" class="form-control" id="patient_id" name="patient_id" value="{{ old('patient_id') }}" placeholder="Enter Patient ID" required>
        </div>
        <button type="submit" class="btn btn-primary">Fetch Patient Info</button>
    </form>

    <!-- If patient data is found, show the update form -->
    @isset($patient)
        <form method="POST" action="{{ url('admin/'.$patient->patient_id.'/additional-info') }}">
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
                <input type="date" id="admission_date" class="form-control" name="admission_date" value="{{ old('admission_date', $patient->admission_date) }}" required>
                @error('admission_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Group -->
            <div class="form-group">
                <label for="group">Group</label>
                <input type="text" id="group" class="form-control" name="group" value="{{ old('group', $patient->group) }}">
                @error('group')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Save and Cancel Buttons -->
            <div class="form-group">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('dashboard') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    @endisset
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
