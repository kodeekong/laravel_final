<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #7a6bcb, #6b9c8e); /* Blueish purple gradient */
            color: #fff;
            font-family: Arial, sans-serif;
            padding-top: 20px;
        }

        /* Container Styling */
        .container {
            margin-top: 20px;
            max-width: 800px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        h1 {
            color: #fff;
        }

        .form-label {
            font-size: 1.1rem;
            color: #fff;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.3);
            color: #000;
            border-radius: 5px;
            font-size: 1rem;
            padding: 10px;
        }

        .form-control[readonly] {
            background-color: rgba(255, 255, 255, 0.1);
            color: #000;
        }

        /* Logout Button Styling */
        .logout-btn {
            background-color: #d9534f;
            border: none;
            color: #fff;
            padding: 10px 15px;
            font-size: 1rem;
            border-radius: 5px;
            margin-top: 20px;
            margin-left: 35rem;
            text-align: center;
            width: 25%;
            display: block;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #c9302c;
            color: #fff;
        }

    </style>
</head>
<body>

    <div class="container mt-5">
        <h1 class="mb-4">Patient Home Page</h1>
        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger logout-btn">Logout</button>
                </form>
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
                <input type="text" class="form-control" id="morningMedicine" name="morningMedicine" value="{{ $morningMedicine }}" readonly>
            </div>
            <div class="mb-3">
                <label for="afternoonMedicine" class="form-label">Afternoon Medicine</label>
                <input type="text" class="form-control" id="afternoonMedicine" name="afternoonMedicine" value="{{ $afternoonMedicine }}" readonly>
            </div>
            <div class="mb-3">
                <label for="nightMedicine" class="form-label">Night Medicine</label>
                <input type="text" class="form-control" id="nightMedicine" name="nightMedicine" value="{{ $nightMedicine }}" readonly>
            </div>
            <div class="mb-3">
                <label for="breakfast" class="form-label">Breakfast</label>
                <input type="text" class="form-control" id="breakfast" name="breakfast" value="{{ $breakfast }}" readonly>
            </div>
            <div class="mb-3">
                <label for="lunch" class="form-label">Lunch</label>
                <input type="text" class="form-control" id="lunch" name="lunch" value="{{ $lunch }}" readonly>
            </div>
            <div class="mb-3">
                <label for="dinner" class="form-label">Dinner</label>
                <input type="text" class="form-control" id="dinner" name="dinner" value="{{ $dinner }}" readonly>
            </div>
        </form>

        
    </div>

</body>
</html>
