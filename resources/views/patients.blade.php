<!-- resources/views/patients.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients List</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            text-align: center;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.1rem;
            color: #7f8c8d;
            margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #34495e;
            color: #fff;
            font-size: 1.1rem;
            text-transform: uppercase;
        }

        table td {
            background-color: #ecf0f1;
            color: #2c3e50;
            font-size: 1rem;
        }

        table tr:nth-child(even) {
            background-color: #bdc3c7;
        }

        .access-info {
            font-size: 1rem;
            color: #7f8c8d;
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Patients</h1>
        <p>Add a search option for each attribute.</p>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Emergency Contact</th>
                        <th>Emergency Contact Name</th>
                        <th>Admission Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>67</td>
                        <td>123-456-7890</td>
                        <td>Jane Doe</td>
                        <td>2024-11-20</td>
                    </tr>
                    <!-- You can add more dummy rows as needed -->
                </tbody>
            </table>
        </div>

        <p class="access-info">
            This page is accessed by Admin, Supervisors, Doctors, and Caregivers.
        </p>
    </div>
</body>
</html>
