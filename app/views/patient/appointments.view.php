<!DOCTYPE html>
<html>

<head>
    <title>Pending & Past Appointment Page</title>
    <link rel="stylesheet" href="<?= ROOT; ?>/assets/css/patient/appointments.css">
</head>

<html>
    
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
        
        
        <div class="container">
       
   
                <!-- Search Section -->
                <div class="appointment_search_section">
    <div class="intro"><h4>Search Appointments</h4></div>
    <div class="search-bar"> 
        <form method="GET" action="<?= ROOT ?>/Patient/appointments">
            <input type="date" name="search_date" 
            value="<?= isset($_GET['search_date']) ? htmlspecialchars($_GET['search_date']) : ''; ?>" 
            min="<?= isset($_GET['section']) && $_GET['section'] === 'pending' ? date('Y-m-d') : ''; ?>" 
            max="<?= isset($_GET['section']) && $_GET['section'] === 'past' ? date('Y-m-d') : ''; ?>">
            <input type="hidden" name="section" value="<?= isset($_GET['section']) ? $_GET['section'] : 'pending'; ?>">
            <button type="submit" class="search-button">Search</button>
        </form>
        <?php if (isset($_GET['search_date'])): ?>
            <button class="clear-button" onclick="location.href='<?= ROOT ?>/Patient/appointments?section=<?= isset($_GET['section']) ? $_GET['section'] : 'pending'; ?>&page_<?= isset($_GET['section']) && $_GET['section'] === 'past' ? 'past' : 'pending'; ?>=1';">Clear</button>
        <?php endif; ?>
    </div>
</div>

            <!-- Tab Buttons -->
            <div class="tab-box">
                <button
                    class="tab-button <?= isset($_GET['section']) && $_GET['section'] === 'pending' ? 'active' : ''; ?>"
                    onclick="location.href='<?= ROOT; ?>/Patient/appointments?section=pending&page_pending=1';">
                    Pending Appointments
                </button>
                <button
                    class="tab-button <?= isset($_GET['section']) && $_GET['section'] === 'past' ? 'active' : ''; ?>"
                    onclick="location.href='<?= ROOT; ?>/Patient/appointments?section=past&page_past=1';">
                    Past Appointments
                </button>
                <div class="line"
                    style="left: <?= isset($_GET['section']) && $_GET['section'] === 'past' ? '50%' : '0'; ?>"></div>
            </div>

            <!-- Content Box -->
            <div class="content-box">
                <!-- Pending Appointments Section -->
                <div class="content <?= isset($_GET['section']) && $_GET['section'] === 'pending' ? 'active' : ''; ?>">
                    <?php if (isset($pendingAppointments) && is_array($pendingAppointments) && !empty($pendingAppointments)): ?>
                    <?php foreach ($pendingAppointments as $appointment):
                        
                        ?>
                    <div class="frame">
                        <div class="appointment-header">
                            <span class="date"><?= date("Y, F j, l", strtotime($appointment->session_date)); ?></span>
                            <span class="status">Appointment Status: <span
                                    class="pending"><?= htmlspecialchars($appointment->status); ?></span></span>
                        </div>
                        <div class="appointment">
                            <span class="doctor"><?= htmlspecialchars($appointment->doctor_name); ?></span>
                            <span class="ref-no">Appointment No:
                                <?= htmlspecialchars($appointment->appointment_number); ?></span>
                            <span class="time">Time: <?= date("g:i A", strtotime($appointment->session_time)); ?></span>
                            <button class="view-button"
                                data-appointment-id="<?= $appointment->appointment_id; ?>">View</button>
                            <span class="hospital"><?= htmlspecialchars($appointment->hospital_name); ?></span>
                            <span class="specialization"><?= htmlspecialchars($appointment->specialization); ?></span>
                            <form method="POST" action="<?= ROOT; ?>/patient/appointments"
                                onsubmit="return confirmDelete();">
                                <input type="hidden" name="appointment_id" value="<?= $appointment->appointment_id; ?>">
                                <button type="submit" name="cancel" class="cancel-button">Cancel</button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p>No Pending Appointments found.</p>
                    <?php endif; ?>

                    <!--  Pagination for Pending Appointments -->

                    <?php if ($totalPagesPending > 1): ?>
                    <div class="pagination">
                        <!-- Previous Button -->
                        <div class="pagination-left">
                            <?php if ($currentPagePending > 1): ?>
                            <a class="page-link prev"
                                href="<?= ROOT ?>/Patient/appointments?section=pending&page_pending=<?= $currentPagePending - 1; ?>">
                                ⟨ Prev</a>
                            <?php else: ?>
                            <span class="page-link prev disabled"> ⟨ Prev</span>
                            <?php endif; ?>
                        </div>

                        <!-- Page Numbers -->
                        <div class="pagination-center">
                            <?php
                        $visiblePages = 5; // Number of visible page links
                        $halfVisible = floor($visiblePages / 2);

                        if ($totalPagesPending > $visiblePages) {
                            // Adjust range based on current page
                            if ($currentPagePending <= $halfVisible + 1) {
                                $start = 1;
                                $end = $visiblePages;
                            } elseif ($currentPagePending >= $totalPagesPending - $halfVisible) {
                                $start = $totalPagesPending - $visiblePages + 1;
                                $end = $totalPagesPending;
                            } else {
                                $start = $currentPagePending - $halfVisible;
                                $end = $currentPagePending + $halfVisible;
                            }
                        } else {
                            $start = 1;
                            $end = $totalPagesPending;
                        }

                        // Add ellipsis before the range if necessary
                        if ($start > 1) {
                            echo "<a class='page-link' href='" . ROOT . "/Patient/appointments?section=pending&page_pending=1'>1</a>";
                            if ($start > 2) {
                                echo "<span class='ellipsis'>...</span>";
                            }
                        }

                        // Generate page number links
                        for ($page = $start; $page <= $end; $page++) {
                            $isActive = ($page == $currentPagePending) ? 'active-page' : '';
                            echo "<a class='page-link $isActive' href='" . ROOT . "/Patient/appointments?section=pending&page_pending=$page'>$page</a>";
                        }

                        // Add ellipsis after the range if necessary
                        if ($end < $totalPagesPending) {
                            if ($end < $totalPagesPending - 1) {
                                echo "<span class='ellipsis'>...</span>";
                            }
                            echo "<a class='page-link' href='" . ROOT . "/Patient/appointments?section=pending&page_pending=$totalPagesPending'>$totalPagesPending</a>";
                        }
                        ?>
                        </div>

                        <!-- Next Button -->
                        <div class="pagination-right">
                            <?php if ($currentPagePending < $totalPagesPending): ?>
                            <a class="page-link next"
                                href="<?= ROOT ?>/Patient/appointments?section=pending&page_pending=<?= $currentPagePending + 1; ?>">Next ⟩
                                </a>
                            <?php else: ?>
                            <span class="page-link next disabled">Next ⟩ </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>



                <!-- Past Appointments Section -->
                <div class="content <?= isset($_GET['section']) && $_GET['section'] === 'past' ? 'active' : ''; ?>">
                    <?php if (isset($pastAppointments) && is_array($pastAppointments) && !empty($pastAppointments)): ?>
                    <?php foreach ($pastAppointments as $appointment): ?>
                    <div class="frame">
                        <div class="appointment-header">
                            <span class="date"><?= date("Y, F j, l", strtotime($appointment->session_date)); ?></span>
                            <span class="status">Appointment Status: <span
                                    class="past"><?= htmlspecialchars($appointment->status); ?></span></span>
                        </div>
                        <div class="appointment">
                            <span class="doctor"><?= htmlspecialchars($appointment->doctor_name); ?></span>
                            <span class="ref-no">Appointment No:
                                <?= htmlspecialchars($appointment->appointment_number); ?></span>
                            <span class="time">Time: <?= date("g:i A", strtotime($appointment->session_time)); ?></span>
                            <button class="cancel-view-button"
                                data-appointment-id="<?= $appointment->appointment_id; ?>">View</button>
                            <span class="hospital"><?= htmlspecialchars($appointment->hospital_name); ?></span>
                            <span class="specialization"><?= htmlspecialchars($appointment->specialization); ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p>No Past Appointments found.</p>
                    <?php endif; ?>

                    <!-- Pagination for Past Appointments -->
                    <?php if ($totalPagesPast > 1): ?>
                    <div class="pagination">
                        <!-- Previous Button -->
                        <div class="pagination-left">
                            <?php if ($currentPagePast > 1): ?>
                            <a class="page-link prev"
                                href="<?= ROOT ?>/Patient/appointments?section=past&page_past=<?= $currentPagePast - 1; ?>">
                                Prev</a>
                            <?php else: ?>
                            <span class="page-link prev disabled">Prev</span>
                            <?php endif; ?>
                        </div>

                        <!-- Page Numbers -->
                        <div class="pagination-center">
                            <?php
                                        $visiblePages = 5; // Number of visible page links
                                        $halfVisible = floor($visiblePages / 2);

                                        if ($totalPagesPast > $visiblePages) {
                                            if ($currentPagePast <= $halfVisible + 1) {
                                                $start = 1;
                                                $end = $visiblePages;
                                            } elseif ($currentPagePast >= $totalPagesPast - $halfVisible) {
                                                $start = $totalPagesPast - $visiblePages + 1;
                                                $end = $totalPagesPast;
                                            } else {
                                                $start = $currentPagePast - $halfVisible;
                                                $end = $currentPagePast + $halfVisible;
                                            }
                                        } else {
                                            $start = 1;
                                            $end = $totalPagesPast;
                                        }

                                        // Add ellipsis before the range if necessary
                                        if ($start > 1) {
                                            echo "<a class='page-link' href='" . ROOT . "/Patient/appointments?section=past&page_past=1'>1</a>";
                                            if ($start > 2) {
                                                echo "<span class='ellipsis'>...</span>";
                                            }
                                        }

                                        // Generate page number links
                                        for ($page = $start; $page <= $end; $page++) {
                                            $isActive = ($page == $currentPagePast) ? 'active-page' : '';
                                            echo "<a class='page-link $isActive' href='" . ROOT . "/Patient/appointments?section=past&page_past=$page'>$page</a>";
                                        }

                                        // Add ellipsis after the range if necessary
                                        if ($end < $totalPagesPast) {
                                            if ($end < $totalPagesPast - 1) {
                                                echo "<span class='ellipsis'>...</span>";
                                            }
                                            echo "<a class='page-link' href='" . ROOT . "/Patient/appointments?section=past&page_past=$totalPagesPast'>$totalPagesPast</a>";
                                        }
                                        ?>
                        </div>

                        <!-- Next Button -->
                        <div class="pagination-right">
                            <?php if ($currentPagePast < $totalPagesPast): ?>
                            <a class="page-link next"
                                href="<?= ROOT ?>/Patient/appointments?section=past&page_past=<?= $currentPagePast + 1; ?>">Next
                                </a>
                            <?php else: ?>
                            <span class="page-link next disabled">Next</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>


            </div>

            <!-- Popup Modal -->
            <div id="appointmentModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Appointment Details</h2>
                    <div id="appointmentDetails"></div>
                </div>
            </div>
        </div>
        

        <script>
        // Confirm cancellation
        function confirmDelete() {
            return confirm("Are you sure you want to cancel this appointment?");
        }

        // Modal functionality
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
                                    <?php if (isset($_GET['section']) && $_GET['section'] === 'past'): ?>
                                        <p><strong>Doctor Notes:</strong> ${appointment.doctor_notes || "No notes available"}</p>
                                    <?php endif; ?>
                                        
                                `;
                    appointmentDetailsDiv.innerHTML = details;
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

        // Auto-hide success/error messages after 5 seconds
        document.addEventListener("DOMContentLoaded", function() {
            const successMessage = document.getElementById("successMessage");
            const errorMessage = document.getElementById("errorMessage");
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = "none";
                }, 5000);
            }
            if (errorMessage) {
                setTimeout(() => {
                    errorMessage.style.display = "none";
                }, 5000);
            }
        });
        </script>



    </main>
    <script src="<?= ROOT; ?>/assets/js/patient/appointments.js"></script>
</body>

</html>