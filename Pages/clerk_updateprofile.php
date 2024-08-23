<?php include '../Components/Header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Clerk Details Form</title>
  <link rel="stylesheet" href="../Style/clerk_updateprofile.css" />
</head>

<body>
<?php include './Components/Header.php'; ?>
  <div class="clerk">
    <div class="clerkprofilecard">
      <img src="../assets/profilepic.png" alt="Profile Picture" />
      <ul>
        <li class="clerk-name">Niki Minaj</li>
        <li class="department">General</li>
        <li class="status">Active</li>
      </ul>
    </div>
    <div class="form-container">

      <div class="clerkprofileform">
        <h4>Personal Details</h4>
        <form method="POST" action="action_url_here">

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name">
          </div>
           
          <div class="form-group">
  <label for="role">Role:</label>
  <select id="role" name="role">
    <option value="Lab Clerk">Lab Clerk</option>
    <option value="Report Clerk">Report Clerk</option>
    <option value="Receptionist">Receptionist</option>
  </select>
</div>


          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email">
          </div>

          <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number">
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
  <?php include '../Components/Footer.php'; ?>
</body>

</html>
