<!DOCTYPE html>
<html>

<head>
    <title>Medical records/Lab reports/Private files</title>
    <link rel="stylesheet" href="<?= ROOT; ?>/assets/css/patient/appointments.css">
</head>

<?php  ?>

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
            <?= htmlspecialchars($_SESSION['error']); ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <main>
        <!-- #region -->



        <div class="container">

            <div class="tab-box">
                <button class="tab-button active">Pending Appointments</button>
                <button class="tab-button">Past Appointments</button>
                <div class="line"></div>
            </div>

            <div class="content-box">


                <?php
                date_default_timezone_set("Asia/Colombo");
                $currentDate = date("Y-m-d ");
                $currentTime = date("g:i A");

                ?>


               <!-- Pending Appointments Section -->
<div class="content active">
    <?php if (isset($data) && is_array($data) && !empty($data)): ?>

        <?php
        date_default_timezone_set('Asia/Colombo');
        $currentDate = date("Y-m-d");
        $currentTime = date("H:i:s");

        $hasPendingAppointments = false;

        // Group pending appointments by date
        $groupedAppointments = [];

        foreach ($data as $appointment) {
            if (
                ($appointment->session_date > $currentDate ||
                (strtotime($appointment->session_date) == strtotime($currentDate) &&
                strtotime($appointment->session_time) > strtotime($currentTime))) &&
                $appointment->is_deleted == 0
            ) {
                $dateKey = date("Y, F j, l", strtotime($appointment->session_date));
                if (!isset($groupedAppointments[$dateKey])) {
                    $groupedAppointments[$dateKey] = [];
                }
                $groupedAppointments[$dateKey][] = $appointment;
            }
        }
        ?>

        <?php if (!empty($groupedAppointments)): ?>
            <?php $hasPendingAppointments = true; ?>

            <?php foreach ($groupedAppointments as $date => $appointments): ?>
                <?php echo $date; ?>

                <?php foreach ($appointments as $appointment): ?>
                    <div class="frame">
                        <span class="status">Appointment Status: <span class="pending"><?php echo htmlspecialchars($appointment->status); ?></span></span>

                        <div class="appointment">
                            <span class="doctor"> <?php echo htmlspecialchars($appointment->doctor_name); ?></span>
                            <span class="ref-no">Appointment No:
                                <?php echo htmlspecialchars($appointment->appointment_number); ?></span>
                            <span class="time"><?php echo date("g:i A", strtotime($appointment->session_time)); ?></span>

                            <button class="view-button"
                                data-appointment-id="<?php echo $appointment->appointment_id; ?>">View</button>

                            <span class="hospital"><?php echo htmlspecialchars($appointment->hospital_name); ?></span>
                            <span
                                class="specialization"><?php echo htmlspecialchars($appointment->specialization); ?></span>

                            <form method="POST" action="<?= ROOT; ?>/patient/appointments"
                                onsubmit="return confirmDelete();">
                                <input type="hidden" name="appointment_id" value="<?= ($appointment->appointment_id); ?>">
                                <button type="submit" name="cancel" class="cancel-button">Cancel</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>

        <?php endif; ?>

        <?php if (!$hasPendingAppointments): ?>
            <p>No Pending Appointments found.</p>
        <?php endif; ?>

    <?php else: ?>
        <p>No Pending Appointments found.</p>
    <?php endif; ?>
</div>



                <!-- Past Appointments Section -->
                <div class="content">
                    <?php if (isset($data) && is_array($data) && !empty($data)): ?>

                        <?php
                        $hasPastAppointments = false;

                        // Group past appointments by date
                        $groupedAppointments = [];

                        foreach ($data as $appointment) {
                            if (
                                ($appointment->session_date < $currentDate ||
                                (strtotime($appointment->session_date) == strtotime($currentDate) &&
                                strtotime($appointment->session_time) < strtotime($currentTime))) &&
                                $appointment->is_deleted == 0
                            ) {
                                $dateKey = date("Y, F j, l", strtotime($appointment->session_date));
                                if (!isset($groupedAppointments[$dateKey])) {
                                    $groupedAppointments[$dateKey] = [];
                                }
                                $groupedAppointments[$dateKey][] = $appointment;
                            }
                        }
                        ?>

                        <?php if (!empty($groupedAppointments)): ?>
                            <?php $hasPastAppointments = true; ?>

                            <?php foreach ($groupedAppointments as $date => $appointments): ?>
                                <?php echo $date; ?>
                                <?php foreach ($appointments as $appointment): ?>
                                    <div class="frame">
                                        <!-- <span class="date"><?php echo date("Y, F j, l", strtotime($appointment->session_date)); ?></span> -->
                                        <span class="status">Appointment Status: <span class="past"><?php echo htmlspecialchars($appointment->status); ?></span></span>
                                        <div class="appointment">
                                            <span class="doctor"><?php echo htmlspecialchars($appointment->doctor_name); ?></span>
                                            <span class="ref-no">Appointment No: <?php echo htmlspecialchars($appointment->appointment_number); ?></span>
                                            <span class="time"><?php echo date("g:i A", strtotime($appointment->session_time)); ?></span>
                                            <button class="cancel-view-button" data-appointment-id="<?php echo $appointment->appointment_id; ?>">View</button>
                                            <span class="hospital"><?php echo htmlspecialchars($appointment->hospital_name); ?></span>
                                            <span class="specialization"><?php echo htmlspecialchars($appointment->specialization); ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endforeach; ?>

                        <?php endif; ?>

                        <?php if (!$hasPastAppointments): ?>
                            <p>No Past Appointments found.</p>
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
                                const appointmentElement = button.closest('.frame');
                                const appointmentId = button.getAttribute('data-appointment-id');
                                const appointments = <?= json_encode($data); ?>;
                                const appointment = appointments.find(a => a.appointment_id == appointmentId);

                                const doctor = appointmentElement.querySelector('.doctor').textContent.replace('Doctor:', '').trim();
                                const appointmentNo = appointmentElement.querySelector('.ref-no').textContent.replace('Appointment No:', '').trim();
                                const time = appointmentElement.querySelector('.time').textContent.trim();
                                const hospital = appointmentElement.querySelector('.hospital').textContent.trim();
                                const specialization = appointmentElement.querySelector('.specialization').textContent.trim();
                                const date = appointmentElement.querySelector('.date')?.textContent?.trim() ;
                              

                                // Populate the modal with appointment details
                                const details = `
                                        <p><strong>Patient Name:</strong> ${appointment.patient_name || "N/A"}</p>
                                        <p><strong>Patient Email:</strong> ${appointment.patient_Email || "N/A"}</p>
                                        <p><strong>Patient Address:</strong> ${appointment.patient_address || "Not entered"}</p>
                                        <p><strong>Phone Number:</strong> ${appointment.phone_number || "N/A"}</p>            
                                        <p><strong>Doctor:</strong> ${doctor}</p>
                                        <p><strong>Specialization:</strong> ${specialization}</p>
                                        <p><strong>Hospital:</strong> ${hospital}</p>
                                        <p><strong>Appointment No:</strong> ${appointmentNo}</p>
                                        <p><strong>Appointment Date:</strong> ${date}</p> 
                                        <p><strong>Appointment Time:</strong> ${time}</p>
                                        <p><strong>Appointment Fee:</strong> Rs.${appointment.total_fee || "N/A"}.00</p>
                                        <p><strong>Payment Status:</strong> ${appointment.payment_status || "N/A"}</p>
                                        <!-- <p><strong>Selected files:</strong> ${appointment.selected_files || "No Documents to show"}</p> -->
                                        <p><strong>Uploaded documents:</strong> ${appointment.documentNames || "No Documents to show"}</p>

                                        
                                     
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



                    //script to hide success message after 3 seconds

                    document.addEventListener("DOMContentLoaded", function() {
                        // Auto-hide success message after 3 seconds
                        const successMessage = document.getElementById("successMessage");
                        const errorMessage = document.getElementById("errorMessage");

                        if (successMessage) {
                            setTimeout(() => {
                                successMessage.style.display = "none";

                            }, 5000); // 4 seconds
                        }

                        if (errorMessage) {
                            setTimeout(() => {
                                errorMessage.style.display = "none";
                            }, 5000); // 5 seconds (if desired)
                        }
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
                        background-color: rgba(0, 0, 0, 0.9);
                    }


                    .modal-content {
                        background-color: #fefefe;
                        margin: 10% auto;
                        padding: 20px;
                        border-radius: 10px;
                        width: 50%;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                        border: solid 1px black;
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