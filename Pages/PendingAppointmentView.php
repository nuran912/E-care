<?php 

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pending Appointment View</title>
        <link rel="stylesheet" href="../Style/PendingAppointmentView.css">
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
                            <div class="right">
                                <span>&#215;</span>
                            </div>
                        </div> -->
                    </div>

                    <div class="upload-section">
                        <label for="upload-new-document" style="color: blue;">Upload New Document</label>
                        <div class="upload-document-box">
                        <div class="input-box">
                            <input type="file" name="" id="upload" accept=".doc,.docx,.pdf,.png,.jpg,.jpeg,.zip" hidden>
                            <label for="upload" class="upload-label">
                                <p>Click here to upload</p>
                            </label>
                        </div>
                    </div>
                    </div>
                </div>

                <button class="close">Close</button>
            </div>
        </main>

        <script>
            window.addEventListener("load",() => {
                const input = document.getElementById("upload");
                const filewrapper = document.getElementById('file-wrapper');

                input.addEventListener("change",(e) => {
                    let fileName = e.target.files[0].name;
                    let fileType = e.target.value.split(".").pop();
                    fileshow(fileName,fileType);
                })

                const fileshow = (fileName,fileType) => {
                    const showfileboxElement = document.createElement("div");
                    showfileboxElement.classList.add("showfilebox");

                    const leftElement = document.createElement("div");
                    leftElement.classList.add("left");

                    const filetitleElement = document.createElement("p");
                    filetitleElement.innerHTML = fileName;

                    leftElement.append(filetitleElement);
                    showfileboxElement.append(leftElement);

                    const rightElement = document.createElement("div");
                    rightElement.classList.add("right");
                    showfileboxElement.append(rightElement);

                    const crossElement = document.createElement("span");
                    crossElement.innerHTML = "&#215";

                    rightElement.append(crossElement);
                    filewrapper.append(showfileboxElement);

                    crossElement.addEventListener('click',() => {
                        filewrapper.removeChild(showfileboxElement);
                    })
                }
            })
        </script>
    </body>
    <?php include "../Components/Footer.php"; ?>
</html>