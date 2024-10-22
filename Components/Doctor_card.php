<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Doctor Card</title>
        <link rel="stylesheet" href="../Style/doctor_card.css"> <!-- Linking to external CSS file -->
    </head>

    <body>
        <div class="doctor-card">
            <div class="doctor-img">
                <img src="../assets/profilepic.png" alt="Profile Picture" />
            </div>
            <p class="doctor-gender">Gender: Male</p>
            <h3 class="doctor-name">Dr.Sathan </h3>
            <button class="profile-btn" onclick="viewProfile()">View Profile</button>
            <button class="channel-btn" onclick="channelDoctor()">Channel Now</button>
        </div>
               <!--
        <script>
            function viewProfile() {
                alert('Viewing Profile...');
                // Add JavaScript code to navigate or show doctor profile
            }

            function channelDoctor() {
                alert('Channeling Doctor...');
                // Add JavaScript code to channel the doctor
            }
        </script>
        -->
    </body>

    </html>