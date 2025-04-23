<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="<?= ROOT; ?>/assets/css/paymentsuccessfulpage.css">
    <link href="https://fonts.googleapis.com/css?family=Inter" rel="stylesheet">
</head>

<body>
    <div class="center-container">
        <div class="image">
            <img src="<?= ROOT; ?>/assets/img/paymentPage-img/successful.Gif" alt="payment successful image">
        </div>
        

        <h1>Payment Successful</h1>
<h2>Your appointment has been successfully scheduled</h2>

<?php if (!isset($_SESSION['USER']->role) || $_SESSION['USER']->role != 'reception_clerk'): ?>
    <h4>Appointment details have been sent to the&nbsp;
        <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank" style="color: blue;"><?php echo $patientEmail; ?></a>
    </h4>
<?php endif; ?>

            
        
        
      <?php if ( $_SESSION['USER']->role == 'reception_clerk') : ?>
        <a href="<?php echo ROOT; ?>/Clerk/receptionClerkViewPendingAppointments" class="continue-button" style="color: blue;">Go to view pending appointments</a>
        <?php else: ?>
        <a href="index.php" class="home-link">Go Back To The Home Page</a>
        <?php endif; ?>
    </div>
</body>

</html>

