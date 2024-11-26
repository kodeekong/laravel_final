<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Payment Container */
        .payment-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 700px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Title */
        .payment-container h1 {
            font-size: 28px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Form Fields */
        .payment-container .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            align-items: center;
        }

        .payment-container .form-group input {
            width: 60%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .payment-container .form-group button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .payment-container .form-group button:hover {
            background-color: #45a049;
        }

        .payment-container .info-box {
            margin-top: 20px;
            font-size: 14px;
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
        }

        .payment-container .info-box p {
            margin: 5px 0;
        }

        /* Button Container */
        .payment-container .button-container {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }

        .payment-container .button-container .ok-btn,
        .payment-container .button-container .cancel-btn {
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .payment-container .button-container .ok-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        .payment-container .button-container .cancel-btn {
            background-color: #f44336;
            color: white;
            border: none;
        }

        .payment-container .button-container .ok-btn:hover {
            background-color: #45a049;
        }

        .payment-container .button-container .cancel-btn:hover {
            background-color: #d32f2f;
        }

        /* Update Button Styling */
        .payment-container .update-btn {
            background-color: #ADD8E6;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        .payment-container .update-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h1>Payment</h1>
        <!-- Form Fields -->
        <div class="form-group">
            <label for="patient_id">Patient ID</label>
            <input type="text" id="patient_id" name="patient_id">
        </div>
        <div class="form-group">
            <label for="total_due">Total Due</label>
            <input type="text" id="total_due" name="total_due">
        </div>
        <div class="form-group">
            <label for="new_payment">New Payment</label>
            <input type="text" id="new_payment" name="new_payment">
        </div>

        <!-- Information Box -->
        <div class="info-box">
            <p>Only Admin has access to this page.</p>
            <p>When the Admin presses the "Update" button, it checks the system date and the previous update date. If it is not the same, then you calculate the bill between those days for each patient and add it.</p>
            <p>$10 for every day</p>
            <p>$50 for every appointment</p>
            <p>$5 for every medicine/month</p>
        </div>

        <!-- Action Buttons -->
        <div class="button-container">
            <button class="ok-btn">Ok</button>
            <button class="cancel-btn">Cancel</button>
        </div>

        <!-- Update Button -->
        <button class="update-btn">Update</button>
    </div>
</body>
</html>
