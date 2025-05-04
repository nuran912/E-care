<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - E-care</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/homa.css">
</head>

<body>

    <!-- Header has added using Home controller -->

    <div class="welcome">
        <div class="welcome-content">
            <h2>Welcome <?= $username; ?></h2>
            <img src="<?php echo ROOT ?>/assets/img/home-img/e-care.svg" alt="doctor"><br>
            <img src="<?php echo ROOT ?>/assets/img/home-img/union-hospital.svg" alt="e-care">
            <p>“ Your Health, Simplified. Anytime, Anywhere with E-care. ”</p>
        </div>
        <img src="<?php echo ROOT ?>/assets/img/home-img/hospital.svg" alt="hospital">
    </div>

    <div class="choose">
        <h1>Why Choose Us</h1>
        <div class="choose-cards">
            <div class="card">
                <img src="<?php echo ROOT ?>/assets/img/home-img/choose/doctor.svg" alt="doctor">
                <div>
                    <h3>DOCTOR CONSULTATION</h3>
                    <p>Reserve consultations with
                        registered doctors and get the
                        best recommendations</p>
                </div>
            </div>
            <div class="card">
                <img src="<?php echo ROOT ?>/assets/img/home-img/choose/appoint.svg" alt="medical-history">
                <div>
                    <h3>MANAGE APPOINTMENT</h3>
                    <p>Doctors can manage their
                        appointment schedule and
                        past/current patients</p>
                </div>
            </div>
            <div class="card">
                <img src="<?php echo ROOT ?>/assets/img/home-img/choose/record.svg" alt="medical-history">
                <div>
                    <h3>E-HEALTH RECORDS</h3>
                    <p>Track and save your medical
                        history and health data within
                        the platform.</p>
                </div>
            </div>
            <div class="card">
                <img src="<?php echo ROOT ?>/assets/img/home-img/choose/file.svg" alt="medical-history">
                <div>
                    <h3>INSURANCE FILING</h3>
                    <p>Convenient and secure way to file
                        insurance claims with authentic
                        medical documents.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="service">
        <h1>Our Services</h1>
        <div class="service-cards">
            <div class="card">
                <div class="header">
                    <img src="<?php echo ROOT ?>/assets/img/home-img/service/hospital.svg" alt="hospital">
                    <h2>Union Health Network</h2>
                </div>
                <div>
                    <button><a href="<?= ROOT ?>/Hospitals">UNION MEDICAL</a></button>
                    <button><a href="<?= ROOT ?>/Hospitals">UNION CENTRAL</a></button>
                    <button><a href="<?= ROOT ?>/Hospitals">UNION SURGICAL</a></button>
                </div>
            </div>
            <div class="card">
                <div class="header">
                    <img src="<?php echo ROOT ?>/assets/img/home-img/service/lab.svg" alt="lab">
                    <h2>Union Laboratories</h2>
                </div>
                <div>
                    <button><a href="<?= ROOT ?>/Laboratories">RAJAGIRIYA</a></button>
                    <button><a href="<?= ROOT ?>/Laboratories">BAMBALAPITIYA</a></button>
                    <button><a href="<?= ROOT ?>/Laboratories">DEHIWALA</a></button>
                </div>
            </div>
        </div>
    </div>

    <div class="channel">
        <h1>Your Well-being Starts Here</h1>
        <h3>Schedule Your Appointment Today!</h3>
        <button><a href="<?= ROOT?>/appointmentsearchpage" style="text-decoration:none; color:aliceblue;">Channel Now</a></button>
    </div>


    <div class="articles">
        <h1>Recent Articles</h1>
        
        <?php if (isset($articles) && is_array($articles)): ?>
            <div class="cards">
                <?php foreach ($articles as $article): ?>
                    <div class="card">
                        <div class="article-img"><img src="<?php echo htmlspecialchars($article['image_url']); ?>" ></div>
                        <p><?php echo htmlspecialchars($article['publish_date']) ?></p>
                        <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                        <a href="<?= ROOT?>/Articles">See more</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No Articles found.</p>
        <?php endif; ?>
    </div>

</html>
<!-- Footer has added using the Home controller -->

<!-- <script src="<?php echo ROOT ?>/assets/js/home.js"></script> -->
</body>

</html>