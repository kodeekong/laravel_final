<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caregiver's Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .caregiver-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 900px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 28px;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .info-box {
            background-color: #e0f7fa;
            padding: 10px;
            border-left: 4px solid #007BFF;
            margin-bottom: 20px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        input[type="text"] {
            width: 80%;
            padding: 6px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            color: white;
        }

        .ok-btn {
            background-color: #28a745;
        }

        .ok-btn:hover {
            background-color: #218838;
        }

        .cancel-btn {
            background-color: #dc3545;
        }

        .cancel-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <div class="caregiver-container">
        <h1>Caregiver’s Home</h1>

        <div class="info-box">
            This page is accessed by the caregiver who logged in.
        </div>

        <table>
            <tr>
                <th>Name</th>
                <th>Morning Medicine</th>
                <th>Afternoon Medicine</th>
                <th>Night Medicine</th>
                <th>Breakfast</th>
                <th>Lunch</th>
                <th>Dinner</th>
            </tr>
            <!-- Placeholder for dynamic rows -->
            <tr>
                <td><input type="text" value="John Doe" readonly></td>
                <td><input type="text" value="Med A"></td>
                <td><input type="text" value="Med B"></td>
                <td><input type="text" value="Med C"></td>
                <td><input type="text" value="Yes"></td>
                <td><input type="text" value="Yes"></td>
                <td><input type="text" value="No"></td>
            </tr>
            <!-- Add more rows as needed -->
        </table>

        <div class="button-container">
            <button class="button ok-btn">Ok</button>
            <button class="button cancel-btn">Cancel</button>
        </div>
    </div>

</body>
</html>
