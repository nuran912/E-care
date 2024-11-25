<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Personal Details Form</title>
  <link rel="stylesheet" href="<?= ROOT; ?>/assets/css/patient/profile.css">
</head>

<body>
  <div class="patient">
    <div class="patientprofilecard">
      <img src="<?php echo ROOT; ?>../assets/img/profilepic-img/profilepic.svg" alt="Profile Picture" />
      <div class="patient-details">
        <div class="patient-name"><?php echo $_SESSION['USER']->name; ?></div>
        <div class="email"><?php echo $_SESSION['USER']->email; ?></div>
        <div class="phone"><?php echo $_SESSION['USER']->phone_number; ?></div>
        <div class="nic"><?php echo $_SESSION['USER']->NIC; ?></div>

      </div>
    </div>
    <?php if (!empty($data['success'])) : ?>
      <div class="error" style="color: green;"><?php echo $data['success']; ?></div>
    <?php endif; ?>
      <div class="patientprofileform">
        <h4><span id="titleform">Hello! <?php echo $_SESSION['USER']->name; ?> This is Your Current Personal Details</span></h4>
        <form method="POST">
          <div class="form-group">
            <label for="firstname">Full Name :</label>
            <input type="text" id="firstname" name="name" placeholder="Enter your full name" value="<?php echo $_SESSION['USER']->name; ?>">
          </div>
          <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo $_SESSION['USER']->email; ?>">
            <?php if (!empty($errors['email'])) : ?>
              <div class="error"><?php echo $errors['email']; ?></div>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label for="phone_number">Phone Number :</label>
            <input type="tel" id="phone_number" pattern="[0-9]{10}" name="phone_number" placeholder="Enter your phone number" value="<?php echo $_SESSION['USER']->phone_number; ?>">
            <?php if (!empty($errors['phone_number'])) : ?>
              <div class="error"><?php echo $errors['phone_number']; ?></div>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label for="nic">NIC/Passport :</label>
            <input type="text" id="nic" name="nic" placeholder="Enter your NIC number" pattern="^[0-9]{9}[vVxX]$|^[0-9]{12}$" title="Please enter a valid NIC or Passport number"
              value="<?php echo $_SESSION['USER']->NIC; ?>">
            <?php if (!empty($errors['NIC'])) : ?>
              <div class="error"><?php echo $errors['NIC']; ?></div>
            <?php endif; ?>
          </div>
            <div class="form-group">
            <label for="password">Current Password :</label>
            <input type="password" id="password" name="password" placeholder="Enter your current password" value="">
            <?php if (!empty($errors['password'])) : ?>
              <div class="error"><?php echo $errors['password']; ?></div>
            <?php endif; ?>
            </div>
          <div class="form-group">
            <label for="new-password">New Password :</label>
            <input type="password" id="new-password" name="newPassword" placeholder="Enter your new password" value="">
            <?php if (!empty($errors['newPassword'])) : ?>
              <div class="error"><?php echo $errors['newPassword']; ?></div>
            <?php endif; ?>
          </div>
          <div class="criteria">If you need to change the password, you must enter both the current and new passwords.</div>

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