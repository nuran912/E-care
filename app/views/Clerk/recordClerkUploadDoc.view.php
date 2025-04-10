<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Documents</title>
    <style>
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container{
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
            margin: 5% auto;
            padding: 5%;
            background-color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            gap: 5%;
            max-width: 800px;
            width: 100%;
        }

        form.documentInfo {
            width: 100%;
            max-width: 600px;
            margin-top: 20px;
        }

        .tabs{
            display: flex;
            flex-direction: row;
            justify-content: center;
            border-bottom: 2px solid #d1c9c9;
            margin-bottom: 30px;
            width: 100%;
        }

        .tab{
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            flex-grow: 1;
            position: relative;
        }

        .tab.active{
            color: #1c3a47;
            font-weight: bold;
        }

        .tab.active::after {
            content: "";
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 5px;
            border-radius: 10px;
            background-color: #1c3a47;
            transition: all 0.3s ease-in-out;
        }

        .tab, .tab a{
            color: #919191;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .section {
            display: flex;
            gap: 20px;
        }

        .item {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-size: 14px;
            font-weight: 500;
        }

        input[type="text"], select, input[type="file"] {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
            transition: border-color 0.2s ease-in-out;
        }

        input[type="text"]:focus, select:focus, input[type="file"]:focus {
            border-color: #007BFF;
        }

        button {
            padding: 10px 20px;
            background-color: #0E2F56;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        button:hover {
            background-color: #0056b3;
        }

        .buttons{
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="tabs">
            <div class="tab active">Upload Document</div>
            <div class="tab"><a href="./recordClerkWorkLog">Work Log</a></div>
        </div>

        <form class="documentInfo" method="POST" enctype="multipart/form-data">

            <div class="section">
                <div class="item">
                    <label for="patientEmail">Patient Email</label>
                    <input type="text" id="patientEmail" name="patient_email" placeholder="Enter patient email address" required />
                </div>

                <div class="item">
                    <label for="refNumber">Reference Number</label>
                    <input type="text" id="refNumber" name="ref_no" placeholder="Enter reference number" required />
                </div>
            </div>

            <input type="hidden" name="uploaded_by" value="<?= htmlspecialchars($_SESSION['USER']->user_id)?>">

            <div class="section">
                <div class="item">
                    <label for="document_category">Document Category</label>
                    <select id="documentCategory" name="document_category" required>
                        <option value="" disabled selected>Select a document category</option>
                        <option value="prescription">Prescription</option>
                        <option value="diagnosis_card">Diagnosis Card</option>
                        <option value="medical_bill">Medical Bill/Invoice</option>
                        <option value="discharge_summary">Discharge Summary</option>
                        <option value="admission_note">Admission Note</option>
                        <option value="treatment_plan">Treatment Plan</option>
                        <option value="operative_report">Operative Report</option>
                        <option value="progress_notes">Progress Notes</option>
                        <option value="referral_letter">Referral Letter</option>
                        <option value="immunization_record">Immunization Record</option>
                        <option value="allergy_record">Allery Record</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="item">
                    <label for="file">Choose File</label>
                    <input type="file" id="file" name="file" accept=".pdf,.png,.jpeg,.jpg" required />
                </div>
            </div>

            <div class="buttons">
                <button type="submit" name="upload">Submit</button>
                <button type="reset">Cancel</button>
            </div>

        </form>
    </div>
</body>
</html>
