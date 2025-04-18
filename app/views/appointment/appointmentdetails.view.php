<!DOCTYPE html>
<html lang="en">

<head>
    <title>Appointment Details Page</title>
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/Appointmentdetails.css">
</head>


<body>

    <form action="<?php echo ROOT; ?>/Appointmentdetailsverification" name="patientForm" method="POST" class="main-container">

        <!-- Patient Details Form - Top Container -->
        <div class="form-container">
            <h2>Enter Patient's Details...</h2>
            <div class="isloggedperson">
                <?php if (isset($_SESSION['USER']->role)): ?>
                    <input name="isloggedperson" type="checkbox" id="isloggedperson"
                        data-title="<?php echo htmlspecialchars($_SESSION['USER']->title ?? ''); ?>"
                        data-username="<?php echo htmlspecialchars($_SESSION['USER']->name ?? ''); ?>"
                        data-email="<?php echo htmlspecialchars($_SESSION['USER']->email ?? ''); ?>"
                        data-contact="<?php echo htmlspecialchars($_SESSION['USER']->phone_number ?? ''); ?>"
                        data-idnumber="<?php echo htmlspecialchars($_SESSION['USER']->NIC ?? ''); ?>">


                    <label for="serviceCharge"><span class="warning-text">
                    Click here to add the logged person's details 
                        </span></label>
                <?php endif; ?>
            </div>
            <div id="patientForm">
                <div class="form-row">
                    <div class="form-group title-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" placeholder="Enter title" required>
                        <span id="idError" class="error-message"></span>
                    </div>
                    <div class="form-group name-group">
                        <label>Patient's Full name</label>
                        <input type="text" id="patientName" name="patientName" placeholder="Enter full name" required>
                        <span id="nameError" class="error-message"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email <?php echo isset($_SESSION['USER']->role) ? '<small class="optional-message">(optional)</small>' : ''; ?></label>
                    <input type="email" id="patientEmail" name="patientEmail" placeholder="Enter your email" <?php echo isset($_SESSION['USER']->role) ? '' : 'required'; ?>>
                    <span id="emailError" class="error-message"></span>
                </div>
                <div class="form-group">
                    <label>Phone number</label>
                    <input type="tel" id="patientPhone" name="patientPhone" pattern="[0-9]{10}" placeholder="Enter phone number" required>
                    <span id="phoneError" class="error-message"></span>
                </div>
                <div class="form-group id-section">
                    <label>ID Type</label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="nic" name="idType" required value="nic" checked>
                            <label for="nic">NIC</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="passport" name="idType" required value="passport">
                            <label for="passport">Passport</label>
                        </div>
                    </div>
                </div>

                <!-- Input Field for ID -->
                <div class="form-group">
                    <input type="text" id="idNumber" placeholder="Enter Nic number" name="NicOrPassport" required>
                    <span id="idError" class="error-message"></span>
                </div>


                <div class="form-group">
                    <label>Address <small class="optional-message">(optional)</small></label>
                    <input type="text" id="patientAddress" name="patientAddress" placeholder="Enter your address">
                    <span id="addressError" class="error-message"></span>
                </div>
                <!-- <div class="form-row"> -->
                    <?php if (isset($_SESSION['USER']->role) && !empty($selectedDocuments)): ?>
                        <input type="hidden" id="isLoggedPerson" name="isLoggedPerson" value="1">
                        <div class="form-group">
                            <button type="button" id="selectDocumentsBtn">Select Documents</button>
                            <div id="documentsPopup" class="popup" style="display: none;">
                                <div class="popup-content">
                                    <span class="close-btn" id="closePopup">&times;</span>
                                    <?php
                                    $previouslySelected = isset($appointment['selected_files']) ? explode(',', $appointment['selected_files']) : [];
                                    foreach ($selectedDocuments as $doc):
                                        $isChecked = in_array($doc->document_id, $previouslySelected) ? 'checked' : '';
                                    ?>
                                        <div class="files">
                                            <input type="checkbox" name="document[]" value="<?= $doc->document_id; ?>" <?= $isChecked; ?>>
                                            <label><?= htmlspecialchars($doc->document_name); ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                

                <!-- <div class="form-group"></div>
                        <label for="uploadButton">Upload Documents</label> 
                         <button type="button" id="uploadButton" name="uploadButton">Upload</button>
                    </div> -->
                <!-- </div> -->


                <div class="checkbox-section">
                    <div class="checkbox-group">
                        <input name="serviceCharge" type="checkbox" id="serviceCharge">
                        <label for="serviceCharge">Add service charge</label>
                    </div>

                    <span class="refund-notification">
                        If appointment is cancelled, the total charge will be refunded without LKR 285/= service charge.
                        <span class="warning-text">
                            (This applies only if the appointment is cancelled at least 48 hours prior to the scheduled appointment)
                        </span>
                    </span>

                    <div class="checkbox-group">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">
                            I agree to the <a href="<?php echo ROOT; ?>/termsAndConditions">terms and conditions</a>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Containers Wrapper -->
        <div class="bottom-containers">
            <!-- Hospital Details -->
            <div class="hospital-container">
                <div class="hospital-image">
                    <img src="<?php echo ROOT; ?>/assets/img/PaymentPage-img/hospital_icon.svg" alt="Union Hospital Matara">
                </div>
                <h3>Appointment Details</h3>
                <div class="session-details">
                    <p><strong>Doctor : </strong> <?= $appointmentDetails['doctor_name'] ?? 'Not Available' ?></p>
                    <p><strong>Specialization: </strong> <?= $appointmentDetails['doctor_specialization'] ?? 'Not Available' ?></p>
                    <p><strong>Hospital name: </strong> <?= $appointmentDetails['hospital_name'] ?? 'Not Available' ?></p>
                    <p><strong>Session date:</strong> <?= $appointmentDetails['session_date'] ?? 'Not Available' ?></p>
                    <p><strong>Session time:</strong> <?= $appointmentDetails['patient_appointment_time'] ?? 'Not Available' ?></p>
                    <p><strong>Appointment no:</strong> <?= $appointmentDetails['appointment_number'] ?? 'Not Available' ?></p>
                    <p class="warning">Your appointment session time <span style="color:  rgb(235,162,162 );"><?= $appointmentDetails['patient_appointment_time'] ?? 'Not Available' ?></span>. This time is depending on the time spend with patient ahead of you</p>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="payment-container">
                <h3>Payment Details</h3>
                <p>Comprehensive summary of charges for your transaction</p>

                <div class="fee-details">
                    <div class="fee-row">
                        <span>Doctor fee</span>
                        <span>Rs.<?= $formatted_doctor_fee ?> </span>
                    </div>
                    <div class="fee-row">
                        <span>Hospital fee</span>
                        <span>Rs. <?= $formatted_hospital_fee ?></span>
                    </div>

                    <div class="fee-row" id="service-charge-container" style="display: none;">
                        <span>Service charge</span>
                        <span>Rs.<?= $formatted_service_charge ?></span>
                    </div>

                    <div class="fee-row total">
                        <span>Total fee</span>
                        <span id="serviceChargePreview"></span>
                    </div>
                </div>
                <button class="continue-btn" type="submit" id="submitBtn">Continue</button>
            </div>
        </div>

        <!-- <input type="hidden" name="totalWithoutServiceCharge" value="<?= $formatted_totalWithoutServiceCharge ?>"> -->
        <input type="hidden" name="hospital_name" value="<?= $appointmentDetails['hospital_name']; ?>">
        <input type="hidden" name="session_date" value="<?= $appointmentDetails['session_date'] ?>">
        <input type="hidden" name="session_time" value="<?= $appointmentDetails['session_time'] ?>">
        <input type="hidden" name="patient_appointment_time" value="<?= $appointmentDetails['patient_appointment_time'] ?>">
        <input type="hidden" name="appointment_number" value="<?= $appointmentDetails['appointment_number'] ?>">
        <input type="hidden" name="doctor_id" value="<?= $appointmentDetails['doctor_id'] ?>">
        <input type="hidden" name="doctor_fee" value="<?= $doctor_fee ?>">
        <input type="hidden" name="hospital_fee" value="<?= $hospital_fee ?>">
        <input type="hidden" name="filled_slots" value="<?= $appointmentDetails['filled_slots'] ?>">
        <input type="hidden" name="availableatime_id" value="<?= $appointmentDetails['availableatime_id'] ?>">




    </form>
    <script>
        const paymentData = {
            serviceCharge: <?php echo json_encode($formatted_service_charge); ?>,
            totalWithoutServiceCharge: <?php echo json_encode($totalWithoutServiceCharge); ?>
        };
    </script>

    <script src="<?php echo ROOT; ?>/assets/js/payment_page.js"></script>
</body>



</html>