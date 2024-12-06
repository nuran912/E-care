<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr Pending Appt</title>
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
            margin-bottom: 40px;
            width: 100%;
        }
        .tab{
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            flex-grow: 1;
            font-size: 1.17em;
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
            width: 150px;
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
        <?php 
            $pastApptCount = 0;
            foreach($data as $appt){
                if((new DateTime($appt->session_date)) < (new DateTime())){
                    $pastApptCount++;
                }
            }
            // show($pastApptCount);
            if($pastApptCount == 0){
                echo "<h3>No past appointments found.</h3>";
            }else{
            usort($data, function($a, $b) {
                    return strtotime($a->session_date) <=> strtotime($b->session_date); // Compare dates as timestamps
                });
            foreach($data as $appt) : { 
                if ((new DateTime($appt->session_date)) < new DateTime()){
        ?>
        <div class="appointments">
            <div class="date"> &nbsp&nbsp<?=$appt->session_date?></div>
            <div class="apptInfo">
                <div>
                    <label>Patient Name</label>
                    <div class="item"><?=$appt->patient_name?></div>
                </div>
                <div>
                    <label>reference Number</label>
                    <div class="item"><?=$appt->appointment_id?></div>
                </div>
                <div>
                    <label>Time</label>
                    <div class="item"><?=$appt->session_time?></div>
                </div>
                <div class="buttons">
                    <button class="view">View</button>
                </div>
            </div>
        </div>
        <?php }} endforeach; } ?>
    </div>
</body>
</html>