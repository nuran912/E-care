<?php 

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Past Appointment View</title>
        <link rel="stylesheet" href="../Style/PastAppointmentView.css">
    </head>

    <?php include "../Components/Header.php"; ?>

    <body>
        <main>
            <div class="container">

                <span class="ref-no">Reference Number : 004</span>
                <span class="appointment-date">18/08/2024</span>
                <span class="appointment-time">16:30</span>

                <form action="">
                    <div class="first-column">
                        <label for="">Patient Name : </label><input type="text" name="patientName" placeholder="John doe" disabled><br>
                        <label for="">Contact : </label><input type="tel" name="contact" placeholder="0771234567" disabled><br>
                        <label for="">Appointment no : </label><input type="text" name="appointment-no" placeholder="A001" disabled><br>
                    </div>

                    <div class="second-column">
                        <label for="">Doctor : </label><input type="text" name="doctor" placeholder="Dr. A Jonathon" disabled><br>
                        <label for="">Specialization : </label><input type="text" name="specialization" placeholder="Neurologist" disabled><br>
                        <label for="">Hospital : </label><input type="text" name="hospital" placeholder="Union Surgical Hospital" disabled><br>
                    </div>
                </form>

                <div class="document">
                    <div id="file-wrapper">
                        <h3 class="uploaded-document">Uploaded Documents:</h3>
                        <!-- <div class="showfilebox">
                            <div class="left">
                                <p>Ravi Web.pdf</p>
                            </div>
                        </div> -->
                    </div>

                    <div class="doctor-note">
                        <label for="doctor-note-label" style="color: blue;">Doctor's Notes:</label>
                        <div class="doctor-note-box"></div>
                    </div>
                </div>

                <button class="close">Close</button>
            </div>
        </main>
    </body>
    <?php include "../Components/Footer.php"; ?>
</html>