<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rosters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom style to make the date input box more compact */
        .date-filter-input {
            max-width: 200px; /* Adjusted max width for compactness */
        }
        /* Style to move the "Back to Dashboard" button */
        .back-to-dashboard {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-5 position-relative">

    <!-- Back to Dashboard Button -->
    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3 back-to-dashboard">Back to Dashboard</a>

    <h1>Rosters</h1>

    <!-- Date Filter -->
    <div class="row mb-4">
        <div class="col-md-4">
            <form method="GET" action="{{ route('rosters.index') }}">
                <div class="input-group">
                    <input type="date" class="form-control date-filter-input" name="filter_date" value="{{ request('filter_date') }}">
                    <button type="submit" class="btn btn-outline-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Roster Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Supervisor</th>
                <th>Doctor</th>
                <th>Caregiver 1</th>
                <th>Caregiver 2</th>
                <th>Caregiver 3</th>
                <th>Caregiver 4</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rosters as $roster)
                <tr>
                    <td>{{ $roster->date }}</td>
                    <td>{{ $roster->supervisor->last_name }}, {{ $roster->supervisor->first_name }}</td>
                    <td>{{ $roster->doctor->last_name }}, {{ $roster->doctor->first_name }}</td>
                    <td>
                        @if(isset($roster->caregivers[0]))
                            {{ $roster->caregivers[0]->last_name }}, {{ $roster->caregivers[0]->first_name }}<br>
                            <small>{{ $roster->caregivers[0]->patient_group }}</small>
                        @endif
                    </td>
                    <td>
                        @if(isset($roster->caregivers[1]))
                            {{ $roster->caregivers[1]->last_name }}, {{ $roster->caregivers[1]->first_name }}<br>
                            <small>{{ $roster->caregivers[1]->patient_group }}</small>
                        @endif
                    </td>
                    <td>
                        @if(isset($roster->caregivers[2]))
                            {{ $roster->caregivers[2]->last_name }}, {{ $roster->caregivers[2]->first_name }}<br>
                            <small>{{ $roster->caregivers[2]->patient_group }}</small>
                        @endif
                    </td>
                    <td>
                        @if(isset($roster->caregivers[3]))
                            {{ $roster->caregivers[3]->last_name }}, {{ $roster->caregivers[3]->first_name }}<br>
                            <small>{{ $roster->caregivers[3]->patient_group }}</small>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
