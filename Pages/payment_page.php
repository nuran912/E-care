<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Page</title>
    <link rel="stylesheet" href="../Style/payment_page.css">
    <script>
        function calculateTotal() {
            // Base fees
            const doctorFee = 3000;
            const hospitalFee = 1500;
            const serviceCharge = 285;

            // Check if the service charge checkbox is ticked
            const isServiceChargeChecked = document.getElementById("serviceCharge").checked;

            // Calculate the total fee
            let totalFee = doctorFee + hospitalFee;
            let serviceFeeText = "LKR 0";

            if (isServiceChargeChecked) {
                totalFee += serviceCharge;
                serviceFeeText = "LKR " + serviceCharge;
            }

            // Update the service fee and total fee on the page
            document.getElementById("serviceFee").innerText = serviceFeeText;
            document.getElementById("totalFee").innerText = "LKR " + totalFee;
        }

        function calculateArrivalTime(appointmentNumber, doctorArrivalTime) {
            const [hour, minutePart] = doctorArrivalTime.split(":");
            let minute = parseInt(minutePart.replace(/\D/g, ''), 10);
            let period = minutePart.includes('PM') ? 'PM' : 'AM';

            // Calculate total minutes to add based on the appointment number
            const totalMinutesToAdd = (appointmentNumber - 1) * 5;

            // Calculate the new time
            let newMinute = parseInt(minute) + totalMinutesToAdd;
            let newHour = parseInt(hour);

            if (newMinute >= 60) {
                newHour += Math.floor(newMinute / 60);
                newMinute = newMinute % 60;
            }

            // Convert 24-hour format to 12-hour format
            if (newHour > 12) {
                newHour -= 12;
                period = period === 'AM' ? 'PM' : 'AM';
            }

            // Format the time string
            const formattedMinute = newMinute < 10 ? '0' + newMinute : newMinute;
            return `${newHour}:${formattedMinute} ${period}`;
        }
        
        function validateForm() {
            // Get form elements
            const name = document.getElementById("Name").value;
            const email = document.getElementById("email").value;
            const telephone = document.getElementById("telephone").value;
            const idNumber = document.getElementById("idNumber").value;
            const agreeTerms = document.getElementById("agreeTerms").checked;

            // Check if all required fields are filled and terms are agreed
            if (!name || !email || !telephone || !idNumber || !agreeTerms) {
                alert("Please fill out all required fields and agree to the terms and conditions.");
                return false; // Prevent redirection
            }

            // If validation passes
            return true;
        }
        // Run the calculation functions when the page loads
        window.onload = function() {
            calculateTotal();

            // Example: Appointment number 3 and doctor arrival time at 3:00 PM
            const appointmentNumber = 3;
            const doctorArrivalTime = "3:00 PM";
            const patientArrivalTime = calculateArrivalTime(appointmentNumber, doctorArrivalTime);

            // Display the arrival time on the page
            document.getElementById("arrivalTime").innerText = patientArrivalTime;
        };
    </script>
</head>

<body>
    <div class="container">
        <h1>Payment Details</h1>

        <!-- Form Division -->
        <div class="form-container">
            <form id="paymentForm" action="process-payment.php" method="post">

                <!-- Align in One Row -->
                <div class="row">
                    <div class="title form-group">
                        <label for="title">Title:</label>
                        <select id="title" name="title" required>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Miss">Miss</option>
                            <option value="Ms">Ms</option>
                            <option value="Dr">Dr</option>
                        </select>
                    </div>

                    <div class="name form-group">
                        <label for="Name">Full Name:</label>
                        <input type="text" id="Name" name="Name" required placeholder="John Doe">
                    </div>
                </div>

                <br>
                <div class="form1">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required placeholder="john.doe@example.com"><br><br>

                    <label for="telephone">Telephone No:</label>
                    <input type="tel" id="telephone" name="telephone" pattern="[0-9]{10}" required placeholder="0771234567"><br><br>

                    <label for="idNumber">NIC/Passport:</label>
                    <input type="text" id="idNumber" name="idNumber" required placeholder="123456789V"><br><br>

                    <div class="check">
                        <div>
                            <input type="checkbox" id="serviceCharge" name="serviceCharge" onclick="calculateTotal()">
                        </div>
                        <div>
                            <label for="serviceCharge" class="terms">Add Service Charge</label><br><br>
                        </div>
                    </div>
                    <p class="condition">If appointment is cancelled, the total charge will be <span class="servicechargepolicy">refunded without LKR 285/= service charge (this applies only if the appointment is cancelled at least 48 hours prior to the scheduled appointment)</span></p>

                    <div class="check">
                        <div>
                            <input type="checkbox" id="agreeTerms" name="agreeTerms" required>
                        </div>

                        <div>
                            <label for="agreeTerms" class="terms">I agree to the <a href="terms_and_conditions.php" target="_blank" rel="noopener noreferrer">Terms and Conditions </a></label><br><br>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Payment Details and Appointment Details Divisions -->
        <div class="details-container">

            <!-- Appointment Details Division -->
            <div class="appointment-details">
                <img class="hospitalimage" src="../assets/icons/hospital_icon.svg" alt="hospital image">
                <h3>Appointment Details</h3>
                <p><strong>Hospital Name:</strong> City Hospital</p>
                <p><strong>Session Date:</strong> September 5, 2024</p>
                <p><strong>Session Time:</strong> 3:00 PM</p>
                <p><strong>Appointment No:</strong> 03</p>
                <br>
                <p class="servicechargepolicy">Your approximated appointment time is <span id="arrivalTime"></span>. This time depends on the time spent with patients ahead of you.</p>
            </div>

            <!-- Payment Details Division -->
            <div class="payment-details">

                <h3>Appointment Payment Details</h3>
                <br>
                <p><strong>Doctor fee:</strong> LKR 3000</p>
                <p><strong>Hospital fee:</strong> LKR 1500</p>
                <p><strong>Service Charge:</strong> <span id="serviceFee">LKR 0</span></p>
                <p><strong>Total Fee:</strong> <span id="totalFee">LKR 4500</span></p>
                <br>

                <button type="button" id="continueButton" class="btn-primary">Continue</button>




            </div>
        </div>
    </div>
    <script>
        document.getElementById('continueButton').addEventListener('click', function() {
           
            if (validateForm()) {
                // Redirect to the appointment_details_verification page
                window.location.href = 'appointment_details_verification.php';
            }
        });
    </script>
</body>

</html>