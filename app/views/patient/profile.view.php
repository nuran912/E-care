<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Personal Details Form</title>
  <link rel="stylesheet" href="<?= ROOT;?>/assets/css/patient/profile.css">
</head>

<body>
  <div class="patient">
    <div class="patientprofilecard">
      <img src="<?php echo ROOT;?>../assets/img/profilepic-img/profilepic.svg" alt="Profile Picture" />
      <div class="patient-details">
        <div class="patient-name">John Doe</div>
        <div class="email">john23@gmail.com</div>
        <div class="phone">+94771234567</div>
        <div class="nic">123456789V</div>

      </div>
    </div>
    <div class="form-container">
        <div class="patientprofileform">
        <h4>Personal Details</h4>
        <form method="POST" action="action_url_here">
          <div class="form-group">
            <label for="firstname">Full Name :</label>
            <input type="text" id="firstname" name="name" placeholder="Enter your full name">
          </div>
          <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="Enter your email">
          </div>
          <div class="form-group">
            <label for="phone">Phone Number :</label>
            <input type="tel" id="phone" pattern="[0-9]{10}" name="phone" placeholder="Enter your phone number">
          </div>
            <div class="form-group">
            <label for="nic">NIC/Passport :</label>
            <input type="text" id="nic" name="nic" placeholder="Enter your NIC number" pattern="^[0-9]{9}[vVxX]$|^[0-9]{12}$" title="Please enter a valid NIC or Passport number">
            </div>
          <div class="form-group">
            <label for="password">Password :</label>
            <input type="password" id="password" name="password" placeholder="Enter your current password">
          </div>
          <div class="form-group">
            <label for="new-password">New Password :</label>
            <input type="password" id="new-password" name="new-password" placeholder="Enter your new password">
          </div>
          <div class="button-container">
            <button type="submit" class="update-button">Update</button>
            <button type="reset" class="reset-button">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
