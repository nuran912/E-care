<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Details Verification</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/appointmentdetailsverification.css">
</head>

<body>
    <div class="container">
        <h1>Payment Details Verification Page</h1>

        <?php if (isset($errorMessage)): ?>
            <p class="error"><?php echo $errorMessage; ?></p>
        <?php else: ?>
            <p>Please review and verify your personal information below before proceeding with the payment.</p>

            <div class="payment-details">
                <h3>Patient Information</h3>
                <p><strong>Patient Name:</strong> <?php echo ucfirst($_SESSION['appointment']['title']) . '. ' . ucfirst($_SESSION['appointment']['patientName']); ?></p>
                <p><strong>Email Address:</strong> <?php echo $_SESSION['appointment']['patientEmail']; ?></p>
                <p><strong>Telephone Number:</strong> <?php echo $_SESSION['appointment']['patientPhone']; ?></p>
                <p><strong>NIC/Passport Number:</strong> <?php echo $_SESSION['appointment']['NicOrPassport']; ?></p>
                <p><strong>Address:</strong> <?php echo $_SESSION['appointment']['patientAddress']; ?></p>
            </div>

            <form action="<?= ROOT; ?>/Processpayment" method="POST">
                <input type="checkbox" id="confirmDetails" name="confirmDetails" required>
                <label for="confirmDetails">I confirm that the above details are correct.</label><br><br>

                <button class="edit" type="button" onclick="window.history.back()">Edit Details</button>
                <button class="proceed" type="submit" value="Proceed with Payment">Proceed with Payment</button>


                <input type="hidden" name="title" value="<?php echo $_SESSION['appointment']['title']; ?>">
                <input type="hidden" name="appointmentId" value="<?php echo $_SESSION['appointment']['appointment_number']; ?>">
                <input type="hidden" name="patientName" value="<?php echo $_SESSION['appointment']['patientName']; ?>">
                <input type="hidden" name="patientEmail" value="<?php echo $_SESSION['appointment']['patientEmail']; ?>">
                <input type="hidden" name="patientPhone" value="<?php echo $_SESSION['appointment']['patientPhone']; ?>">
                <input type="hidden" name="idType" value="<?php echo $_SESSION['appointment']['idType']; ?>">
                <input type="hidden" name="NicOrPassport" value="<?php echo $_SESSION['appointment']['NicOrPassport']; ?>">
                <input type="hidden" name="patientAddress" value="<?php echo $_SESSION['appointment']['patientAddress']; ?>">
                <input type="hidden" name="hospital_name" value="<?php echo $_SESSION['appointment']['hospital_name']; ?>">
                <input type="hidden" name="session_date" value="<?php echo $_SESSION['appointment']['session_date']; ?>">
                <input type="hidden" name="session_time" value="<?php echo $_SESSION['appointment']['session_time']; ?>">
                <input type="hidden" name="appointment_number" value="<?php echo $_SESSION['appointment']['appointment_number']; ?>">
                <input type="hidden" name="doctor_id" value="<?php echo $_SESSION['appointment']['doctor_id']; ?>">

            </form>
        <?php endif; ?>
    </div>
</body>

</html>