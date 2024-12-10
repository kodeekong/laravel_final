<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Management System</title>
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

        /* Main container */
        .container {
            background-color: #fff;  /* Solid white background for the container */
            padding: 30px;
            border-radius: 10px;
            max-width: 500px; /* Adjust width for the home page */
            width: 100%;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add shadow for depth */
        }

        /* Title Styling */
        .title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333; /* Dark color for text */
            margin-bottom: 20px;
        }

        /* Nav Links Styling */
        .nav-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .nav-links a {
            font-size: 1.2rem;
            color: #fff;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            background-color: #5c6bc0;
            text-align: center;
            transition: background-color 0.3s;
        }

        .nav-links a:hover {
            background-color: #3f51b5;
        }
    </style>
</head>
<body>

    <!-- Main Content -->
    <div class="container">
        <!-- Home Management System Title -->
        <div class="title">
            <p>GRANDO HILLS<br><h1>Home Management System</h1></p>
            
        </div>

        <!-- Nav Links Container -->
        <div class="nav-links">
            <a href="/login">Login</a>
            <a href="/register">Register</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
