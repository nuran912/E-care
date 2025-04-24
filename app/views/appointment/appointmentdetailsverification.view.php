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
                <p><strong>Patient Name:</strong> <?php echo ucfirst($_SESSION['appointment']['title']) . ' ' . ucfirst($_SESSION['appointment']['patientName']); ?></p>
                <p><strong>Telephone Number:</strong> <?php echo $_SESSION['appointment']['patientPhone']; ?></p>
                <?php if (!isset($_SESSION['USER']) || $_SESSION['USER'] === null || $_SESSION['USER']->role !== 'reception_clerk'): ?>
                <?php if (!empty($_SESSION['appointment']['patientEmail'])): ?>
                    <p><strong>Email Address:</strong> <?php echo $_SESSION['appointment']['patientEmail']; ?></p>
                <?php else: ?>
                    <p><strong>Email Address:</strong> Not entered</p>
                <?php endif; ?>
               
                <p><strong>NIC/Passport Number:</strong> <?php echo $_SESSION['appointment']['NicOrPassport']; ?></p>
                <?php if (!empty($_SESSION['appointment']['patientAddress'])): ?>
                    <p><strong>Address:</strong> <?php echo $_SESSION['appointment']['patientAddress']; ?></p>
                <?php else: ?>
                    <p><strong>Address:</strong> Not enterd</p>
                <?php endif; ?>
                <?php endif; ?>
            </div>

            <form action="<?= ROOT; ?>/Processpayment" method="POST">
                <input type="checkbox" id="confirmDetails" name="confirmDetails" required>
                <label for="confirmDetails">I confirm that the above details are correct.</label><br><br>

                <button class="edit" type="button" onclick="window.history.back()">Edit Details</button>
            <?php
            if (isset($_SESSION['USER']->role) && $_SESSION['USER']->role == 'reception_clerk') {
            ?>
                <button class="proceed" type="submit" value="Proceed with Payment">Create Appointment</button>
            <?php
            } else {
            ?>
                <button class="proceed" type="submit" value="Proceed with Payment">Proceed with Payment</button>
            <?php
            }
            ?>

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
                <input type="hidden" name="total_fee" value="<?php echo $total_fee; ?>">
                <input type="hidden" name="filled_slots" value="<?php echo $_SESSION['appointment']['filled_slots']; ?>">
                <input type="hidden" name="availableatime_id" value="<?php echo $_SESSION['appointment']['availableatime_id']; ?>">
                <input type="hidden" name="service_charge" value="<?php echo $_SESSION['appointment']['service_charge'];?>">
                <input type="hidden" name="document" value="<?php echo $_SESSION['appointment']['documents']; ?>"> 
            </form>
          
        <?php endif; ?>
    </div>
</body>

</html>