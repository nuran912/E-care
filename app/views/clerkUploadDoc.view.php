<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Pending Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .container{
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
            margin: 7.5%;
            padding: 5%;
            background-color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            gap: 5%;
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
        }
        .tab.active{
            color: #003366;
            border-bottom: 3px solid #0E2F56;
            font-weight: bold;
        }
        .tab a{
            text-decoration: none;
            color: #003366;
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
            <div class="buttons">
                <button type="submit">Submit</button>
                <button type="reset">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>
