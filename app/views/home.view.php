<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - E-care</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/landing.css">
</head>

<body>

    <!-- Header has added using Home controller -->

    <div class="welcome">
        <div class="welcome-content">
            <h2>Welcome to</h2>
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
                    <button><a href="#">UNION MEDICAL</a></button>
                    <button><a href="#">UNION CENTRAL</a></button>
                    <button><a href="#">UNION SURGICAL</a></button>
                </div>
            </div>
            <div class="card">
                <div class="header">
                    <img src="<?php echo ROOT ?>/assets/img/home-img/service/lab.svg" alt="lab">
                    <h2>Union Laboratories</h2>
                </div>
                <div>
                    <button><a href="#">RAJAGIRIYA</a></button>
                    <button><a href="#">BAMBALAPITIYA</a></button>
                    <button><a href="#">DEHIWALA</a></button>
                </div>
            </div>
        </div>
    </div>

    <section>
        <h2>Your well-being starts here</h2>
        <button>Channel Now</button>
    </section>

    <section>
        <h2>Our Insurance Partners</h2>
        <div class="cards">
            <div class="card">Partner 1</div>
            <div class="card">Partner 2</div>
            <div class="card">Partner 3</div>
            <div class="card">Partner 4</div>
        </div>
    </section>

    <section>
        <h2>Recent Articles</h2>
        <div class="cards">
            <div class="card">Article 1</div>
            <div class="card">Article 2</div>
            <div class="card">Article 3</div>
        </div>
    </section>

    <!-- Footer has added using the Home controller -->

    <!-- <script src="<?php echo ROOT ?>/assets/js/home.js"></script> -->
</body>

</html>