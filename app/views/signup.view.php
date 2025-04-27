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
    <title>E-Care Sign Up</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/sign-up.css">

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

    <?php
    
        if(isset($_SESSION['registerData'])){
            $values = $_SESSION['registerData'];
        }else{
            $values['title'] = "";
            $values['name'] = "";
            $values['email'] = "";
            $values['phone_number'] = "";
            $values['NIC'] = "";
            $values['password'] = "";
            $values['confirmPassword'] = "";
        }
        // show($_SESSION);
        // show($data['errors']['exist']);
    ?>

    <!-- Error Message -->
   <?php if (isset($data['errors']['exist'])): ?>
         <div id="errorMessage" class="alert alert-danger">
            <?= $data['errors']['exist']; ?>
         </div>
         <?php unset($data['errors']['exist']); ?>
      <?php endif; ?> 

    <div class="main-context">

        <h1>Welcome to E-Care by Union Hospital</h1>
<!-- 
        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?> -->
        <div class="container">
            <center>
                <h3>Register an Account</h3>
                <p class="signUptext">Please fill the following form fields.</p>
            </center>
            <br />

            <form method="POST">

                <div class="form-row">

                    <div class="form-group">
                        <label for="">Title<span style="color: red;">*</span></label>
                        <select name="title" class="title" required >
                            <option value="<?=$values['title']?>" selected><?=$values['title']?></option> 
                            <option value="Mr.">Mr</option>
                            <option value="Ms.">Ms</option>
                            <option value="Mrs.">Mrs</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Full Name <span style="color: red;">*</span></label>
                        <input type="text" name="name" required value="<?=$values['name']?>" >
                        <?php if (!empty($errors['name'])) : ?>
                            <div class="error"><?php echo $errors['name']; ?></div>
                        <?php endif; ?>
                    </div>



                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label for="">Email <span style="color: red;">*</span></label>
                        <input type="text" name="email" required value=<?=$values['email']?> >
                        <?php if (!empty($errors['email'])) : ?>
                            <div class="error"><?php echo $errors['email']; ?></div>
                        <?php endif; ?>

                    </div>

                    <div class="form-group">
                        <label for="">Phone number <span style="color: red;">*</span></label>
                        <input type="tel" name="phone_number" required value=<?=$values['phone_number']?> >
                        <?php if (!empty($errors['phone_number'])) : ?>
                            <div class="error"><?php echo $errors['phone_number']; ?></div>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label for="">NIC Number <span style="color: red;">*</span></label>
                        <input type="text" name="NIC" required value=<?=$values['NIC']?> >
                        <?php if (!empty($errors['NIC'])) : ?>
                            <div class="error"><?php echo $errors['NIC']; ?></div>
                        <?php endif; ?>
                    </div>

                </div>
                <br>

                <div class="form-row">
                    <div class="form-group">
                        <label for="">Password <span style="color: red;">*</span></label>
                        <input type="password" name="password" required value=<?=$values['password']?> >
                        <?php if (!empty($errors['password'])) : ?>
                            <div class="error"><?php echo $errors['password']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="">Confirm Password <span style="color: red;">*</span></label>
                        <input type="password" name="confirmPassword" required value=<?=$values['confirmPassword']?> >
                        <?php if (!empty($errors['confirmPassword'])) : ?>
                            <div class="error"><?php echo $errors['confirmPassword']; ?></div>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="form-row">
                        <input type="checkbox" name="terms" required class="terms" <?php if(isset($values['terms'])){if($values['terms'] == 'on'){ echo "checked"; }}?> >
                        <div style="display: flex; flex-direction:column; gap:0px;">
                            <label for="" class="termsagreement">I agree to the <a href="<?= ROOT ?>/termsAndConditions" class="termsConditions">terms and conditions</a></label>
                            <?php if (!empty($errors['terms'])) : ?>
                                <div class="error" style="margin-left: 20px;"><br><?php echo $errors['terms']; ?></div>
                                <?php endif; ?>
                        </div>
                </div>
                            
                <input type="submit" value="Sign Up" class="signUpBtn">

            </form>

            <div class="signin">
                <p>Already have an account? <a href="<?php echo ROOT ?>/Signin">Sign In</a></p>
            </div>
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