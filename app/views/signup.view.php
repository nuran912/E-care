<?php
if (!isset($errors)) {
    $errors = [];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Care Sign Up</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/sign-up.css">

</head>

<body>

    <div class="main-context">

        <h1>Welcome to E-Care by Union Hospital</h1>
<!-- 
        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?> -->
        <div class="container">
            <center>
                <h3>Register an Account</h3>
                <p class="signUptext">Please fill the following form fields.</p>
            </center>
            <br />

            <form method="POST">

                <div class="form-row">

                    <div class="form-group">
                        <label for="">Title<span style="color: red;">*</span></label>
                        <select name="title" class="title" required>
                            <option value="" disabled selected>Select</option>
                            <option value="Mr">Mr</option>
                            <option value="Ms">Ms</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Dr">Dr</option>
                            <option value="prof">Prof</option>
                            <option value="Rev">Rev</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Full Name <span style="color: red;">*</span></label>
                        <input type="text" name="name" value="">
                        <?php if (!empty($errors['name'])) : ?>
                            <div class="error"><?php echo $errors['name']; ?></div>
                        <?php endif; ?>
                    </div>



                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label for="">Email <span style="color: red;">*</span></label>
                        <input type="text" name="email" value="">
                        <?php if (!empty($errors['email'])) : ?>
                            <div class="error"><?php echo $errors['email']; ?></div>
                        <?php endif; ?>

                    </div>

                    <div class="form-group">
                        <label for="">Phone number <span style="color: red;">*</span></label>
                        <input type="tel" name="phone_number" value="">
                        <?php if (!empty($errors['phone_number'])) : ?>
                            <div class="error"><?php echo $errors['phone_number']; ?></div>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label for="">NIC Number/Passport <span style="color: red;">*</span></label>
                        <input type="text" name="NIC" value="">
                        <?php if (!empty($errors['NIC'])) : ?>
                            <div class="error"><?php echo $errors['NIC']; ?></div>
                        <?php endif; ?>
                    </div>

                </div>
                <br>

                <div class="form-row">
                    <div class="form-group">
                        <label for="">Password <span style="color: red;">*</span></label>
                        <input type="password" name="password" value="">
                        <?php if (!empty($errors['password'])) : ?>
                            <div class="error"><?php echo $errors['password']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="">Confirm Password <span style="color: red;">*</span></label>
                        <input type="password" name="confirmPassword" value="">
                        <?php if (!empty($errors['confirmPassword'])) : ?>
                            <div class="error"><?php echo $errors['confirmPassword']; ?></div>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="form-row">
                        <input type="checkbox" name="terms" class="terms">
                        <div style="display: flex; flex-direction:column; gap:0px;">
                            <label for="" class="termsagreement">I agree to the <a href="<?= ROOT ?>/termsAndConditions" class="termsConditions">terms and conditions</a></label>
                            <?php if (!empty($errors['terms'])) : ?>
                                <div class="error" style="margin-left: 20px;"><br><?php echo $errors['terms']; ?></div>
                                <?php endif; ?>
                        </div>
                </div>
                            
                <input type="submit" value="Sign Up" class="signUpBtn">

            </form>

            <div class="signin">
                <p>Already have an account? <a href="<?php echo ROOT ?>/Signin">Sign In</a></p>
            </div>
        </div>
    </div>
</body>

</html>