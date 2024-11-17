<?php
$email = $password = "";

$errors = array('email' => '', 'password' => '');

if (isset($_POST['signIn'])) {

   //check email (validity)
   if (empty($_POST['email'])) {
      $errors['email'] = "Email is required";
   } else {
      $email = $_POST['email'];
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $errors['email'] = 'Email must be a valid email address';
      }
   }

   //check password(vaidity)
   if (empty($_POST['password'])) {
      $errors['password'] = "Password is required";
   } else {
      $password = $_POST['password'];
      if (strlen($password) < 8) {
         $errors['password'] = "Password must be at least 8 characters long";
      } elseif (!preg_match('/[A-Z]/', $password)) {
         $errors['password'] = "Password must contain at least one uppercase letter";
      } elseif (!preg_match('/[a-z]/', $password)) {
         $errors['password'] = "Password must contain at least one lowercase letter";
      } elseif (!preg_match('/\d/', $password)) {
         $errors['password'] = "Password must contain at least one numeric digit";
      } elseif (!preg_match('/[\W_]/', $password)) {
         $errors['password'] = "Password must contain at least one special character (e.g., !@#$%^&*)";
      }
   }
}

// if(array_filter($errors)) {
//     //form has errors
// }
// else{
//     header('Location: ../index.php');
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>E-Care Sign In</title>
   <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/sign-in.css">
</head>

<body>


   <div class="main-context">

      <h1>Welcome to E-Care by Union Hospital</h1>

      <div class="container">
         <h3>Sign In</h3>
         <p class="signIntext">Please enter your email and password to login</p>

         <form method="POST">

            <div class="form-group">
               <label for="">Email</label>
               <input type="text" class="email" name="email" placeholder="Enter your Email" value="<?php echo htmlspecialchars($email) ?>">
               <div class="error"><?php echo $errors['email']; ?></div>
            </div>

            <div class="form-group">
               <label for="">Password</label>
               <input type="text" class="password" name="password" placeholder="Enter your password" value="<?php echo htmlspecialchars($password) ?>">
               <div class="error"><?php echo $errors['password']; ?></div><br />
            </div>

            <input type="checkbox" class="signedIncheckbox">
            <label for="" class="signedInstatement">Keep me signed in</label>

            <input type="submit" name="signIn" value="Sign In" class="signInBtn">

         </form>

         <p class="noAccount">Don't have an account? <a href="SignUp.php">Sign Up</a></p>

      </div>
   </div>

</body>

</html>