
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Appointment Details Page</title>
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/PaymentDetailsPage.css">

<body>
    <script>
        const serviceFee = <?php echo $service_charge ?>;
        const totalWithoutServiceCharge = <?php echo $doctor_fee + $hospital_fee ?>;
    </script>
    <form action="appointment_details_verification.php" name="patientForm" method="POST" class="main-container">
        <!-- Patient Details Form - Top Container -->
        <div class="form-container">
            <h2>Enter Patient's Details...</h2>
            <div id="patientForm">
                <div class="form-row">
                    <div class="form-group title-group">
                        <label for="title">Title</label>
                        <select id="title" required>
                            <option value="dr">Dr.</option>
                            <option value="mr">Mr.</option>
                            <option value="mrs">Mrs.</option>
                            <option value="ms">Ms.</option>
                        </select>
                    </div>
                    <div class="form-group name-group">
                        <label>Patient's Full name</label>
                        <input type="text" id="patientName" name="patientName" placeholder="Enter full name" required>
                        <span id="nameError" class="error-message"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="patientEmail" name="patientEmail" placeholder="Enter your email" required>
                    <span id="emailError" class="error-message"></span>
                </div>
                <div class="form-group">
                    <label>Phone number</label>
                    <input type="tel" id="patientPhone" name="patientPhone" placeholder="Enter phone number" required>
                    <span id="phoneError" class="error-message"></span>
                </div>
                <div class="form-group id-section">
                    <label>ID Type</label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="nic" name="idType" value="nic" checked>
                            <label for="nic">NIC</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="passport" name="idType" value="passport">
                            <label for="passport">Passport</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>NIC Number/Passport</label>
                    <input type="text" id="idNumber" placeholder="Enter ID/PASSPORT number" required>
                    <span id="idError" class="error-message"></span>
                </div>




                <div class="checkbox-section">
                    <div class="checkbox-group">
                        <input type="checkbox" id="serviceCharge">
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
                            I agree to the <a href="../Pages/terms_and_conditions.php">terms and conditions</a>
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
                    <img src="../assets/icons/hospital_icon.svg" alt="Union Hospital Matara">
                </div>
                <h3>Appointment Details</h3>
                <div class="session-details">
                    <p><strong>Hospital name: </strong> <?= $appointmentDetails['hospital_name'] ?? 'Not Available' ?></p>
                    <p><strong>Session date:</strong> <?= $appointmentDetails['session_date'] ?? 'Not Available' ?></p>
                    <p><strong>Session time:</strong> <?= $appointmentDetails['session_time'] ?? 'Not Available' ?></p>
                    <p><strong>Appointment no:</strong> <?= $appointmentDetails['appointment_number'] ?? 'Not Available' ?></p>
                    <p class="warning">Your appointment session time is <?= $appointmentDetails['patient_appointment_time'] ?? 'Not Available' ?>. This time is depending on the time spend with patient ahead of you</p>
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
                    <div class="fee-row" id="service-charge-container">
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
    </form>
    <script src="./JS_files/payment_page.js" defer> </script>
</body>

</html>