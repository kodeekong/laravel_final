<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Member's Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-section {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
        }

        .input-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-group input {
            padding: 8px;
            width: 250px;
        }

        .buttons {
            text-align: center;
            margin-bottom: 20px;
        }

        .ok-btn, .cancel-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin: 5px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .cancel-btn {
            background-color: #f44336;
        }

        .ok-btn:hover, .cancel-btn:hover {
            opacity: 0.8;
        }

        .table-section {
            display: flex;
            justify-content: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 1200px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            text-align: center;
            padding: 10px;
        }

        thead {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Family Member's Home</h1>

    <div class="form-section">
        <div class="input-group">
            <label for="date">Date</label>
            <input type="date" id="date">
        </div>

        <div class="input-group">
            <label for="family-code">Family Code (For Patient Family Member)</label>
            <input type="text" id="family-code">
        </div>

        <div class="input-group">
            <label for="patient-id">Patient ID (For Patient Family Member)</label>
            <input type="text" id="patient-id">
        </div>
    </div>

    <div class="buttons">
        <button class="ok-btn">Ok</button>
        <button class="cancel-btn">Cancel</button>
    </div>

    <div class="table-section">
        <table>
            <thead>
                <tr>
                    <th>Doctor's Name</th>
                    <th>Doctor's Appointment</th>
                    <th>Caregiver's Name</th>
                    <th>Morning Medicine</th>
                    <th>Afternoon Medicine</th>
                    <th>Night Medicine</th>
                    <th>Breakfast</th>
                    <th>Lunch</th>
                    <th>Dinner</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Dr. John Doe</td>
                    <td>10:00 AM</td>
                    <td>Jane Smith</td>
                    <td>Yes</td>
                    <td>No</td>
                    <td>Yes</td>
                    <td>No</td>
                    <td>Yes</td>
                    <td>No</td>
                </tr>
                <!-- Additional rows as needed -->
            </tbody>
        </table>
    </div>

</body>
</html>
