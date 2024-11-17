<?php

?>

<!DOCTYPE html>

<html>
    <head>
        <title>User Profile</title>
        <link rel="stylesheet" href="../Style/patientProfile.css">
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

                <form id="profile-form-" action="">
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

                    <div class="buttons">
                        <input type="button" value="Update" class="update">
                        <input type="reset" value="Reset" class="reset" onclick="enableFormFields()">
                    </div>
                </form>
            </div>
        </div>

        <script>
            //reset functionality
            function enableFormFields(e) {
                const form = document.getElementById('profile-form');
                const inputs = document.querySelectorAll('input[type=text], input[type=email], input[type=tel], input[type=password]');

                inputs.forEach(input => {
                    if(input.id !== 'first-name' && input.id !== 'last-name') {
                        input.disabled = false;
                        input.value = "";
                        input.placeholder = input.getAttribute('placeholder') || "";
                    }
                });
            }

            //update functionality needs to be developed
        </script>
    </body>

    <?php include '../Components/Footer.php'; ?>
</html>