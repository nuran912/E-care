<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Pending Appointments</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 60vw;
            margin: 7.5% auto;
            padding: 5%;
        }
        .tabs {
            display: flex;
            border-bottom: 2px solid #ddd;
            margin-bottom: 20px;
        }
        .tab {
            flex: 1;
            text-align: center;
            padding: 12px;
            cursor: pointer;
            font-weight: 500;
        }
        .tab.active {
            color: #0E2F56;
            border-bottom: 3px solid #0E2F56;
            font-weight: bold;
        }
        .tab a {
            text-decoration: none;
            color: inherit;
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
            padding: 12px 20px;
            background-color: #0E2F56;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="tabs">
            <div class="tab active">Upload Document</div>
            <div class="tab"><a href="./clerkWorkLog">Work Log</a></div>
        </div>
        <form class="documentInfo">
            <div class="section">
                <div class="item">
                    <label for="docName">Document Name</label>
                    <input type="text" id="docName" name="docName" placeholder="Enter document name" required />
                </div>
                <div class="item">
                    <label for="patientID">Patient ID</label>
                    <input type="text" id="patientID" name="patientID" placeholder="Enter patient ID" required />
                </div>
            </div>
            <div class="section">
                <div class="item">
                    <label for="refNumber">Reference Number</label>
                    <input type="text" id="refNumber" name="refNumber" placeholder="Enter reference number" required />
                </div>
                <div class="item">
                    <label for="docCategory">Document Category</label>
                    <select id="docCategory" name="docCategory" required>
                        <option value="" disabled selected>Select category</option>
                        <option value="diagnosisCard">Diagnosis Card</option>
                        <option value="bill">Bill</option>
                        <option value="blood">Blood Report</option>
                        <option value="urine">Urine Test</option>
                        <option value="prescription">Prescription</option>
                    </select>
                </div>
            </div>
            <div class="item">
                <label for="file">Choose File</label>
                <input type="file" id="file" name="file" required />
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
