<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pending Appointments/Past Appointments</title>
        <link rel="stylesheet" href="../Style/PendingPastAppointments.css">
    </head>

    <?php include '../Components/Header.php'; ?>

    <body>
        <main>
            <div class="container">
                <div class="tab-box">
                    <button class="tab-button active">Pending Appointments</button>
                    <button class="tab-button">Past Appointments</button>
                    <div class="line"></div>
                </div>

                <div class="content-box">

                    <!-- Pending Appointments Section -->
                    <div class="content active">
                        <div class="appointment-date">14 / 08 / 2024</div>
                        <div class="appointment">
                            <span class="doctor">Dr. A Jonathan</span>
                            <span class="ref-no">Ref no: 004</span>
                            <span class="time">16:30</span>
                            <button class="view-button">View</button>
                            <span class="hospital">Union Surgical Hospital</span>
                            <span class="specialization">Neurologist</span>
                            <button class="cancel-button">Cancel</button>
                        </div>

                        <div class="appointment-date">14 / 08 / 2024</div>
                        <div class="appointment">
                            <span class="doctor">Dr. A Jonathan</span>
                            <span class="ref-no">Ref no: 004</span>
                            <span class="time">16:30</span>
                            <button class="view-button">View</button>
                            <span class="hospital">Union Surgical Hospital</span>
                            <span class="specialization">Neurologist</span>
                            <button class="cancel-button">Cancel</button>
                        </div>
                    </div>

                    <!-- Past Appointments Section -->
                    <div class="content">
                        <div class="appointment-date">18 / 08 / 2024</div>
                        <div class="appointment">
                            <span class="doctor">Dr. A W Fernando</span>
                            <span class="ref-no">Ref no: 004</span>
                            <span class="hospital">Union Surgical Hospital</span>
                            <span class="specialization">Neurologist</span>
                            <button class="past-view-button">View</button>
                        </div>

                        <div class="appointment">
                            <span class="doctor">Dr. A W Fernando</span>
                            <span class="ref-no">Ref no: 004</span>
                            <span class="hospital">Union Surgical Hospital</span>
                            <span class="specialization">Neurologist</span>
                            <button class="past-view-button">View</button>
                        </div>

                        <div class="appointment-date">18 / 08 / 2024</div>
                        <div class="appointment">
                            <span class="doctor">Dr. A W Fernando</span>
                            <span class="ref-no">Ref no: 004</span>
                            <span class="hospital">Union Surgical Hospital</span>
                            <span class="specialization">Neurologist</span>
                            <button class="past-view-button">View</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                const tabs = document.querySelectorAll('.tab-button');
                const all_content = document.querySelectorAll('.content');

                tabs.forEach((tab,index) => {
                    tab.addEventListener('click',(e) => {
                        tabs.forEach(tab => {tab.classList.remove('active')});
                        tab.classList.add('active');

                        var line = document.querySelector('.line');
                        line.style.width = e.target.offsetWidth + "px";
                        line.style.left = e.target.offsetLeft + "px";

                        all_content.forEach(content => {content.classList.remove('active')});
                        all_content[index].classList.add('active');
                    });
                });
            </script>
        </main>
    </body>


    <?php include '../Components/Footer.php'; ?>
</html>