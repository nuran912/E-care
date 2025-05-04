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

      <title>Forgot Password</title>
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

         .alert-success {
         background-color: #d4edda;
         color: #155724;
         border: 1px solid #c3e6cb;
         margin-left: 40%;
         
         width: 300px;
         }

         .alert-danger {
         background-color: #f8d7da;
         color: #721c24;
         border: 1px solid #f5c6cb;
         width: 55%;
         margin-left: 20%;
         
         }
         </style>
   </head>

   <body>

      <!-- Error Message -->
      <!-- the error here is if the email is not registered -->
      <?php if (isset($data['error'])): ?>
         <div id="errorMessage" class="alert alert-danger">
         <?= htmlspecialchars($data['error']); ?>
         </div>
         <?php unset($data['error']); ?>
      <?php endif; ?>

      <!-- Success Message -->
      <?php if (isset($data['success'])): ?>
         <div id="successMessage" class="alert alert-success">
            <?= htmlspecialchars($data['success']); ?>
         </div>
         <?php unset($data['success']); ?>
      <?php endif; ?>

      <!-- <?php 
         if(isset($data['error'])){
               show($data['error']);
         }
      ?> -->

      <div class="main-context">

         <h1>Welcome to E-Care by Union Hospital</h1>
         <?php if (!empty($errors['email'])) : ?>
            <div class="error"><?php echo $errors['email']; ?></div>
         <?php endif; ?>

         <div class="container">
            <center>
               <h3>Reset Password</h3>
               <p class="signIntext">Please enter your email to reset your password</p>
            </center>
            <br>

            <form method="POST" action="<?=ROOT?>/ForgotPassword" onsubmit="return confirmReset()">

               <div class="form-group">
                  <label for="">Email <span style="color: red;">*</span></label>
                  <input type="email" class="email" name="email" value="" placeholder="Enter your email">
               </div>

               <input type="submit" value="Reset" class="signInBtn">

            </form>

         </div>

      </div>
      <script>
         function confirmReset(){
            document.addEventListener("DOMContentLoaded", function() {
            const successMessage = document.getElementById("successMessage");
            const errorMessage = document.getElementById("errorMessage");
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = "none";
                  }, 5000);
               }
            if (errorMessage) {
                setTimeout(() => {
                    errorMessage.style.display = "none";
                }, 5000);
            }
        });
         }
      </script>

   </body>

</html>