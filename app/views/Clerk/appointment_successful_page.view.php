<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Successful Page</title>
    <link rel="stylesheet" href="assets/css/appointment_successful_page.css">
</head>
<body>
    <div class="container">
   
        <div class="main">
        <h1>Appointment Successfully Created!</h1>
        </div>
        <div class="content">
            <h3 class="heading">Appointment Details  </h3>
            <p><strong>Patient Name:</strong> <?php echo ucfirst($_SESSION['appointment_data']['patient_name']); ?></p>
            <?php if (!empty($_SESSION['appointment_data']['patient_Email'])): ?>
                <p><strong>Email Address:</strong> <?php echo $_SESSION['appointment_data']['patient_Email']; ?></p>
            <?php else: ?>
                <p><strong>Email Address:</strong> Not entered</p>
            <?php endif; ?>
            <p><strong>Telephone Number:</strong> <?php echo $_SESSION['appointment_data']['phone_number']; ?></p>
            <p><strong>NIC/Passport Number:</strong> <?php echo $_SESSION['appointment_data']['nic_passport']; ?></p>
            <?php if (!empty($_SESSION['appointment_data']['patient_address'])): ?>
                <p><strong>Address:</strong> <?php echo $_SESSION['appointment_data']['patient_address']; ?></p>
            <?php else: ?>
                <p><strong>Address:</strong> Not entered</p>
            <?php endif; ?>
            <p><strong>Hospital Name:</strong> <?php echo $_SESSION['appointment_data']['hospital_name']; ?></p>
            <p><strong>Session Date:</strong> <?php echo $_SESSION['appointment_data']['session_date']; ?></p>
            <p><strong>Session Time:</strong> <?php echo $_SESSION['appointment_data']['session_time']; ?></p>
            <p><strong>Appointment Number:</strong> <?php echo $_SESSION['appointment_data']['appointment_number']; ?></p>
            <p><strong>Doctor ID:</strong> <?php echo $_SESSION['appointment_data']['doctor_id']; ?></p>
            <p><strong>Total Fee:</strong><?php echo $_SESSION['appointment_data']['total_fee']; ?></p>
            <p><strong>Payment Status:</strong> <?php echo $_SESSION['appointment_data']['payment_status']; ?></p>
            <p><strong>Schedule ID:</strong> <?php echo $_SESSION['appointment_data']['schedule_id']; ?></p>
        </div>
        <div class="buttons">
            <!-- <button onclick="window.print()">Print Details</button> -->
            <button onclick="window.location.href='<?php echo ROOT; ?>/ClerkWorkLog'">Work Log</button>
            <button onclick="window.location.href='payment.html'">Pay Now</button>
        </div>
    </div>
</body>
</html>
