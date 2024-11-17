<link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/header.css">
<!-- Header -->
<nav class="navbar">
   <div class="navdiv">
      <div class="logo-div">
         <a href="../views/home.view.php" class="logo">
            <img src="<?php echo ROOT ?>/assets/img/E_Care_logo.svg" alt="E-care logo">
         </a>
      </div>
      <ul class="navbar-headings">
         <li><a href="<?= ROOT ?>/Home">Home</a></li>
         <li><a href="#">Services</a></li>
         <li><a href="../Pages/Appointment.php">Appointment</a></li>
         <li><a href="#">About</a></li>
         <li><a href="#">Contact Us</a></li>
      </ul>
      <div class="buttons-div">
         <button class="signin-btn"><a href="<?php echo ROOT ?>/Signin">Sign In</a></button>
         <button class="reg-btn"><a href="<?php echo ROOT ?>/Signup">Register</a></button>
      </div>
   </div>
</nav>