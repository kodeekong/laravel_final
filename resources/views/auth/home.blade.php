<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .container h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .nav-links {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .nav-links a {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            color: #fff;
            background-color: #4CAF50;
            transition: background-color 0.3s;
        }
        .nav-links a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome to the Home Management System</h1>
    <div class="nav-links">
        <a href="/login">Login</a>
        <a href="/register">Register</a>
    </div>
</div>

</body>
</html>
