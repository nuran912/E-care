<link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/header.css">
<script src="<?php echo ROOT ?>/assets/js/header.js"></script>
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
         <li><a href="<?= ROOT ?>/Laboratories">Services</a></li>
         <li><a href="<?= ROOT?>/appointmentsearchpage">Appointment</a></li>
         <li><a href="<?= ROOT ?>/Hospitals">About</a></li>
         <li><a href="#footer">Contact Us</a></li>
      </ul>

      <div class="buttons-div">
         <?php if (isset($_SESSION['USER'])): ?>
            <p>Hi, <?php echo $_SESSION['USER']->name; ?></p>
            <a href="<?php echo ROOT ?>/<?php echo ucfirst($_SESSION['USER']->role) ?>/profile"><img class="user-img" src="<?php echo ROOT ?>/assets/img/user.svg" alt="User"></a>
            <img class="menu" src="<?php echo ROOT ?>/assets/img/menu.svg" alt="Menu">
            <?php if ($_SESSION['USER']->role == 'admin'): ?>

               <card>
                  <h4>Admin Menu</h4>
                  <p><a href="<?php echo ROOT ?>/Admin/profile">Profile</a></p>
                  <p><a href="<?php echo ROOT ?>/Admin/dashboard">Dashboard</a></p>
                  <p><a href="<?php echo ROOT ?>/Admin/user">User</a></p>
                  <p><a href="<?php echo ROOT ?>/Admin/doctor">Doctor</a></p>
                  <p><a href="<?php echo ROOT ?>/Admin/clerk">Clerk</a></p>
                  <p><a href="<?php echo ROOT ?>/Admin/insurance">Insurance Company</a></p>
                  <p><a href="<?php echo ROOT ?>/Admin/articles">Articles</a></p>
                  <button class="signout-btn"><a href="<?php echo ROOT ?>/Signout">Sign Out</a></button>
               </card>
            <?php endif; ?>
            <?php if ($_SESSION['USER']->role == 'doctor'): ?>
               <!-- <button class="admin-btn"><a href="<?php echo ROOT ?>/Doctor">Doctor</a></button> -->
               <card>
                  <h4>Doctor Menu</h4>
                  <p><a href="<?php echo ROOT ?>/Doctor/profile">Profile</a></p>
                  <p><a href="<?php echo ROOT ?>/Doctor/doctorPendingAppt">Manage Appointments</a></p>
                  <p><a href="<?php echo ROOT ?>/Doctor/doctorCreateApptSlot">Manage Schedules</a></p>
                  
                  <button class="signout-btn"><a href="<?php echo ROOT ?>/Signout">Sign Out</a></button>
               </card>
            <?php endif; ?>
            <?php if ($_SESSION['USER']->role == 'patient'): ?>
               <!-- <button class="admin-btn"><a href="<?php echo ROOT ?>/Patient">Patient</a></button> -->
               <card>
                  <h4>Patient Menu</h4>
                  <p><a href="<?php echo ROOT ?>/Patient/profile">Profile</a></p>
                  <p><a href="<?php echo ROOT ?>/Patient/appointments">Manage Appointments</a></p>
                  <p><a href="<?php echo ROOT ?>/Patient/medical_records">Medical Documents</a></p>
                  <p><a href="<?php echo ROOT ?>/Patient/insuranceclaims">Insurance Claims</a></p>
                  <button class="signout-btn"><a href="<?php echo ROOT ?>/Signout">Sign Out</a></button>
               </card>
            <?php endif; ?>
            <?php if (($_SESSION['USER']->role == 'lab_clerk')): ?>
               <!-- <button class="admin-btn"><a href="<?php echo ROOT ?>/Labclerk">Lab Clerk</a></button> -->
               <card>
                  <h4>Lab Clerk Menu</h4>
                  <p><a href="<?php echo ROOT ?>/Clerk/profile">Profile</a></p>
                  <p><a href="<?php echo ROOT ?>/Clerk/labClerkUploadDoc">Upload Document</a></p>
                  <p><a href="<?php echo ROOT ?>/Clerk/labClerkWorkLog">Work Log</a></p>

                  <button class="signout-btn"><a href="<?php echo ROOT ?>/Signout">Sign Out</a></button>
               </card>
            <?php endif; ?>
            <?php if ($_SESSION['USER']->role == 'reception_clerk'): ?>
               <!-- <button class="admin-btn"><a href="<?php echo ROOT ?>/Receptionclerk">Reception Clerk</a></button> -->
               <card>
                  <h4>Reception Clerk Menu</h4>
                  <p><a href="<?php echo ROOT ?>/Clerk/profile">Profile</a></p>
                  <p><a href="<?php echo ROOT ?>/appointmentsearchpage">Create Appointments</a></p>
                  <p><a href="<?php echo ROOT ?>/Clerk/receptionClerkViewPendingAppointments">Pending Appointments</a></p>

                  <button class="signout-btn"><a href="<?php echo ROOT ?>/Signout">Sign Out</a></button>
               </card>
            <?php endif; ?>
            <?php if ($_SESSION['USER']->role == 'record_clerk'): ?>
               <!-- <button class="admin-btn"><a href="<?php echo ROOT ?>/Recordclerk">Record Clerk</a></button> -->
               <card>
                  <h4>Record Clerk Menu</h4>
                  <p><a href="<?php echo ROOT ?>/Clerk/profile">Profile</a></p>
                  <p><a href="<?php echo ROOT ?>/Clerk/recordClerkUploadDoc">Upload Document</a></p>
                  <p><a href="<?php echo ROOT ?>/Clerk/recordClerkWorkLog">Work Log</a></p>

                  <button class="signout-btn"><a href="<?php echo ROOT ?>/Signout">Sign Out</a></button>
               </card>
            <?php endif; ?>

         <?php else: ?>
            <button class="signin-btn"><a href="<?php echo ROOT ?>/Signin">Sign In</a></button>
            <button class="reg-btn"><a href="<?php echo ROOT ?>/Signup">Register</a></button>
         <?php endif; ?>
      </div>
   </div>
</nav>