<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details Verification</title>
    <link rel="stylesheet" href="../Style/appointment_details_verification.css">
</head>

<body>
    <div class="container">
        <h1>Payment Details Verification</h1>
        <p>Please review and verify your personal information below before proceeding with the payment.</p>

        <!-- Display Payment Details -->
        <div class="payment-details">
            <h3>Patient Information</h3>
            <p><strong>Patient Name:</strong> Manusha ranaweera</p>
            <p><strong>Email Address:</strong> kawshanmanusha5@gmail.com</p>
            <p><strong>Telephone Number:</strong> 0771234567</p>
            <p><strong>NIC/Passport Number:</strong> 200022500980</p>
        </div>

        <!-- Verification Form -->
        <form action="process-payment.php" method="post">
            <input type="checkbox" id="confirmDetails" name="confirmDetails" required>
            <label for="confirmDetails">I confirm that the above details are correct.</label><br><br>

            <input type="submit" value="Proceed with Payment">
            <button type="button" onclick="window.location.href='payment_page.php'">Edit Details</button>
        </form>
    </div>
</body>

</html>