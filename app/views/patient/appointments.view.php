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
    <?php if (isset($pendingAppointments) && is_array($pendingAppointments) && !empty($pendingAppointments)): ?>
        
        <?php foreach ($pendingAppointments as $appointment): ?>
            <div class="frame"> 
                <div class="appointment-header">
                    <span class="date">
                        <?= date("Y, F j, l", strtotime($appointment->session_date)); ?>
                    </span>
                    <span class="status">
                        Appointment Status: <span class="pending">
                            <?= htmlspecialchars($appointment->status); ?>
                        </span>
                    </span>
                </div>

                <div class="appointment">
                    <span class="doctor"><?= htmlspecialchars($appointment->doctor_name); ?></span>
                    <span class="ref-no">Appointment No: <?= htmlspecialchars($appointment->appointment_number); ?></span>
                    <span class="time">Time:<?= date("g:i A", strtotime($appointment->session_time)); ?></span>
                    <button class="view-button" data-appointment-id="<?= $appointment->appointment_id; ?>">View</button>
                    <span class="hospital"><?= htmlspecialchars($appointment->hospital_name); ?></span>
                    <span class="specialization"><?= htmlspecialchars($appointment->specialization); ?></span>

                    <form method="POST" action="<?= ROOT; ?>/patient/appointments" onsubmit="return confirmDelete();">
                        <input type="hidden" name="appointment_id" value="<?= $appointment->appointment_id; ?>">
                        <button type="submit" name="cancel" class="cancel-button">Cancel</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>

    <?php else: ?>
        <p>No Pending Appointments found.</p>
    <?php endif; ?>
</div>

<?php if ($totalPagesPending > 1): ?>
    <div class="pagination">
        <?php
        $queryParams = $_GET;
        // Previous page link
        if ($currentPagePending > 1) {
            $queryParams['page_pending'] = $currentPagePending - 1;
            echo "<a class='page-link' href='?" . http_build_query($queryParams) . "'>&laquo; Prev</a>";
        }

        // Page number links
        for ($page = 1; $page <= $totalPagesPending; $page++) {
            $queryParams['page_pending'] = $page;
            $isActive = ($page == $currentPagePending) ? 'active' : '';
            echo "<a class='page-link $isActive' href='?" . http_build_query($queryParams) . "'>$page</a>";
        }

        // Next page link
        if ($currentPagePending < $totalPagesPending) {
            $queryParams['page_pending'] = $currentPagePending + 1;
            echo "<a class='page-link' href='?" . http_build_query($queryParams) . "'>Next &raquo;</a>";
        }
        ?>
    </div>
<?php endif; ?>

                <!-- End of Pending Appointments Section -->
            
            
              <!-- Past Appointments Section -->
<div class="content">
    <?php if (isset($pastAppointments) && is_array($pastAppointments) && !empty($pastAppointments)): ?>

        <?php foreach ($pastAppointments as $appointment): ?>
            <div class="frame">
                <div class="appointment-header">
                    <span class="date"><?php echo date("Y, F j, l", strtotime($appointment->session_date)); ?></span>
                    <span class="status">Appointment Status: <span class="past"><?php echo htmlspecialchars($appointment->status); ?></span></span>
                </div>

                <div class="appointment">
                    <span class="doctor"><?php echo htmlspecialchars($appointment->doctor_name); ?></span>
                    <span class="ref-no">Appointment No: <?php echo htmlspecialchars($appointment->appointment_number); ?></span>
                    <span class="time">Time:<?php echo date("g:i A", strtotime($appointment->session_time)); ?></span>
                    <button class="cancel-view-button" data-appointment-id="<?php echo $appointment->appointment_id; ?>">View</button>
                    <span class="hospital"><?php echo htmlspecialchars($appointment->hospital_name); ?></span>
                    <span class="specialization" style="display: none;"><?php echo htmlspecialchars($appointment->specialization); ?></span>
                </div>
            </div>
        <?php endforeach; ?>

    <?php else: ?>
        <p>No Past Appointments found.</p>
    <?php endif; ?>
</div>
<?php if ($totalPagesPast > 1): ?>
    <div class="pagination">
        <?php
        $queryParams = $_GET;
        // Previous page link
        if ($currentPagePast > 1) {
            $queryParams['page_past'] = $currentPagePast - 1;
            echo "<a class='page-link' href='?" . http_build_query($queryParams) . "'>&laquo; Prev</a>";
        }

        // Page number links
        for ($page = 1; $page <= $totalPagesPast; $page++) {
            $queryParams['page_past'] = $page;
            $isActive = ($page == $currentPagePast) ? 'active' : '';
            echo "<a class='page-link $isActive' href='?" . http_build_query($queryParams) . "'>$page</a>";
        }

        // Next page link
        if ($currentPagePast < $totalPagesPast) {
            $queryParams['page_past'] = $currentPagePast + 1;
            echo "<a class='page-link' href='?" . http_build_query($queryParams) . "'>Next &raquo;</a>";
        }
        ?>
    </div>
<?php endif; ?>





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
                                        <p><strong>Uploaded documents:</strong> ${formatDocumentsList(appointment.documentNames)}</p>

                                        
                                     
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

                              function formatDocumentsList(documentsText) {
                            if (!documentsText || documentsText.includes("No Documents")) {
                                return `<div class="documents-list"><div class="document-item">No Documents to show</div></div>`;
                            }
                            
                            // Split the text by commas or newlines
                            const documents = documentsText.split(/[,\n]/).map(doc => doc.trim()).filter(doc => doc);
                            
                            let html = '<div class="documents-list">';
                            documents.forEach(doc => {
                                html += `<div class="document-item">${doc}</div>`;
                            });
                            html += '</div>';
                            
                            return html;
                            }

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



               
    </main>
    <script src="<?= ROOT; ?>/assets/js/patient/appointments.js"></script>
</body>



</html>