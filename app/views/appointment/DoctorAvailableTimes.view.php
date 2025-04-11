<?php

$appointments = $data['appointments'];
$totalpages=$data['totalPages'];
$currentPage=$data['currentPage'];
$doctor_name = $data['doctor_name'];
$doctor_specialization = $data['doctor_specialization'];
$doctorId = $data['doctorId'];



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
                <img class="profimg " src="<?php echo ROOT; ?>/assets/img/profilepic-img/profilepic.svg" alt="Doctor's Profile Picture">
            </div>
            <div class="doctor-name"><?php echo $doctor_name; ?></div>
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
                            <?php
                            $available_slotts=$at->total_slots - $at->filled_slots;
                            ?>
                            <div class="slots-info"><?= $available_slotts?> of <?= $at->total_slots ?> slots available
                                                        
                        </div>
                            <div class="time"><?= date('H:i', strtotime($at->start_time)) ?> - <?= date('H:i', strtotime($at->start_time . ' + ' . $at->duration . ' hours')) ?></div>
                            <div class="hospital"> Rs.<?php echo $at->hospital_fee + $at->Doctor_fee ?> + service charge</div>
                            <?php if ($available_slotts == 0): ?>
                                <button class="schedule-btndis" disabled>No Appointments  Available</button>
                            <?php else: ?>
                                <a href="<?php echo ROOT; ?>/Appointmentdetails?availableTimeId=<?= $at->appointment_id ?>">
                                    <button class="schedule-btn">Schedule Appointment</button>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach ?>
                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
    <div class="pagination" style="display: flex; justify-content: center; gap: 10px; margin-top: 20px;">

        <!-- Previous Button -->
        <?php if ($currentPage > 1): ?>
            <a href="?doctor_id=<?= $_GET['doctor_id'] ?>&page=<?= $currentPage - 1 ?>" class="prev-btn">⟨ Prev</a>
        <?php else: ?>
            <span class="disabled prev-btn">⟨ Prev</span>
        <?php endif; ?>

        <!-- Page Numbers -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?doctor_id=<?= $_GET['doctor_id'] ?>&page=<?= $i ?>" class="<?= ($i == $currentPage) ? 'active-page' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <!-- Next Button -->
        <?php if ($currentPage < $totalPages): ?>
            <a href="?doctor_id=<?= $_GET['doctor_id'] ?>&page=<?= $currentPage + 1 ?>" class="next-btn">Next ⟩</a>
        <?php else: ?>
            <span class="disabled next-btn">Next ⟩</span>
        <?php endif; ?>

    </div>
<?php endif; ?>




            <?php endif; ?>
        </div>
    </div>
</body>

</html>