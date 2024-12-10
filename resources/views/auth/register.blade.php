<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Link to Bootstrap CSS for Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #7a6bcb, #6b9c8e); /* Blueish purple gradient */
            color: #fff;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            padding: 20px;  /* Added padding to create space around the entire body */
        }

        /* Main form container */
        .form-container {
            background-color: #fff;  /* Solid white background for the form */
            padding: 30px;
            border-radius: 10px;
            max-width: 400px; /* Adjust width for the register page */
            width: 100%;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add shadow for depth */
            margin: 20px 0; /* Add margin to prevent touching top and bottom */
            max-height: 90vh; /* Ensure the form container doesn't overflow the viewport height */
            overflow-y: auto; /* Make it scrollable if the content overflows */
        }

        /* Title Styling */
        .form-container h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333; /* Dark color for text */
            margin-bottom: 20px;
        }

        /* Form Group Styling */
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 1rem;
            color: #333; /* Dark color for text */
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            color: #333;
        }

        /* Button Styling */
        .form-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .form-buttons button, .form-buttons a {
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
            display: inline-block;
            text-align: center;
            width: 140px;
        }

        /* Register Button Styling (Submit) */
        .form-buttons .ok-button {
            background-color: #5c6bc0; /* Blue color */
            color: #fff;
            border: none;
        }

        .form-buttons .ok-button:hover {
            background-color: #3f51b5; /* Darker blue on hover */
        }

        /* Login Button Styling (Cancel) */
        .form-buttons a {
            background-color: #4CAF50; /* Green color */
            color: white;
            text-align: center;
            padding: 10px 20px;
            display: inline-block;
            width: 140px;
            text-decoration: none;
            border-radius: 5px;
        }

        .form-buttons a:hover {
            background-color: #45a049; /* Darker green on hover */
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
                <label for="relation">Emergency Contact:</label>
                <input type="text" id="relation_to_emergency" name="relation_to_emergency">
            </div>

            <div class="form-group">
                <label for="emergency_contact">Relation to Emergency Contact:</label>
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
