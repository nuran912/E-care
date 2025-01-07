<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Error</title>
    <link rel="stylesheet"  href="<?php ROOT; ?>assets/css/paymenterrorpage.css">
    
</head>
<body>
    <div class="pe-error__image">
        <img src="../assets/img/paymentPage-img/paymenterror.gif" alt="Payment Error">
    </div>
    
    <h2 class="pe-error__title">Payment Unsuccessful</h2>
    <h3 class="pe-error__message">There was an issue processing your payment.</h3>
    <p class="pe-error__description">Please try again or contact support if the issue persists.</p>

    <a href="<?php echo ROOT; ?>/Home" class="pe-error__link">Try Again The Payment</a>
</body>
</html>
