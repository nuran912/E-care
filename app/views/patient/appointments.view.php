
<!DOCTYPE html>
<html>
    <head>
        <title>Medical records/Lab reports/Private files</title>
        <link rel="stylesheet" href="<?= ROOT;?>/assets/css/patient/appointments.css">
    </head>

    <?php  ?>

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
                    </div>

                    <!-- Past Appointments Section -->
                    <div class="content">
                       
                    <?php if (isset($Pastappointments) && is_array($Pastappointments)): ?>
                        <?php foreach ($Pastappointments as $card): ?>
                        <div class="appointment-date"><?php echo ($card['session_date']); ?></div>
                        <div class="appointment">
                            <span class="doctor">Dr. A W Fernando</span>
                            <span class="ref-no">Ref no: 004</span>
                            <span class="hospital">Union Surgical Hospital</span>
                            <span class="specialization">Neurologist</span>
                            <button class="past-view-button">View</button>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No Past Appointments found.</p>
                    <?php endif; ?>
                    </div>
                </div>
            </div>

            
        </main>
        <script src="<?= ROOT; ?>/assets/js/patient/appointments.js"></script>
    </body>


    
</html>