<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Appointment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* General Background and Body */
        body {
            background: linear-gradient(to right, #7a6bcb, #6b9c8e); /* Blueish purple gradient */
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: #fff;  /* White background for the report section */
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

        .btn-primary {
            background-color: #5c6bc0;
            border: none;
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #3f51b5;
        }

        .btn-success {
            background-color: #4caf50;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-success:hover {
            background-color: #388e3c;
        }

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

        .form-group select {
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .form-group select:focus {
            border-color: #5c6bc0;
            box-shadow: 0 0 8px rgba(92, 107, 192, 0.5);
        }
    </style>
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
