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
</head>

<body>


   <div class="main-context">

      <h1>Welcome to E-Care by Union Hospital</h1>
      <?php if (!empty($errors['email'])) : ?>
            <div class="error"><?php echo $errors['email']; ?></div>
      <?php endif; ?>

      <div class="container">
         <center>
            <h3>Sign In</h3>
            <p class="signIntext">Please enter your email and password to login</p>
         </center>
         <br>

         <form method="POST">

            <div class="form-group">
               <label for="">Email <span style="color: red;">*</span></label>
               <input type="email" class="email" name="email" value="" placeholder="Enter your email">


            </div>

            <div class="form-group">
               <label for="">Password <span style="color: red;">*</span></label>
               <input type="password" name="password" class="password" value="" placeholder="Enter Your Password">

            </div>

            <input type="checkbox" class="signedIncheckbox">
            <label for="" class="signedInstatement">Keep me signed in</label>

            <input type="submit" value="Sign In" class="signInBtn">

         </form>

         <p class="noAccount">Don't have an account? <a href="<?php echo ROOT ?>/Signin">Sign Up</a></p>
         
      </div>
      
   </div>
   
</body>

</html>