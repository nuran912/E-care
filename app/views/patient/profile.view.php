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
    </style>
</head>
<body>
    <div class="container">
        <!-- Profile Card Section -->
        <div class="profileCard">
            <div class="profilePic">
                <img src="" alt="Profile Picture">
            </div>
            <div class="profileDesc">
                <h3><?=$data[0]->name?></h3>
                <h4><?=$data[0]->email?></h4>
            </div>
        </div>

        <!-- Profile Info Section -->
        <div class="profileInfo">
            
            <?php if (!empty($data['error'])): ?>
                <div class="error">
                    <?php foreach ($data['error'] as $error): ?>
                        <p><?=$error?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if ($data['success'] != "" ): ?>
                <div class="success">
                        <p><?=$data['success']?></p>
                </div>
            <?php endif; ?>
            <?php if ($data['passUpdateError'] != "" ): ?>
                <div class="error">
                        <p><?=$data['passUpdateError']?></p>
                </div>
            <?php endif; ?>
            <?php if ($data['passUpdateSuccess'] != "" ): ?>
                <div class="success">
                        <p><?=$data['passUpdateSuccess']?></p>
                </div>
            <?php endif; ?> 

            <form method="POST" action="<?= ROOT?>/Patient/insuranceclaims/submit">
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
                        <button type="submit">Save Changes</button>
                        <button type="reset">Reset</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>
