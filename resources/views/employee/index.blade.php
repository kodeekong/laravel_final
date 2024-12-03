<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 30px;
        }

        .table {
            margin-top: 20px;
        }

        .form-row {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .btn {
            display: block;
        }

        .text-center {
            text-align: center;
        }

        .w-100 {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center">Employee</h1>
    <p class="text-center">Show current employee list with all the attributes. Add a search option for each attribute.</p>

    <!-- Employee Table -->
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <!-- Placeholder Rows -->
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>Doctor</td>
                <td>$5000</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jane Smith</td>
                <td>Supervisor</td>
                <td>$4000</td>
            </tr>
        </tbody>
    </table>

    <!-- Update Salary Form -->
    <form class="update-salary-form" method="POST" action="">
        @csrf
        <div class="form-row">
            <div class="col-md-6">
                <label for="emp_id" class="btn btn-primary">Emp ID</label>
                <input type="text" id="emp_id" name="emp_id" class="form-control" placeholder="Enter Employee ID">
            </div>
            <div class="col-md-6">
                <label for="new_salary" class="btn btn-primary">New Salary</label>
                <input type="text" id="new_salary" name="new_salary" class="form-control" placeholder="Enter New Salary">
            </div>
        </div>
        <div class="form-row mt-3">
            <div class="col-md-6">
                <button type="submit" class="btn btn-success w-100">Ok</button>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-danger w-100">Cancel</button>
            </div>
        </div>
    </form>

    <p class="text-center mt-4">This page is accessed by Admin and Supervisor but only Admin can change the salary.</p>
</div>

<!-- Add Bootstrap JS link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
