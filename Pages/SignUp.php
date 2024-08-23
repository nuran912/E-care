<?php

    $firstName = $lastName = $email = $phoneNumber = $NIC_Passport = $password = $confirmPassword = "";

    $errors = array('firstName'=>'','lastName'=>'','email'=>'',
                    'phoneNumber'=>'','NIC_Passport'=>'','password'=>'',
                    'confirmPassword'=>'','terms'=>'');

    if(isset($_POST['signUp'])) {

        //check firstName
        if(empty($_POST['firstName'])) {
            $errors['firstName'] = "First name is required";
        }
        else {
            $firstName = $_POST['firstName'];
            if(!preg_match('/^[a-zA-Z\s]+$/',$firstName)) {
                $errors['firstName'] = "First Name must be letters and spaces";
            }
        }

        //check lastName
        if(empty($_POST['lastName'])) {
            $errors['lastName'] = "Last name is required";
        }
        else {
            $lastName = $_POST['lastName'];
            if(!preg_match('/^[a-zA-Z\s]+$/',$firstName)) {
                $errors['lastName'] = "last Name must be letters and spaces";
            }
        }

        //check email
        if(empty($_POST['email'])) {
            $errors['email'] = "Email is required";
        }
        else {
            $email = $_POST['email'];
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email must be a valid email address';
            }
        }

        //check phoneNumber
        if(empty($_POST['phoneNumber'])) {
            $errors['phoneNumber'] = "Phone number is required";
        }
        else {
            $phoneNumber = $_POST['phoneNumber'];
            if(!preg_match('/^(?:\+94\s?|0)(7[0-9]|[1-9][0-9])\s?[0-9]{3}\s?[0-9]{4}$/',$phoneNumber)) {
                $errors['phoneNumber'] = "Invalid phone number format";
            }
        }

        //check NIC/Passport
        if(empty($_POST['NIC_Passport'])) {
            $errors['NIC_Passport'] = "NIC number/Passport number is required";
        }
        else {
            $NIC_Passport = $_POST['NIC_Passport'];
            if(!preg_match('/^\d{9}V$/',$NIC_Passport) && !preg_match('/^\d{12}$/',$NIC_Passport)) {
                if(!preg_match('/^[A-Z][0-9]{7,8}$/',$NIC_Passport)) {
                    $errors['NIC_Passport'] = "Invalid NIC or Passport number";
                }
            }
            
        }

        //check password
        if(empty($_POST['password'])) {
            $errors['password'] = "Password is required";
        }
        else {
            $password = $_POST['password'];
            if(strlen($password) < 8) {
                $errors['password'] = "Password must be at least 8 characters long";
            }
            elseif(!preg_match('/[A-Z]/',$password)) {
                $errors['password'] = "Password must contain at least one uppercase letter";
            }
            elseif(!preg_match('/[a-z]/',$password)) {
                $errors['password'] = "Password must contain at least one lowercase letter";
            }
            elseif(!preg_match('/\d/',$password)) {
                $errors['password'] = "Password must contain at least one numeric digit";
            }
            elseif(!preg_match('/[\W_]/',$password)) {
                $errors['password'] = "Password must contain at least one special character (e.g., !@#$%^&*)";
            }
        }

        //check confirm password
        if(empty($_POST['confirmPassword'])) {
            $errors['confirmPassword'] = "Confirm Password is required";
        }
        else {
            $confirmPassword = $_POST['confirmPassword'];
            if($password != $confirmPassword) {
                $errors['confirmPassword'] = "Passwords do not match";
            }
        }

        //check whether agreed on terms & conditions\
        if(!isset($_POST['terms'])) {
            $errors['terms'] = "You must agree to the terms and conditions";
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
<html>
    <head>
        <title>E-Care Sign Up</title>
        <link rel="stylesheet" href="../Style/SignUp.css">
    </head>
    <body>
        <?php include '../Components/Header.php'; ?>

        <div class="main-context">
            
            <h1>Welcome to E-Care by Union Hospital</h1>

            <div class="container">
                <p class="signUptext">Please fill the following form fields.</p><br/>

                <form action="SignUp.php" method="POST">

                    <div class="form-row">

                        <div class="form-group">
                            <label for="">Title</label>
                            <select name="title" class="title">
                                <option value="Mr">Mr</option>
                                <option value="Ms">Ms</option>
                                <option value="Mrs">Mrs</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">First Name <span style="color: red;">*</span></label>
                            <input type="text" name="firstName" value="<?php echo htmlspecialchars($firstName)?>">
                            <div class="error"><?php echo $errors['firstName']; ?></div>
                        </div>

                        <div class="form-group">
                            <label for="">Last Name <span style="color: red;">*</span></label>
                            <input type="text" name="lastName" value="<?php echo htmlspecialchars($lastName)?>">
                            <div class="error"><?php echo $errors['lastName']; ?></div>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group">
                            <label for="">Email <span style="color: red;">*</span></label>
                            <input type="text" name="email" value="<?php echo htmlspecialchars($email)?>">
                            <div class="error"><?php echo $errors['email']; ?></div>
                        </div>

                        <div class="form-group">
                            <label for="">Phone number <span style="color: red;">*</span></label>
                            <input type="tel" name="phoneNumber" value="<?php echo htmlspecialchars($phoneNumber)?>">
                            <div class="error"><?php echo $errors['phoneNumber']; ?></div>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group">
                            <label for="">NIC Number/Passport <span style="color: red;">*</span></label>
                            <input type="text" name="NIC_Passport" value="<?php echo htmlspecialchars($NIC_Passport)?>">
                            <div class="error"><?php echo $errors['NIC_Passport']; ?></div>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group">
                            <label for="">Password <span style="color: red;">*</span></label>
                            <input type="password" name="password" value="<?php echo htmlspecialchars($password)?>">
                            <div class="error"><?php echo $errors['password']; ?></div>
                        </div>

                        <div class="form-group">
                            <label for="">Confirm Password <span style="color: red;">*</span></label>
                            <input type="password" name="confirmPassword" value="<?php echo htmlspecialchars($confirmPassword)?>">
                            <div class="error"><?php echo $errors['confirmPassword']; ?></div>
                        </div>

                    </div>

                    <div class="form-row">
                        <input type="checkbox" name="terms" class="terms">
                        <label for="" class="termsagreement">I agree to the <a href="#" class="termsConditions">terms and conditions</a></label>
                        <div class="error"><?php echo $errors['terms'];?></div>
                    </div>

                    <input type="submit" name="signUp" value="Sign Up" class="signUpBtn">

                </form>
            </div>
        </div>

        <?php include '../Components/Footer.php'; ?>

    </body>
</html>

