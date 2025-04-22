<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/Doctorprofilepage.css"> -->
    <title>Patient Profile</title>
    <style>
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            background-color: #f3f6fa;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: flex-start;
            margin: 7.5%;
            padding: 5%;
            background-color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            gap: 5%;
        }

        .profileCard {
            background-color: #0E2F56;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 50px 40px;
            margin-bottom: 50px;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profileCard:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .profilePic img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 20px;
            border: 4px solid #fff;
            background-color: #93DEFF;
        }

        .profileDesc h3, .profileDesc h4 {
            text-align: center;
            margin: 5px 0;
        }

        .profileInfo {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            flex: 1;
            margin-left: 30px;
        }

        .profileInfo form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        label {
            width: 160px;
            font-weight: bold;
            color: #0E2F56;
            margin-right: 20px;
            text-align: left;
        }

        .pw-desc{
            color: #0E2F56;
            margin-top: 0;
        }
        p {
            color: #0E2F56;
            /* margin-top: 0; */
        }

        input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #0E2F56;
            box-shadow: 0 0 8px rgba(14, 47, 86, 0.2);
            outline: none;
        }

        input::placeholder {
            color: #bbb;
        }

        button {
            background-color: #0E2F56;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            padding: 12px;
            border-radius: 8px;
            margin-top: 20px;
            width: 35%;
            font-size:medium;
        }

        button:hover {
            background-color: #0a2340;
        }

        button[type="reset"]{
            background-color: #dc3545;
        }
        button[type="reset"]:hover{
            background-color: #c82333;
        }

        .buttons {
            display: flex;
            flex-grow: 1;
            flex-direction: row;
            justify-content: center;
            gap: 50px;
        }

        .alert {
            padding: 16px;
            margin-bottom: 16px;
            border-radius: 4px;
            font-family: Arial, sans-serif;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .error {
            position:relative;
            /* background-color: darkred; */
            /* border-color: #c82333; */
            color: white;
            border: 3px red solid;
            padding: 5px;
            border-radius: 10px;
            font-size: 14px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* width: 200px; */
            justify-content: center;
            align-items: center;
            display: flex;
            margin: auto;
            margin-top: 10px;
            margin-bottom: 10px;
            text-align: center;
            /* z-index: 1000; */
        }

        .success {
            position:relative;
            /* background-color: green; */
            /* border-color: lightgreen; */
            color: white;
            border: 3px lightgreen solid;
            padding: 5px;
            border-radius: 10px;
            font-size: 14px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* width: 200px; */
            justify-content: center;
            align-items: center;
            display: flex;
            margin: auto;
            margin-top: 10px;
            margin-bottom: 10px;
            text-align: center;
            /* z-index: 1000; */
        }

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
    <?php if (isset($_SESSION['success'])): ?>
         <div id="successMessage" class="alert alert-success">
            <?= htmlspecialchars($_SESSION['success']); ?>
         </div>
         <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Error Message -->
    <?php if (isset($_SESSION['error'])): ?>
         <div id="errorMessage" class="alert alert-danger">
         <?php foreach ($_SESSION['error'] as $error): ?>
            <?= htmlspecialchars($error); ?>
        <?php endforeach; ?>
         </div>
         <?php unset($_SESSION['error']); ?>
      <?php endif; ?> 

    <!--Password update Success Message -->
    <?php if (isset($_SESSION['passUpdateSuccess'])): ?>
         <div id="passSuccessMessage" class="alert alert-success">
            <?= htmlspecialchars($_SESSION['passUpdateSuccess']); ?>
         </div>
         <?php unset($_SESSION['passUpdateSuccess']); ?>
    <?php endif; ?>

    <!--Password update Error Message -->
    <?php if (isset($_SESSION['passUpdateError'])): ?>
         <div id="passErrorMessage" class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['passUpdateError']); ?>
         </div>
         <?php unset($_SESSION['passUpdateError']); ?>
    <?php endif; ?>

    <div class="container">
        <!-- Profile Card Section -->
        <div class="profileCard">

            <form method="POST" enctype="multipart/form-data" action="<?= ROOT; ?>/Patient/profile">
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['USER']->user_id) ?>">
                <input type="file" name="profile-pic" id="user-image" accept="image/*" hidden>
            </form>
            
            <div class="profilePic">
                <img src="<?= $data['profilePic'] ?>" alt="Profile Picture" id="image-preview" onclick="document.getElementById('user-image').click();">
            </div>

            <div class="profileDesc">
                <h3><?=$data[0]->name?></h3>
                <h4><?=$data[0]->email?></h4>
            </div>
        </div>

        <!-- Profile Info Section -->
        <div class="profileInfo">
    

            <form method="POST" action="<?= ROOT?>/Patient/profile/update">
                <div class="info">
                    <label for="name">Name :</label>
                    <input type="text" name="name" id="name" value="<?=$data[0]->name?>">
                </div>
                <div class="info">
                    <label for="id">NIC : </label>
                    <input type="text" name="NIC" id="id" placeholder="Enter your identification" value="<?=$data[0]->NIC?>">
                </div>
                <div class="info">
                    <label for="contact">Contact Number :</label>
                    <input type="text" name="phone_number" id="contact" placeholder="Enter your contact" value="<?=$data[0]->phone_number?>">
                </div>
                <div class="info">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" placeholder="johndoe@example.com" value="<?=$data[0]->email?>">
                </div>
                <br/>
                <div class="info">
                    <label for="password">Current Password :</label>
                    <input type="password" name="password" id="password" placeholder="Enter your current password">
                </div>
                <div class="info" style="margin-bottom: 0;">
                    <label for="newpassword">New Password :</label>
                    <input type="password" name="newpassword" id="newpassword" placeholder="Enter your new password">
                </div>
                <p class="pw-desc">(Enter current password to change the password)</p>
                <div class="info">
                    <div class="buttons">
                        <button type="submit" name="update">Save Changes</button>
                        <button type="reset">Reset</button>
                    </div>
                </div>  
            </form>
        </div>
    </div>

    <script>
        document.getElementById('user-image').addEventListener('change',function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('image-preview').src = e.target.result;
                }
                reader.readAsDataURL(file);

                this.form.submit();
            }
        });
        
         // Auto-hide success/error messages after 5 seconds
        document.addEventListener("DOMContentLoaded", function() {
            const successMessage = document.getElementById("successMessage");
            const errorMessage = document.getElementById("errorMessage");
            const passSuccessMessage = document.getElementById("passSuccessMessage");
            const passErrorMessage = document.getElementById("passErrorMessage");
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = "none";
                    // window.location.href = "<?php echo ROOT ?>/Patient/profile";
                  }, 5000);
               }
               if (errorMessage) {
                  setTimeout(() => {
                     errorMessage.style.display = "none";
                  }, 5000);
               }
               if (passSuccessMessage) {
                  setTimeout(() => {
                    passSuccessMessage.style.display = "none";
                  }, 5000);
               }
               if (passErrorMessage) {
                  setTimeout(() => {
                    passErrorMessage.style.display = "none";
                  }, 5000);
               }
            });
   </script>
</body>
</html>

