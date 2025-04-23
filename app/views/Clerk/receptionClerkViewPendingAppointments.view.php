<!DOCTYPE html>
<html>

<head>
    <title>View Pending Appointments</title>
    <style>
        * {
            font-family: "Lucida Sans";
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
            
        body {
            background-color: #f5f5f5;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .container {
            margin: 50px 50px;
            width: 800px;
            background-color: white;
            padding: 30px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
        }

        .content-box {
            padding: 20px;
        }

        .content-box h2 {
            text-align: center;
            margin-bottom: 40px;
            color: #1c3a47;
        }

        .content-box .content {
            display: block;
            animation: moving 0.5s ease;
        }

        .content {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        @keyframes moving {
            from {
                transform: translateX(50px);
                opacity: 0;
            }
            to {
                transform: translateX(0px);
                opacity: 1;
            }
        }

        .appointment-main-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #1c3a47;
        }

        .appointment-date {
            margin-top: 30px;
            font-weight: bold;
            font-size: large;
            color: #003366;
        }

        .payment-stat {
            margin-top: 30px;
            font-weight: bold;
            font-size: large;
            color: #003366;
            margin-right: 20px;
        }

        .appointment {
            display: grid;
            grid-template-columns: 1fr 1fr auto auto;
            grid-template-rows: auto auto;
            gap: 10px;
            padding: 20px;
            border: 1px solid #ccc;
            width: 100%;
            margin-top: 5px;
            margin-bottom: 10px;
            border-radius: 6px;
            background-color: #003366;
        }

        .appointment span, .appointment button {
            text-align: center;
            padding: 8px;
        }

        .appointment .patient,
        .appointment .doctor,
        /* .appointment .hospital, */
        .appointment .specialization {
            align-self: center;
            text-align: center;
            padding: 6px;
            text-align: center;
            border-radius: 4px;
            width: auto;
            border: 2px solid #908585;
            color: black;
            background-color: #ebe0e0;
            font-weight: bold;
            white-space: nowrap;
            display: inline-block;
        }

        /* .appointment .hospital {
            grid-column: 1;
            grid-row: 2;
            align-self: center;
            text-align: center;
            padding: 6px;
            text-align: center;
            border-radius: 4px;
            width: auto;
            border: 2px solid #908585;
            color: black;
            background-color: #ebe0e0;
            font-weight: bold;
        } */

        .appointment .specialization {
            grid-column: 3;
            grid-row: 1;
            align-self: center;
            text-align: center;
            padding: 6px;
            text-align: center;
            border-radius: 4px;
            width: auto;
            border: 2px solid #908585;
            color: black;
            background-color: #ebe0e0;
            font-weight: bold;
        }

        .appointment .ref-no, .appointment .time {
            align-self: center;
            text-align: center;
            padding: 6px;
            text-align: center;
            border-radius: 4px;
            width: auto;
            border: 2px solid #908585;
            color: black;
            background-color: #ebe0e0;
            font-weight: bold;
            white-space: nowrap;
            display: inline-block;
        }

        .appointment .time {
            grid-column: 2;
            grid-row: 2;
        }

        .appointment .ref-no {
            grid-column: 1;
            grid-row: 2;
        }

        .view-button {
            grid-column: 3;
            grid-row: 2;
            color: black;
            padding: 8px;
            text-align: center;
            border-radius: 4px;
            cursor: pointer;
            /* grid-column: 4;
            grid-row: 1 / span 2; */
            align-self: center;
            justify-self: center;
            border: none;
            min-width: 90px;
            font-weight: bold;
            background: rgb(88, 223, 250);
            font-size:medium;
        }
            
        .view-button:hover {
            background-color: #3366cc;
            color: white;
        }

        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
            overflow: hidden;
            backdrop-filter: blur(6px);
        }

        .popup-content {
            width: 40%;
            background-color: #fff;
            max-width: 300px;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.2);
            overflow-y: auto;
            animation: fadeIn 0.3s ease;
        }

        .popup-content h4 {
            color: #1c3a47;
            text-align: center;
            margin-bottom: 10px;
        }

        .popup-content form label {
            display: block;
            font-size: 14px;
            color: #333;
        }

        .popup-content form input {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .popup-content form button {
            display: inline-block;
            padding: 5px 10px;
            width: 100%;
            font-size: 14px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin-top: 10px;
        }

        .popup-content form button.pay-button, .popup-content form button.print-button {
            background-color: #0E2F56;
            border: none;
            color: white;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .pay-button a {
            text-decoration: none;
            color: white;
        }

        .popup-content form button.print-button .a {
            text-decoration: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .search {
            border-radius: 5px;
            padding: 5px;
            width: 300px;
            border: 1px solid #1c3a47;
            font-size: 14px;
            margin-bottom: 50px;
            margin-left: 150px;
        }

        .search-button {
            color: white;
            font-weight: bold;
            padding: 6px;
            border-radius: 5px;
            width: 100px;
            background-color: #0E2F56;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<?php  ?>

<body>
    <main>

        <div class="container">

            <div class="content-box">

            <h2>Pending Appointments</h2>

                <form action="" id="searchForm" method="POST">
                    <input type="text" name="find" class="search" placeholder="Search Appointments...">
                    <button class="search-button" type="submit">Search</button>
                </form>

                <div class="content">

                    <?php if(empty($appointments)): ?>
                        <p style="margin-top: 30px; text-align: center;">No pending appointments available.</p>
                    
                    <?php else: ?>
                
                        <?php if (isset($appointments) && is_array($appointments)): ?>

                            <?php $index = 0; ?>
                            <?php foreach ($appointments as $appointment): ?>

                                <?php if ($appointment['status'] == 'scheduled' && $appointment['session_date'] == date('Y-m-d')): ?>

                                    <div class="appointment-main-info">
                                        <span class="appointment-date"><?php echo date("Y, F j, l", strtotime($appointment['session_date'])); ?></span>
                                        
                                        <?php if ($appointment['payment_status'] == "pending"): ?>
                                            <p class="payment-stat">Payment Status : <span style="color: red; font-weight: bold;">Pending</span></p>
                                        <?php else:?>
                                            <p class="payment-stat">Payment Status : <span style="color: green; font-weight: bold;">Completed</span></p>
                                        <?php endif; ?>
                                    </div>

                                    <div class="appointment">

                                        <span class="patient"><?php echo ($appointment['patient_name']); ?></span>
                                        <span class="doctor"><?php echo ($appointment['doctor_name']); ?></span>
                                        <span class="specialization"><?php echo ($appointment['specialization']); ?></span>
                                        <span class="ref-no">Appointment No: <?php echo ($appointment['appointment_number']); ?></span>
                                        <span class="time">Session Time: <?php echo date("g:i A", strtotime($appointment['session_time'])); ?></span>

                                        <button class="view-button" data-index="<?= $index ?>">View</button>
                                            <div class="popup" id="popup-<?= $index ?>" style="display: none;">
                                                <div class="popup-content">
                                                    <form method="POST" action="<?= ROOT; ?>/Clerk/receptionClerkViewPendingAppointments">

                                                        <h4>Appointment Details</h4>

                                                        <input type="hidden" name="appointment_id" value="<?php echo htmlspecialchars($appointment['appointment_id']) ?>">
                                                        
                                                        <label for="patient_name">Date: </label>
                                                        <input type="text" name="session_date" class="session_date" value="<?php echo htmlspecialchars($appointment['session_date']) ?>">
                                                        <label for="patient_name">Patient Name: </label>
                                                        <input type="text" name="patient_name" class="patient-name" value="<?php echo htmlspecialchars($appointment['patient_name']) ?>">
                                                        <label for="patient_phone">Contact Number: </label>
                                                        <input type="text" name="patient_phone" class="patient-phone" value="<?php echo htmlspecialchars($appointment['phone_number']) ?>">
                                                        <label for="doctor_name">Doctor: </label>
                                                        <input type="text" name="doctor_name" class="doctor-name" value="<?php echo htmlspecialchars($appointment['doctor_name']) ?>">
                                                        <label for="doctor_specialization">Specialization: </label>
                                                        <input type="text" name="doctor_specialization" class="doctor-specialization" value="<?php echo htmlspecialchars($appointment['specialization']) ?>">
                                                        <label for="appointment_no">Appointment No.: </label>
                                                        <input type="text" name="appointment_no" class="appointment_no" value="<?php echo htmlspecialchars($appointment['appointment_number']) ?>">
                                                        <label for="session_time">Session Time: </label>
                                                        <input type="text" name="session_time" class="session_time" value="<?php echo htmlspecialchars($appointment['session_time']) ?>">
                                                        <label for="total_fee">Amount: </label>
                                                        <input type="text" name="total_fee" class="total_fee" value="Rs. <?php echo htmlspecialchars($appointment['total_fee']) ?>.00">

                                                        <?php if ($appointment["payment_status"] == "pending"): ?>
                                                            <button class="pay-button">
                                                                <a href="<?= ROOT; ?>/Clerk/receptionClerkPendingAppointmentPayNow?appointment_id=<?php echo htmlspecialchars($appointment['appointment_id']) ?>">Pay Now</a>
                                                            </button>
                                                        <?php else: ?>
                                                            <button class="print-button" onclick="handlePrint()">Print</button>
                                                        <?php endif; ?>

                                                    </form>
                                                </div>
                                            </div>
                                    </div>

                                <?php endif; ?>
                            
                            <?php $index++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <script src="<?= ROOT; ?>/assets/js/Clerk/PendingAppointments.js"></script>
        <script>
            function handlePrint() {
                window.print();
            }
        </script>
    </main>
</body>