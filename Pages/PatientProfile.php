<?php

?>

<!DOCTYPE html>

<html>
    <head>
        <title>User Profile</title>
        <link rel="stylesheet" href="../Style/PatientProfile.css">
    </head>

    <?php include '../Components/Header.php'; ?>

    <body>
        <div class="main-context">
            <div class="profile-sidebar">
                <img src="../assets/profilepic.png" alt="profile-pic">
                <h1>John Doe</h1>
            </div>

            <div class="form">
                <h2>Personal Details</h2>

                <form action="">
                    <div class="personal-details">
                        <label for="firstName">First name : </label>
                        <input type="text" name="firstName" id="first-name" placeholder="John" disabled><br>

                        <label for="lastName">Last name : </label>
                        <input type="text" name="lastName" id="last-name" placeholder="Doe" disabled><br>

                        <label for="email">Email : </label>
                        <input type="email" name="email" id="email" placeholder="johndoe@gmail.com" disabled><br>

                        <label for="phoneNumber">Phone number : </label>
                        <input type="tel" name="phoneNumber" id="phone-number" placeholder="077-1234567" disabled><br>

                        <label for="nicPassport">NIC/Passport : </label>
                        <input type="text" name="nicPassport" id="nic-passport" placeholder="200112345678" disabled><br>
                    </div>

                    <div class="password">
                        <label for="currentPassword">Current Password : </label>
                        <input type="password" name="currentPassword" id="current-password" placeholder="yydbwdilwndpqw" disabled><br>

                        <label for="newPassword">New Password : </label>
                        <input type="password" name="newPassword" id="new-password" disabled>
                    </div>

                    <input type="submit" value="Update" class="update">
                    <input type="reset" value="Reset" class="reset">
                </form>
            </div>
        </div>

        <!-- <script>
            function enableFormField() {
                const inputs = document.querySelectorAll('.form input');
                inputs.forEach(input => {
                    input.disabled = false;
                    // input.value = "";
                    // input.placeholder = "";
                });
            }
        </script> -->
    </body>

    <?php include '../Components/Footer.php'; ?>
</html>