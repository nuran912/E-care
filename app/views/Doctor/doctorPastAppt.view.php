<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr Pending Appt</title>
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
            margin-bottom: 20px;
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
        .appointments{
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }
        .date{
            font-weight: bold;
        }
        .apptInfo{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            border: 2px solid #ada8a8;
            border-radius: 6px;
            padding: 25px  5px;
            width: 100%;
        }
        .item{
            border: 2px solid #908585;
            border-radius: 4px;
            padding: 4px 10px;
            background-color: #ebe0e0;
            font-weight: bold;
        }
        .buttons{
            display: flex;
            flex-direction: row;
            gap: 10px;
            justify-content: center;
        }
        .view{
            background: rgb(88, 223, 250);
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: medium;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="tabs">
            <div class="tab"><a href="./doctorPendingAppt">Pending Appointments</a></div>
            <div class="tab active">Past Appointments</div>
        </div>
        <div class="appointments">
            <div class="date"> &nbsp&nbsp88 / 88 / 8888</div>
            <div class="apptInfo">
                <div class="item">Patient Name</div>
                <div class="item">reference Number</div>
                <div class="item">Time</div>
                <div class="buttons">
                    <button class="view">View</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>