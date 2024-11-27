<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
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
            width: 150px;
            font-weight: bold;
            color: #0E2F56;
            margin-right: 20px;
            text-align: left;
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

        input[type="submit"] {
            background-color: #0E2F56;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            padding: 12px;
            border-radius: 8px;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #0a2340;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Profile Card Section -->
        <div class="profileCard">
            <div class="profilePic">
                <img src="https://via.placeholder.com/150" alt="Profile Picture">
            </div>
            <div class="profileDesc">
                <h3>Dr. John Doe</h3>
                <h3>Cardiologist</h3>
                <h4>Specialist</h4>
            </div>
        </div>

        <!-- Profile Info Section -->
        <div class="profileInfo">
            <form>
                <div class="info">
                    <label for="name">Name :</label>
                    <input type="text" id="name" placeholder="John Doe">
                </div>
                <div class="info">
                    <label for="empId">Employee Number:</label>
                    <input type="text" id="empId" placeholder="Enter your employee ID">
                </div>
                <div class="info">
                    <label for="specialization">Specialization :</label>
                    <input type="text" id="specialization" placeholder="Enter your specialization">
                </div>
                <div class="info">
                    <label for="qualifications">Qualifications :</label>
                    <input type="text" id="qualifications" placeholder="Enter your qualifications">
                </div>
                <div class="info">
                    <label for="id">NIC/Passport :</label>
                    <input type="text" id="id" placeholder="Enter your identification">
                </div>
                <div class="info">
                    <label for="contact">Contact Number :</label>
                    <input type="text" id="contact" placeholder="Enter your contact">
                </div>
                <div class="info">
                    <label for="email">Email :</label>
                    <input type="email" id="email" placeholder="johndoe@example.com">
                </div>
                <div class="info">
                    <label for="password">Password :</label>
                    <input type="password" id="password" placeholder="******">
                </div>
                <div class="info">
                    <label for="newpassword">New Password :</label>
                    <input type="password" id="newpassword" placeholder="Enter your new password">
                </div>
                <div class="info">
                    <input type="submit" value="Save Changes">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
