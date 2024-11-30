<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointment Schedule</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 60vw;
            margin: 7.5% auto;
        }

        h3 {
            margin-bottom: 20px;
            text-align: center;
        }

        .info {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .info2 {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .item2 {
            display: flex;
            flex-direction: column;
            gap: 15px;
            justify-content: space-between;
            align-items: flex-start;
            padding: 8px 0;
            border-bottom: 1px solid #e0e0e0;
            margin-top: 15px;
        }

        label {
            font-weight: bold;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .item p {
            margin: 0;
            flex-grow: 1;
            text-align: left;
        }
        .notes{
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .docs {
            margin: 0;
            flex-grow: 1;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h3>Patient Information</h3>
        <div class="info">
            <div class="item">
                <label for="name">Patient Name:</label>
                <p>Neils Armstrong</p>
            </div>
            <div class="item">
                <label for="age">Age:</label>
                <p>69</p>
            </div>
        </div>
        <div class="info2">
            <div class="item2">
                <label for="docs">Documents shared by the patient:</label>
                <div class="docs">
                    doc1
                    doc2
                </div>
            </div>
            <div class="notes">
                <label for="notes">Notes:</label>
                <div class="noteBox" contenteditable="true" style="border: 1px solid #ccc; padding: 10px; min-height: 150px; border-radius: 5px;">
                    Type your notes here...
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>
