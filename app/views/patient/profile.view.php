<?php include '../Components/Header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Personal Details Form</title>
  <link rel="stylesheet" href="../Style/patient_updateprofile.css"/>
</head>

<body>
  <div class="patient">
    <div class="patientprofilecard">
      <img src="../assets/profilepic.png" alt="Profile Picture" />
      <ul>
        <li class="patient-name">John Doe</li>
        <li class="E-mail">john23@gmail.com</li>
      </ul>
    </div>
    <div class="form-container">
      <div class="patientprofileform">
        <h4>Personal Details</h4>
        <form method="POST" action="action_url_here">

          <div class="form-group">
            <label for="firstname">First name :</label>
            <input type="text" id="firstname" name="name" placeholder="Enter first name" >
          </div>
          <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" >
          </div>
          <div class="form-group">
            <label for="phone">Phone Number :</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" >
          </div>

          <div class="form-group">
            <label for="nic">NIC/Passport :</label>
            <input type="text" id="nic" name="nic" placeholder="Enter your NIC number" >
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
<?php include '../Components/Footer.php'; ?>