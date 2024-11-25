<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Additional Information of Patient</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .form-group label {
            width: 150px;
            margin-right: 10px;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .note {
            font-size: 0.9em;
            color: gray;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Additional Information of Patient</h2>
        <form action="{{ route('patients.store') }}" method="POST">
            @csrf
            <!-- Patient ID -->
            <div class="form-group">
                <label for="patient_id">Patient ID</label>
                <input type="text" id="patient_id" name="patient_id" class="form-control" required>
            </div>

            <!-- Patient Name (Auto-populated and read-only) -->
            <div class="form-group">
                <label for="patient_name">Patient Name</label>
                <input type="text" id="patient_name" name="patient_name" class="form-control" readonly>
            </div>

            <!-- Group -->
            <div class="form-group">
                <label for="group">Group</label>
                <input type="text" id="group" name="group" class="form-control">
            </div>

            <!-- Admission Date -->
            <div class="form-group">
                <label for="admission_date">Admission Date</label>
                <input type="date" id="admission_date" name="admission_date" class="form-control">
            </div>

            <div class="note">
                This page is accessed by Admin and Supervisor after the registration is approved for a patient.
            </div>

            <!-- Buttons -->
            <div class="btn-container">
                <button type="submit" class="btn btn-success">Ok</button>
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
            </div>
        </form>
    </div>

    <script>
        // JavaScript to auto-fill patient name based on patient ID (for example purposes)
        document.getElementById('patient_id').addEventListener('blur', function() {
            let patientId = this.value;
            if (patientId) {
                // Mock AJAX request to fetch the patient's name (replace with actual AJAX call in production)
                document.getElementById('patient_name').value = "John Doe"; // Example name; use AJAX to fetch from DB
            }
        });
    </script>
</body>
</html>