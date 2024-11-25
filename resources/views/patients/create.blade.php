<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Patient</title>
</head>
<body>
    <h1>Create Patient</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('patients.store') }}" method="POST">
        @csrf

        <label for="user_id">User ID:</label>
        <input type="text" id="user_id" name="user_id" required><br><br>

        <label for="patient_id">Patient ID:</label>
        <input type="text" id="patient_id" name="patient_id" required><br><br>

        <label for="group">Group:</label>
        <input type="text" id="group" name="group"><br><br>

        <label for="admission_date">Admission Date:</label>
        <input type="date" id="admission_date" name="admission_date"><br><br>

        <button type="submit">Save Patient</button>
    </form>
</body>
</html>
