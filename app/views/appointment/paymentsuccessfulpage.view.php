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
        <h4>Appointment details have been sent to your email</h4>

        <!-- Add clickable link to open email inbox -->
        <p><a href="https://mail.google.com/mail/u/0/#inbox" target="_blank">📧 Click here to check your email</a></p>

        <!-- Or you can add a mailto link to open the user's email client -->
        <!-- <p><a href="mailto:<?php echo $patientemail; ?>" target="_blank">📧 Click here to open your email client</a></p> -->

        <a href="index.php" class="home-link">Go Back To The Home Page</a>
    </div>
</body>

</html>
