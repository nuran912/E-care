<?php

$appointments = $data['appointments'];
$doctor_name = $data['doctor_name'];
$doctor_specialization = $data['doctor_specialization'];
$doctorId = $data['doctorId'];

// var_dump($appointments, $doctor_name, $doctor_specialization);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor Appointment page</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/DoctorAvailableTimes.css">
</head>

<body>
    <div class="container">
        <!-- Doctor Card -->
        <div class="doctor-card">
            <div class="profile-image">
                <img src="<?php echo ROOT; ?>/assets/img/profilepic-img/profilepic.svg" alt="Doctor's Profile Picture">
            </div>
            <div class="doctor-name">Dr. <?php echo $doctor_name; ?></div>
            <div class="specialization"><?php echo isset($doctor_specialization) ? $doctor_specialization : 'Specialization not available'; ?></div>
            <a href="<?php echo ROOT; ?>/DoctorProfilecard?id=<?= $doctorId ?>">
                <button class="view-profile-btn">View Profile</button>
            </a>
        </div>
        <!-- Time Slots Container -->
        <div class="time-slots-container">
            <?php if ($noAppointmentsMessage): ?>
                <!-- Display message if no appointments are available -->
                <div class="no-appointments-message"><?php echo $noAppointmentsMessage; ?></div>
            <?php else: ?>
                <!-- Display available appointments -->
                <?php foreach ($appointments as $at): ?>

                    <div class="time-slot-card">
                        <div class="date"><?= date('l, d F Y', strtotime($at->appointment_date)); ?><span class="location"><?php echo $at->hospital_name ?></span></div>
                        <div class="slot-details">
                            <div class="slots-info"><?= $at->filled_slots ?> of <?= $at->total_slots ?> slots available</div>
                            <div class="time"><?= date('H:i', strtotime($at->start_time)) ?> - <?= date('H:i', strtotime($at->start_time . ' + ' . $at->duration . ' hours')) ?></div>
                            <div class="hospital"> Rs.<?php echo $at->hospital_fee + $at->Doctor_fee ?> + service charge</div>
                            <a href="<?php echo ROOT; ?>/Appointmentdetails?availableTimeId=<?= $at->appointment_id ?>">
                                <button class="schedule-btn">Schedule Appointment</button>
                            </a>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>