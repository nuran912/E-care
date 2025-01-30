<?php

?>

<!DOCTYPE html>
<html>

<head>
    <title>Insurance Claim</title>
    <!-- <link rel="stylesheet" href="<?= ROOT; ?>/assets/css/Patient/InsuranceClaim.css"> -->

    <style>
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            background-color: #f3f6fa;
            margin: 0;
            padding: 0;
        }

        .header-container {
            background-color: #0E2F56;
            color: white;
            text-align: center;
            padding: 80px 30px;
            /* border-radius: 10px; */
            margin-bottom: 20px;
        }

        .header-container h1 {
            font-size: 2em;
            font-weight: bold;
            margin: 0;
            padding-bottom: 5px;
        }

        .header-container p {
            font-size: 1em;
            margin-top: 10px;
        }

        .container {
            background-color: #ffffff;
            /* padding: 40px; */
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 60vw;
            margin: 7.5% auto;
            padding: 2% 3%;
        }

        h2 {
            color: #374151;
            margin-bottom: 40px;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 4px solid #003366;
            font-size: xx-large;
        }

        .insurance-claim-form {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            border: none;
            border-radius: 10px;
            background-color: inherit;
            margin-bottom: 20px;
        }

        .first-column, .second-column {
            display: inline-block;
            vertical-align: top;
            width: 48%;
            margin-right: 2%;
            gap: 15px;
        }

        .second-column {
            margin-right: 0;
        }

        .insurance-claim-form label {
            /* display: block;
            font-size: 12px;
            color: #0E2F56;
            font-weight: bold;  */
            margin-bottom: 15px; 
            font-weight: 500;
            font-weight: bold;
            margin-left: 10px;
        }

        .insurance-claim-form input[type="text"],
        .insurance-claim-form input[type="email"],
        .insurance-claim-form select {
            width: 90%;
            /* padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #CED4DA;
            border-radius: 10px;
            font-size: 14px;
            background-color: #f8f8f8;
            margin-top: 5px; */
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #f9fafb;
            transition: border-color 0.3s ease;
            font-size: 14px;
            color: #111827;
            margin-top: 5px;
        }

        /* .insurance-claim-form select {
            appearance: none;
            -webkit-appearance: none;
        } */

        .insurance-claim-form input::placeholder {
            color: #aaa;
        }

        .insurance-claim-form input[type="submit"] {
            display: block;
            width: 200px;
            padding: 10px;
            margin: 20px auto;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .insurance-claim-form input[type="submit"]:hover {
            background-color: #218838;
        }

        .box {
            padding: 10px;
            width: 100%;
            border: 1px solid #CED4DA;
            border-radius: 10px;
            box-sizing: border-box;
            /* margin-top: 20px; */
        }

        .upload-label p {
            width: 100%;
            min-height: 50px;
            color: #aaa;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: normal;
            font-size: 1em;
            cursor: pointer;
        }

        .uploaded {
            margin-top: 20px;
            font-size: 0.85em;
            font-weight: bold;
            color: #a5a5a5;
        }

        #file-wrapper {
            margin-bottom: 30px;
        }

        .showfilebox {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 10px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            margin-top: 10px;
            width: 100%;
            max-width: 100%;
            flex-wrap: nowrap;
            min-width: 0;
        }

        .left {
            display: flex;
            align-items: center;
            flex: 1;
            overflow: hidden;
            min-width: 0;
        }

        .left p {
            font-size: 12px;
            color: #292f42;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        .right {
            flex-shrink: 0;
        }

        .right span {
            background: #18a7ff;
            color: white;
            width: 18px;
            height: 18px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            cursor: pointer;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .error-message {
            color: red;
            font-size: 13px;
            display: block;
            margin-top: 2px;
        }
    </style>

</head>

<body>
    <div class="header-container">
        <h1>File Your Reimbursement Claim</h1>
        <h1>Quick and Easy.</h1>
        <p>Get In Touch With Your Insurance With Our<br>Authenticated Claim Process and Avoid Inconvenience.</p>
    </div>
        <div class="container">
        <h2>Insurance Claim Form</h2>

        <div class="insurance-claim-form">
            <form id="claim-form" action="">

                <div class="first-column">

                    <label for="hospital">Hospital</label><br>
                    <select name="hospital" id="hospital">
                        <option value="default" disabled selected>Select a hospital</option>
                        <option value="medical">Union Medical Hospital</option>
                        <option value="central">Union Central Hospital</option>
                        <option value="surgical">Union Surgical Hospital</option>
                    </select>
                    <span class="error-message"></span><br><br>

                    <label for="insuranceCompany">Insurance Company</label><br>
                    <select name="insuranceCompany" id="insurance-company">
                        <option value="default" disabled selected>Select an insurance company</option>
                        <option value="allianzLanka">Allianz Lanka</option>
                        <option value="softlogicLife">Softlogic Life</option>
                        <option value="ceylincoLife">Ceylinco Life</option>
                        <option value="AIASriLanka">AIA Sri Lanka</option>
                    </select>
                    <span class="error-message"></span><br><br>

                    <label for="policyHolderName">Name of Policy Holder/Member</label>
                    <input type="text" name="policyHolderName" id="policy-holder-name">
                    <span class="error-message"></span><br><br>

                    <label for="relationship">Relationship to Policy Holder/Member</label><br>
                    <input type="text" name="relationship" id="relationship">
                    <span class="error-message"></span><br><br>

                    <label for="patientFullName">Patient's Full Name</label><br>
                    <input type="text" name="patientFullName" id="patient-full-name">
                    <span class="error-message"></span><br><br>

                    <label for="email">Email</label><br>
                    <input type="email" name="email" id="email">
                    <span class="error-message"></span><br><br>

                    <label for="documents">Relevant Documents</label>
                    <div class="box">
                        <div class="input-box">
                            <input type="file" name="" id="upload" accept=".doc,.docx,.pdf,.png,.jpg,.jpeg,.zip" hidden>
                            <label for="upload" class="upload-label">
                                <p>Click here to uplaod</p>
                            </label>
                        </div>
                    </div>

                    <div id="file-wrapper">
                        <h3 class="uploaded">Uploaded Documents</h3>
                    </div>
                </div>

                <div class="second-column">
                    <label for="claimType">Claim Type</label><br>
                    <select name="claimType" id="claim-type">
                        <option value="default" disabled selected>Select the claim type</option>
                        <option value="inPatient">In-patient reimbursement</option>
                        <option value="opd">OPD reimbursement</option>
                    </select>
                    <span class="error-message"></span><br><br>

                    <label for="policyNumber">Policy Number</label><br>
                    <input type="text" name="policyNumber" id="policy-number">
                    <span class="error-message"></span><br><br>

                    <label for="nic">NIC of Policy Holder/Member</label><br>
                    <input type="text" name="nic" id="nic">
                    <span class="error-message"></span><br><br>

                    <label for="memberNumber">Member Number</label><br>
                    <input type="text" name="memberNumber" id="member-number">
                    <span class="error-message"></span><br><br>

                    <label for="contactNumber">Policy Holder's Contact Number</label><br>
                    <input type="text" name="contactNumber" id="contact-number">
                    <span class="error-message"></span><br><br>

                    <label for="bankDetails">Bank Details</label><br>
                    <input type="text" name="bankName" id="bank-name" placeholder="Bank Name">
                    <span class="error-message"></span><br>
                    <input type="text" name="accountName" id="account-name" placeholder="Account Name">
                    <span class="error-message"></span><br>
                    <input type="text" name="accountNumber" id="account-number" placeholder="Account Number">
                    <span class="error-message"></span><br>
                </div>

                <input type="submit" value="Submit" onclick="validateForm(event)">
            </form>
        </div>
    </div>

    <script>
        function validateForm(event) {
            event.preventDefault();
            const errorMessages = document.querySelectorAll('.error-message');

            errorMessages.forEach((message) => {
                message.textContent = '';
            });

            const fields = [{
                    id: 'hospital',
                    label: 'Hospital',
                    type: 'select'
                },
                {
                    id: 'insurance-company',
                    label: 'Insurance Company',
                    type: 'select'
                },
                {
                    id: 'policy-holder-name',
                    label: 'Name of Policy Holder/Member'
                },
                {
                    id: 'relationship',
                    label: 'Relationship to Policy Holder/Member'
                },
                {
                    id: 'patient-full-name',
                    label: "Patient's Full Name"
                },
                {
                    id: 'email',
                    label: 'Email'
                },
                {
                    id: 'claim-type',
                    label: 'Claim Type',
                    type: 'select'
                },
                {
                    id: 'policy-number',
                    label: 'Policy Number'
                },
                {
                    id: 'nic',
                    label: 'NIC of Policy Holder/Member'
                },
                {
                    id: 'member-number',
                    label: "Member Number"
                },
                {
                    id: 'contact-number',
                    label: "Policy Holder's Contact Number"
                },
                {
                    id: 'bank-name',
                    label: 'Bank Name'
                },
                {
                    id: 'account-name',
                    label: 'Account Name'
                },
                {
                    id: 'account-number',
                    label: 'Account Number'
                }
            ];

            let isValid = true;

            fields.forEach((field) => {
                const input = document.getElementById(field.id);
                const errorSpan = input.nextElementSibling;

                if (field.type == 'select' && input.value == "default") {
                    errorSpan.textContent = `${field.label} is required`;
                    isValid = false;
                } else if (input.value.trim() === "") {
                    errorSpan.textContent = `${field.label} is required`;
                    isValid = false;
                }
            });

            //Email validation
            const email = document.getElementById('email');
            const emailError = email.nextElementSibling;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email.value && !emailPattern.test(email.value)) {
                emailError.textContent = 'Please enter a valid email address';
                isValid = false;
            }

            //Phone number validation
            const phone = document.getElementById('contact-number');
            const phoneError = phone.nextElementSibling;
            const phonePattern = /^(0\d{9}|(\+94)\d{9})$/;

            if (phone.value && !phonePattern.test(phone.value)) {
                phoneError.textContent = 'Please enter a valid phone number';
                isValid = false;
            }

            if (isValid) {
                document.getElementById('claim-form').submit();
            }
        }

        //File uploads
        window.addEventListener("load", () => {
            const input = document.getElementById("upload");
            const filewrapper = document.getElementById('file-wrapper');

            input.addEventListener("change", (e) => {
                let fileName = e.target.files[0].name;
                let fileType = e.target.value.split(".").pop();
                fileshow(fileName, fileType);
            })

            const fileshow = (fileName, fileType) => {
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

                crossElement.addEventListener('click', () => {
                    filewrapper.removeChild(showfileboxElement);
                })
            }
        })
    </script>
</body>

</html>