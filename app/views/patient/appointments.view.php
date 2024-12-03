<!DOCTYPE html>
<html>

<head>
    <title>Medical records/Lab reports/Private files</title>
    <link rel="stylesheet" href="<?= ROOT; ?>/assets/css/patient/appointments.css">
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


<?php
date_default_timezone_set("Asia/Colombo");
$currentDate = date("Y-m-d H:i:s");

?>

  
                <!-- Pending Appointments Section -->
                <div class="content active">
                   <?php if (isset($data) && is_array($data) && !empty($data)): ?>
                        <?php 
                   $hasPendingAppointments = false;
                    foreach ($data as $appointment): 
                       if ($appointment->status == 'scheduled' || $appointment->status == 'pending'): 
                         $hasPendingAppointments = true;
                                     ?>
                <span class="date"><?php echo date("Y, F j, l", strtotime($appointment->session_date)); ?></span>

                <div class="appointment">
                    <span class="doctor"> <?php echo htmlspecialchars($appointment->doctor_name); ?></span>
                    <span class="ref-no">Appointment No: <?php echo htmlspecialchars($appointment->appointment_number); ?></span>
                    <span class="time"><?php echo date("g:i A", strtotime($appointment->session_time)); ?></span>

                    <button class="view-button">View</button>
                    <span class="hospital"><?php echo htmlspecialchars($appointment->hospital_name); ?></span>
                    <span class="specialization"><?php echo htmlspecialchars($appointment->specialization); ?></span>

                    <form method="POST" action="<?= ROOT; ?>/patient/cancelAppointment" onsubmit="return confirmDelete();">
                        <input type="hidden" name="appointment_id" value="<?= htmlspecialchars($appointment->appointment_id); ?>">
                        <button type="submit" name="cancel" class="cancel-button">Cancel</button>
                    </form>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if (!$hasPendingAppointments): ?>
            <p>No Pending Appointments found.</p>
        <?php endif; ?>

    <?php else: ?>
        <p>No Pending Appointments found.</p>
    <?php endif; ?>
</div>


                <!-- Past Appointments Section -->
                <div class="content">
                    <?php if (isset($data) && is_array($data) &&(!empty($data))): ?>
                     
                        <?php 
                           $haspastAppointments=false;
                        foreach ($data as $appointment): 
                              if ($appointment->status == 'completed'): 
                                $haspastAppointments=true;
                                ?>


                                <span class="date"><?php echo date("Y, F j, l", strtotime($appointment->session_date)); ?></span>

                                <div class="appointment">
                                    <span class="doctor"> <?php echo ($appointment->doctor_name); ?></span>
                                    <span class="ref-no">Appointment No: <?php echo ($appointment->appointment_number); ?></span>
                                    <span class="time"><?php echo date("g:i A", strtotime($appointment->session_time)); ?></span>
                                    <button class="cancel-view-button">View</button>
                                    <span class="hospital"><?php echo ($appointment->hospital_name); ?></span>
                                    <span class="specialization"><?php echo ($appointment->specialization); ?></span>
                                </div>
                            
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if (!$haspastAppointments): ?>
                       <p>No past Appointments found.</p>
                       <?php endif; ?>

                    <?php else: ?>
                        <p>No Past Appointments found.</p>
                    <?php endif; ?>
                </div>


                <!-- Popup Modal -->
                <div id="appointmentModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Appointment Details</h2>
                        <div id="appointmentDetails"></div>
                    </div>
                </div>


                <script>
                    function confirmDelete() {
                        return confirm("Are you sure you want to cancel this appointment?");
                    }
                    document.addEventListener('DOMContentLoaded', function() {
                        const modal = document.getElementById("appointmentModal");
                        const closeModal = document.getElementsByClassName("close")[0];
                        const appointmentDetailsDiv = document.getElementById("appointmentDetails");

                        // Attach event listeners to all "View" buttons
                        document.querySelectorAll('.view-button, .cancel-view-button').forEach(function(button) {
                            button.addEventListener('click', function() {
                                // Find the closest appointment element and extract its details
                                const appointmentElement = button.closest('.appointment');
                                const doctor = appointmentElement.querySelector('.doctor').textContent.replace('Doctor:', '').trim();
                                const appointmentNo = appointmentElement.querySelector('.ref-no').textContent.replace('Appointment No:', '').trim();

                                const time = appointmentElement.querySelector('.time').textContent.trim();
                                const hospital = appointmentElement.querySelector('.hospital').textContent.trim();
                                const specialization = appointmentElement.querySelector('.specialization').textContent.trim();

                                // Populate the modal with appointment details
                                const details = `
                    <p><strong>Doctor:</strong> ${doctor}</p>
                    <p><strong>Appointment No:</strong> ${appointmentNo}</p>
                    <p><strong>Time:</strong> ${time}</p>
                    <p><strong>Hospital:</strong> ${hospital}</p>
                    <p><strong>Specialization:</strong> ${specialization}</p>
                `;
                                appointmentDetailsDiv.innerHTML = details;

                                // Show the modal
                                modal.style.display = "block";
                            });
                        });

                        // Close the modal when clicking the close button
                        closeModal.onclick = function() {
                            modal.style.display = "none";
                        };

                        // Close the modal when clicking outside of it
                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        };
                    });
                </script>



                <style>
                    .modal {
                        display: none;
                        position: fixed;
                        z-index: 1000;
                        left: 0;
                        top: 0;
                        width: 100%;
                        height: 100%;
                        overflow: auto;
                        background-color: rgba(0, 0, 0, 0.6);
                    }


                    .modal-content {
                        background-color: white;
                        margin: 10% auto;
                        padding: 20px;
                        border-radius: 10px;
                        width: 50%;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                    }

                    .close {
                        color: red;
                        float: right;
                        font-size: 28px;
                        cursor: pointer;
                    }

                    .close:hover {
                        color: darkred;
                    }
                </style>
    </main>
    <script src="<?= ROOT; ?>/assets/js/patient/appointments.js"></script>
</body>



</html>