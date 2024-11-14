<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Medical records/Lab reports/Private files</title>
        <link rel="stylesheet" href="../Style/MedicalLabPrivate.css">
    </head>

    <?php include '../Components/Header.php'; ?>

    <body>
        <main>
            <div class="container">
                <div class="tab-box">
                    <button class="tab-button active">Medical Records</button>
                    <button class="tab-button">Lab Reports</button>
                    <button class="tab-button">Private Files</button>
                    <div class="line"></div>
                </div>

                <div class="content-box">

                    <!-- Medical Records Section -->
                    <div class="content active">
                        <div class="record-date">14 / 08 / 2024</div>
                        <div class="record">
                            <span class="label">Diagnosis Card</span>
                            <span class="ref-no">Ref no: DC000001</span>
                            <span class="doctor">Dr. A Jonathan</span>
                            <button class="view-button">View</button>
                        </div>

                        <div class="record">
                            <span class="label">Diagnosis Card</span>
                            <span class="ref-no">Ref no: DC000001</span>
                            <span class="doctor">Dr. A Jonathan</span>
                            <button class="view-button">View</button>
                        </div>

                        <div class="record">
                            <span class="label">Diagnosis Card</span>
                            <span class="ref-no">Ref no: DC000001</span>
                            <span class="doctor">Dr. A Jonathan</span>
                            <button class="view-button">View</button>
                        </div>
                    </div>

                    <!-- Lab Reports Section -->
                    <div class="content">
                        <div class="record-date">14 / 08 / 2024</div>
                        <div class="record">
                            <span class="label">Blood Report</span>
                            <span class="ref-no">Ref no: LT000001</span>
                            <button class="view-button">View</button>
                        </div>

                        <div class="record">
                            <span class="label">Blood Report</span>
                            <span class="ref-no">Ref no: LT000001</span>
                            <button class="view-button">View</button>
                        </div>

                        <div class="record">
                            <span class="label">Blood Report</span>
                            <span class="ref-no">Ref no: LT000001</span>
                            <button class="view-button">View</button>
                        </div>

                        <div class="record">
                            <span class="label">Blood Report</span>
                            <span class="ref-no">Ref no: LT000001</span>
                            <button class="view-button">View</button>
                        </div>
                    </div>

                    <!-- Private Files Section -->
                    <div class="content">
                        <div class="upload-container">
                            <div class="upload-document">
                                <input type="file" name="" id="real-file" hidden="hidden">
                                <button type="button" id="custom-button">Upload Document</button>
                                <span id="custom-text">No file chosen.</span>
                            </div>
                        </div>

                        <div class="record-date">04 / 08 /2024</div>
                        <div class="record">
                            <span class="label">Private file 1</span>
                            <button class="view-button">View</button>
                            <button class="delete-button">Delete</button>
                        </div>

                        <div class="record">
                            <span class="label">Private file 1</span>
                            <button class="view-button">View</button>
                            <button class="delete-button">Delete</button>
                        </div>

                        <div class="record">
                            <span class="label">Private file 1</span>
                            <button class="view-button">View</button>
                            <button class="delete-button">Delete</button>
                        </div>

                        <div class="record">
                            <span class="label">Private file 1</span>
                            <button class="view-button">View</button>
                            <button class="delete-button">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                const tabs = document.querySelectorAll('.tab-button');
                const all_content = document.querySelectorAll('.content');

                tabs.forEach((tab,index) => {
                    tab.addEventListener('click',(e) => {
                        tabs.forEach(tab => {tab.classList.remove('active')});
                        tab.classList.add('active');

                        var line = document.querySelector('.line');
                        line.style.width = e.target.offsetWidth + "px";
                        line.style.left = e.target.offsetLeft + "px";

                        all_content.forEach(content => {content.classList.remove('active')});
                        all_content[index].classList.add('active');
                    });
                });

                const realFileButton = document.getElementById('real-file');
                const customButton = document.getElementById('custom-button');
                const customText = document.getElementById("custom-text");

                customButton.addEventListener('click',() => {
                    realFileButton.click();
                });

                realFileButton.addEventListener('change',() => {
                    if (realFileButton.value) {
                        customText.innerHTML = realFileButton.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
                    }
                    else {
                        customText.innerHTML = "No file chosen.";
                    }
                });
            </script>
        </main>
    </body>


    <?php include '../Components/Footer.php'; ?>
</html>