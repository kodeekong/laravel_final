<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Patient Home Page</h1>
        <form action="#" method="POST">
            @csrf
            <div class="mb-3">
                <label for="patientId" class="form-label">Patient ID</label>
                <input type="text" class="form-control" id="patientId" value="{{ $patientId }}" readonly>
            </div>
            <div class="mb-3">
                <label for="patientName" class="form-label">Patient Name</label>
                <input type="text" class="form-control" id="patientName" value="{{ $patientName }}" readonly>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $date }}">
            </div>
            <div class="mb-3">
                <label for="doctorName" class="form-label">Doctor's Name</label>
                <input type="text" class="form-control" id="doctorName" value="{{ $doctorName }}" readonly>
            </div>
            <div class="mb-3">
                <label for="doctorAppointment" class="form-label">Doctor's Appointment</label>
                <input type="text" class="form-control" id="doctorAppointment" value="{{ $doctorAppointment }}" readonly>
            </div>
            <div class="mb-3">
                <label for="caregiverName" class="form-label">Caregiver's Name</label>
                <input type="text" class="form-control" id="caregiverName" value="{{ $caregiverName }}" readonly>
            </div>
            <div class="mb-3">
                <label for="morningMedicine" class="form-label">Morning Medicine</label>
                <input type="text" class="form-control" id="morningMedicine" name="morningMedicine" value="{{ $morningMedicine }}">
            </div>
            <div class="mb-3">
                <label for="afternoonMedicine" class="form-label">Afternoon Medicine</label>
                <input type="text" class="form-control" id="afternoonMedicine" name="afternoonMedicine" value="{{ $afternoonMedicine }}">
            </div>
            <div class="mb-3">
                <label for="nightMedicine" class="form-label">Night Medicine</label>
                <input type="text" class="form-control" id="nightMedicine" name="nightMedicine" value="{{ $nightMedicine }}">
            </div>
            <div class="mb-3">
                <label for="breakfast" class="form-label">Breakfast</label>
                <input type="text" class="form-control" id="breakfast" name="breakfast" value="{{ $breakfast }}">
            </div>
            <div class="mb-3">
                <label for="lunch" class="form-label">Lunch</label>
                <input type="text" class="form-control" id="lunch" name="lunch" value="{{ $lunch }}">
            </div>
            <div class="mb-3">
                <label for="dinner" class="form-label">Dinner</label>
                <input type="text" class="form-control" id="dinner" name="dinner" value="{{ $dinner }}">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</body>
</html>
