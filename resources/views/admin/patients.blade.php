<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Patients</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>List of Patients</h2>

    <form method="GET" action="{{ route('admin.patients.index') }}" class="mb-4">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ request('name') }}" placeholder="Search by Name">
            </div>
            <div class="form-group col-md-2">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" class="form-control" value="{{ request('age') }}" placeholder="Search by Age">
            </div>
            <div class="form-group col-md-3">
                <label for="emergency_contact">Emergency Contact</label>
                <input type="text" id="emergency_contact" name="emergency_contact" class="form-control" value="{{ request('emergency_contact') }}" placeholder="Search by Emergency Contact">
            </div>
            <div class="form-group col-md-3">
                <label for="admission_date">Admission Date</label>
                <input type="date" id="admission_date" name="admission_date" class="form-control" value="{{ request('admission_date') }}">
            </div>
            <div class="form-group col-md-1 align-self-end">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Emergency Contact</th>
                <th>Relation to Emergency</th>
                <th>Admission Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($patients as $patient)
                <tr>
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->emergency_contact }}</td>
                    <td>{{ $patient->relation_to_emergency }}</td>
                    <td>{{ $patient->admission_date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No patients found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('dashboard') }}" class="btn btn-danger">Back to dashboard</a>


    <div class="d-flex justify-content-center">
        {{ $patients->links() }}
    </div>
</div>
</body>
</html>
