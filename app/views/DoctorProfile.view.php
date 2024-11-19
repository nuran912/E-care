<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/Doctorprofilepage.css">
    <title>Doctor Profile</title>
</head>

<body>
    <div class="main-container">
        <div class="welcome-section">
            <h1>Welcome to Dr. <?= $doctor->name ?>'s Profile</h1>
        </div>

        <div class="container">
            <div class="profile-card">
                <div class="profile-image">
                    <img src="../assets/profilepic.png" alt="">
                </div>
                <div class="profile-info">
                    <h6><?= $gender?></h6>
                    <h2>Dr. <?= $name ?></h2>
                    <h5 class="specialization"><?= is_array($specialization) ? join(", ", $specialization) : $specialization ?></h5>
                    
                </div>
                <a href="<?php echo ROOT; ?>/DoctorAvailableTimes?id=<?= $doctorId ?>">
                <button class="channel-now-btn">Channel Now</button>
            </a>
            </div>

            <div class="details-card">
                <div class="details-grid">
                    <div class="detail-item">
                        <h3>Other Qualifications</h3>
                        <p><?= $other_qualifications ?? 'NA' ?></p>
                    </div>

                    <div class="detail-item">
                        <h3>Registration Number</h3>
                        <p><?= $registration_number ?></p>
                    </div>

                    <div class="detail-item">
                        <h3>Practicing Government Hospitals</h3>
                        <div class="status-indicator <?= $practicing_government_hospitals ? 'active' : 'inactive' ?>">
                            <span class="status-tick"><?= $practicing_government_hospitals ? '&#10003;' : '&#10007;' ?></span>
                        </div>
                    </div>
                    </div>

                    <div class="detail-item">
                        <h3>Special Note</h3>
                        <p><?= $special_note ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>