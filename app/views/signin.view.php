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

   <title>E-Care Sign In</title>
   <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/signin.css">
   <style>
      .alert {
         padding: 15px;
         margin: 15px 0;
         border-radius: 5px;
         font-size: 16px;
         font-weight: bold;
         text-align: center; 
         font-family: 'Lucida Sans';
         justify-content: center;
         align-items: center;
         
         }

         .alert-danger {
         background-color: #f8d7da;
         color: #721c24;
         border: 1px solid #f5c6cb;
         width: 40%;
         margin-left: 30%;
         
         }
   </style>
</head>

<body>

   <!-- <?php show($data); ?> -->
   <!-- <?php show($_SESSION); ?> -->

   <!-- Error Message -->
   <?php if (isset($_SESSION['error'])): ?>
         <div id="errorMessage" class="alert alert-danger">
            <?= $_SESSION['error']; ?>
         </div>
         <?php unset($_SESSION['error']); ?>
      <?php endif; ?> 

   <div class="main-context">

      <h1>Welcome to E-Care by Union Hospital</h1>

      <div class="container">
         <center>
            <h3>Sign In</h3>
            <p class="signIntext">Please enter your email and password to login</p>
         </center>
         <br>

         <form method="POST">

            <div class="form-group">
               <label for="">Email <span style="color: red;">*</span></label>
               <input type="email" class="email" name="email" value="" placeholder="Enter your email" required>


            </div>

            <div class="form-group">
               <label for="">Password <span style="color: red;">*</span></label>
               <input type="password" name="password" class="password" value="" placeholder="Enter Your Password" required>

            </div>

            <input type="checkbox" class="signedIncheckbox">
            <label for="" class="signedInstatement">Keep me signed in</label>

            <input type="submit" value="Sign In" class="signInBtn">

         </form>

         <p class="noAccount">Don't have an account? <a href="<?php echo ROOT ?>/Signup">Sign Up</a></p>
         <p class="noAccount"><a href="<?php echo ROOT ?>/ForgotPassword">Forgot password?</a></p>

      </div>

   </div>

   <script>
       // Auto-hide success/error messages after 5 seconds
       document.addEventListener("DOMContentLoaded", function() {
            const errorMessage = document.getElementById("errorMessage");
            
               if (errorMessage) {
                  setTimeout(() => {
                     errorMessage.style.display = "none";
                  }, 5000);
               }
            });
   </script>

</body>

</html>