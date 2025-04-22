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

      <!-- Success Message -->
      <?php if (isset($data['success'])): ?>
         <div id="successMessage" class="alert alert-success">
            <?= htmlspecialchars($data['success']); ?>
         </div>
         <?php unset($data['success']); ?>
      <?php endif; ?>

      <!-- Error Message -->
      <?php if (isset($data['error'])): ?>
         <div id="errorMessage" class="alert alert-danger">
         <?= htmlspecialchars($data['error']); ?>
         </div>
         <?php unset($data['error']); ?>
      <?php endif; ?>   

    <?php
        //if the token is invalid, redirect to error page
        if(!$_SESSION['tokenValid']){
           redirect('404'); 
        }   
    ?>

   <div class="main-context">

      <h1>Welcome to E-Care by Union Hospital</h1>
      <?php if (!empty($errors['email'])) : ?>
         <div class="error"><?php echo $errors['email']; ?></div>
      <?php endif; ?>

      <div class="container">
         <center>
            <h3>Reset Password</h3>
            <p class="signIntext">Please enter your new password</p>
         </center>
         <br>

         <form method="POST" action="<?=ROOT?>/ForgotPassword/validateToken/recover" onSubmit>
            <div class="form-group">
               <label for="">New Password <span style="color: red;">*</span></label>
               <input type="password" name="newPassword" class="password" value="" placeholder="New Password">
            </div>
            <div class="form-group">
               <label for="">Confirm  New Password <span style="color: red;">*</span></label>
               <input type="password" name="confirmPassword" class="password" value="" placeholder="Confirm Password">
            </div>

            <input type="submit" value="Reset" class="signInBtn">
         </form>

      </div>

   </div>

   <script>
         // Auto-hide success/error messages after 5 seconds
        document.addEventListener("DOMContentLoaded", function() {
            const successMessage = document.getElementById("successMessage");
            const errorMessage = document.getElementById("errorMessage");
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = "none";
                    //redirect after the success message disappears
                    window.location.href = "<?php echo ROOT ?>/signin";
                  }, 3000);
               }
               if (errorMessage) {
                  setTimeout(() => {
                     errorMessage.style.display = "none";
                  }, 5000);
               }
            });
   </script>
</body>

</html>