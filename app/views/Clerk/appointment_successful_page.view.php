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
            <p><strong>Telephone Number:</strong> <?php echo $_SESSION['appointment_data']['phone_number']; ?></p>
            <?php if ($_SESSION['USER']->role != 'reception_clerk'): ?>
                <p><strong>Title:</strong> <?php echo ucfirst($_SESSION['appointment_data']['title']); ?></p>
            <?php if (!empty($_SESSION['appointment_data']['patient_Email'])): ?>
                <p><strong>Email Address:</strong> <?php echo $_SESSION['appointment_data']['patient_Email']; ?></p>
            <?php else: ?>
                <p><strong>Email Address:</strong> Not entered</p>
            <?php endif; ?>
           
           
            <p><strong>NIC/Passport Number:</strong> <?php echo $_SESSION['appointment_data']['nic_passport']; ?></p>
            <?php if (!empty($_SESSION['appointment_data']['patient_address'])): ?>
                <p><strong>Address:</strong> <?php echo $_SESSION['appointment_data']['patient_address']; ?></p>
            <?php else: ?>
                <p><strong>Address:</strong> Not entered</p>
            <?php endif; ?>
            <?php endif; ?>
            <p><strong>Doctor Name:</strong> <?php echo $_SESSION['appointment_data']['doctor_name'][0]->name; ?></p>
            <p><strong>Hospital Name:</strong> <?php echo $_SESSION['appointment_data']['hospital_name']; ?></p>
            <p><strong>Appointment Number:</strong> <?php echo $_SESSION['appointment_data']['appointment_number']; ?></p>
            <p><strong>Session Date:</strong> <?php echo date('l, d F Y', strtotime($_SESSION['appointment_data']['session_date'])); ?></p>
            <p><strong>Session Time:</strong> <?php echo $_SESSION['appointment_data']['session_time']; ?></p>
            <p><strong>Total Fee:</strong> Rs. <?php echo $_SESSION['appointment_data']['total_fee']; ?>.00</p>
            <p><strong>Payment Status:</strong> 
                <span style="background-color: <?php echo $_SESSION['appointment_data']['payment_status'] == 'completed' ? 'green' : 'red'; ?>; color: white; padding:5px;">
                    <?php echo $_SESSION['appointment_data']['payment_status']; ?>
                </span>
            </p>
            <!-- <p><strong>Schedule ID:</strong> <?php echo $_SESSION['appointment_data']['schedule_id']; ?></p> -->
        </div>
        <div class="buttons">
        <button input onclick="window.location.href='<?php echo ROOT; ?>/Clerk/receptionClerkViewPendingAppointments'">Work Log</button>
        <?php $appointmentId = $_GET['appointment_id'] ?? ''; ?>
             <?php if ($_SESSION['appointment_data']['payment_status'] == 'completed'): ?>
                
                <button id="completeAppointmentBtn" style="background-color: red;" onclick="window.location.href='<?php echo ROOT; ?>/Paymentsuccessfulpage?appointment_id=<?php echo $appointmentId; ?>'">
                    Complete Appointment
                </button>
            <?php else: ?>

                    <form action="<?php echo ROOT; ?>/Appointment_successful_page?appointment_id=<?php echo $appointmentId; ?>" method="post">
            <button type="submit" name="submit" value="">Pay Now</button>
            </form>
            <?php endif; ?>
            
        </div>
    </div>
</body>
</html>
