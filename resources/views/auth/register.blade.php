<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .form-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        .form-buttons button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .form-buttons .ok-button {
            background-color: #4CAF50;
            color: #fff;
        }
        .form-buttons .cancel-button {
            background-color: #f44336;
            color: #fff;
        }
        .form-buttons a {
            text-decoration: none;
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            border-radius: 4px;
            font-size: 14px;
            text-align: center;
        }
        .patient-info {
            display: none;
            margin-top: 20px;
        }
        .patient-info h3 {
            margin-bottom: 10px;
            font-size: 16px;
        }
    </style>
    <script>
        function togglePatientInfo() {
            const roleSelect = document.getElementById('role');
            const patientInfoSection = document.getElementById('patient-info');
            patientInfoSection.style.display = roleSelect.value === 'Patient' ? 'block' : 'none';
        }
    </script>
</head>
<body>
<div class="form-container">
    <h2>Register</h2>
    <form action="/register" method="POST" onsubmit="return validateForm()">
        @csrf
        <div class="form-group">
            <label for="role">Role:</label>
            <select id="role" name="role" onchange="togglePatientInfo()" required>
                <option value="">Select Role</option>
                <option value="Patient">Patient</option>
                <option value="Family Member">Family Member</option>
                <option value="Admin">Admin</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Doctor">Doctor</option>
                <option value="Caregiver">Caregiver</option>

            </select>
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required>
        </div>

        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
        </div>

        <div class="form-group">
            <label for="email">Email ID:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div id="patient-info" class="patient-info">
            <h3>Additional Information for Patient</h3>
            <div class="form-group">
                <label for="family_code">Family Code (For Patient Family Member):</label>
                <input type="text" id="family_code" name="family_code">
            </div>

            <div class="form-group">
                <label for="relation">Emergency Contact Name:</label>
                <input type="text" id="relation_to_emergency" name="relation_to_emergency">
            </div>

            <div class="form-group">
                <label for="emergency_contact">Emergency Contact Number:</label>
                <input type="tel" id="emergency_contact" name="emergency_contact">
            </div>
        </div>

        <div class="form-buttons">
            <button type="submit" class="ok-button">Register</button>
            <a href="/login">Or Login</a>
        </div>
    </form>
</div>
</body>
</html>


<!--    FOR ADMIN
            <div class="form-group">
                <label for="group">Group:</label>
                <input type="text" id="group" name="group">
            </div>
            <div class="form-group">
                <label for="patient_id">Patient ID:</label>
                <input type="text" id="patient_id" name="patient_id">
            </div>
            <div class="form-group">
                <label for="admission_date">Admission Date:</label>
                <input type="date" id="admission_date" name="admission_date">
            </div>
        </div>
-->
