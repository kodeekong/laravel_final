<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        }

        /* Main form container */
        .form-container {
            background-color: #fff;  /* Solid white background for the form */
            padding: 30px;
            border-radius: 10px;
            max-width: 400px; /* Adjust width for the login page */
            width: 100%;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add shadow for depth */
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

        .form-group input {
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

        .form-buttons .ok-button {
        background-color: #4CAF50; /* Green color */
        color: #fff;
        border: none;  
        }

        .form-buttons .ok-button:hover {
        background-color: #45a049; /* Darker green on hover */
        }

        .form-buttons .cancel-button {
        background-color: #5c6bc0;
        color: #fff;
        border: none;
        }

        .form-buttons .cancel-button:hover {
        background-color: #3f51b5;
        }


        .form-buttons a {
            background-color: #4CAF50;
            color: white;
            text-align: center;
        }

        .form-buttons a:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>

<div class="form-container">
    <h2>Log in</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-buttons">
            <button type="submit" class="ok-button">Login</button>
            <a href="/register" class="cancel-button">Register</a>
        </div>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
