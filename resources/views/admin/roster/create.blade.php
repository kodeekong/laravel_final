<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Roster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ensure all form inputs have the same size */
        .form-control {
            height: 38px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1>Create New Roster</h1>

    <!-- Display errors if validation fails -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.rosters.store') }}">
        @csrf

        <!-- Date -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Roster Date</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="date">Select Date</label>
                    <input type="date" id="date" class="form-control" name="date" required>
                </div>
            </div>
        </div>

        <!-- Supervisor -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Supervisor</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="supervisor_id">Select Supervisor</label>
                    <select class="form-control" id="supervisor_id" name="supervisor_id" required>
                        <option value="">Select</option> <!-- None option -->
                        @foreach($supervisors as $supervisor)
                            <option value="{{ $supervisor->id }}">{{ $supervisor->first_name }} {{ $supervisor->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Doctor -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Doctor</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="doctor_id">Select Doctor</label>
                    <select class="form-control" id="doctor_id" name="doctor_id" required>
                        <option value="">Select</option> <!-- None option -->
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->first_name }} {{ $doctor->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Caregiver 1 -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Caregiver 1</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="caregiver_1">Select Caregiver 1</label>
                    <select class="form-control" id="caregiver_1" name="caregiver_ids[]" required>
                        <option value="">Select</option> <!-- None option -->
                        @foreach($caregivers as $caregiver)
                            <option value="{{ $caregiver->id }}">{{ $caregiver->first_name }} {{ $caregiver->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Caregiver 2 -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Caregiver 2</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="caregiver_2">Select Caregiver 2</label>
                    <select class="form-control" id="caregiver_2" name="caregiver_ids[]" required>
                        <option value="">Select</option> <!-- None option -->
                        @foreach($caregivers as $caregiver)
                            <option value="{{ $caregiver->id }}">{{ $caregiver->first_name }} {{ $caregiver->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Caregiver 3 -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Caregiver 3</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="caregiver_3">Select Caregiver 3</label>
                    <select class="form-control" id="caregiver_3" name="caregiver_ids[]" required>
                        <option value="">Select</option> <!-- None option -->
                        @foreach($caregivers as $caregiver)
                            <option value="{{ $caregiver->id }}">{{ $caregiver->first_name }} {{ $caregiver->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Caregiver 4 -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Caregiver 4</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="caregiver_4">Select Caregiver 4</label>
                    <select class="form-control" id="caregiver_4" name="caregiver_ids[]" required>
                        <option value="">Select</option> <!-- None option -->
                        @foreach($caregivers as $caregiver)
                            <option value="{{ $caregiver->id }}">{{ $caregiver->first_name }} {{ $caregiver->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Save Roster</button>
    </form>

    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
