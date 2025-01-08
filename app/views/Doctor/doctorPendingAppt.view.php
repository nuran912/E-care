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
            margin-bottom: 10px;
            width: 100%;
        }
        .tab{
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            flex-grow: 1;
            border-bottom: 4px solid #d1c9c9;
            font-size: x-large;
        }
        .tab.active{
            color: #003366;
            border-bottom: 4px solid #003366;
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
            margin-top: 30px;
            font-weight: bold;
            font-size: large;
            color: #003366;
        }
        .apptInfo{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            justify-items: center;
            align-items: center;
            /* border: 2px solid #ada8a8; */
            background-color: #003366;
            color: white;
            border-radius: 6px;
            padding: 25px  5px;
            margin-bottom: 10px;
            width: 100%;
        }
        .item{
            /* border: 2px solid #908585; */
            color: black;
            border-radius: 4px;
            padding: 4px 10px;
            background-color: #ebe0e0;
            font-weight: bold;
            width: 150px;
        }
        .buttons{
            display: flex;
            flex-direction: row;
            gap: 15px;
            justify-content: center;
        }
        .view{
            /* background: rgb(88, 223, 250);
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: medium;
            padding: 7.5px; */
            background: rgb(88, 223, 250);
            cursor: pointer;
            padding: 10px;
            margin-top: 8px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size:medium;
        }
        .view:hover{
            background: rgb(70, 178, 250)
        }
        /* .cancel{
            background: rgb(250, 65, 65);
            padding: 10px;
            margin-top: 8px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size:medium;
        } */
        
    </style>
</head>
<body>
    <div class="container">
        <div class="tabs">
            <div class="tab active">Pending Appointments</div>
            <div class="tab"><a href="./doctorPastAppt">Past Appointments</a></div>
        </div>
        <div class="appointments">
        <?php 
            $pendingApptCount = 0;
            foreach(array_keys($data) as $date){
                if((new DateTime($date)) >= (new DateTime())){
                    $pendingApptCount++;
                }
            }
            if($pendingApptCount == 0){
                echo "<h3>No pending appointments found.</h3>";
            }else{
                foreach(array_keys($data) as $date){
                    
                    if((new DateTime($date)) >= (new DateTime())){   
                        ?>
                        <div class="date"> &nbsp&nbsp<?=$date?></div>
                        <div style="border: 3.5px solid #ada8a8; border-radius: 6px; padding: 25px  15px; display: flex; flex-direction: column; align-items: center;">
                        <?php
                        foreach(array_keys($data[$date]) as $apptSlot){
                            $slot = new Availabletime;
                            $hospital = new Hospital;
                            $slot = $slot->getByScheduleId($apptSlot);
                            $hospital = $hospital->getHospitalById($slot->hospital_id);
                            ?>
                            <div style="width:100%; display: flex; flex-direction: row; justify-content:space-between">
                                <div class="date"> &nbsp&nbsp<?=$slot->start_time?></div>
                                <div class="date"> &nbsp&nbsp<?=$hospital->name?></div>
                            </div>
                            <?php
                    
                            foreach($data[$date][$apptSlot] as $appt){
                                ?>
                                <div class="apptInfo">
                                    <div style="align-self: center;">
                                        <label>Patient Name</label>
                                        <div class="item"><?=$appt->patient_name?></div>
                                    </div>
                                    <div>
                                        <label>appointment Number</label>
                                        <div class="item"><?=$appt->appointment_number?></div>
                                    </div>
                                    <div>
                                        <label>Time</label>
                                        <div class="item"><?=$appt->session_time?></div>
                                    </div>
                                    <!-- <div class="buttons">
                                        <button class="view">View</button>
                                        <button class="cancel">Cancel</button>
                                    </div> -->
                                    <form class="buttons" method="GET" action="">
                                        <button class="view" >View</button>
                                    </form>
                                </div>
                                <?php
                            }   
                        }   ?>
                    </div>
                    <?php
                    }
                }
            }
        ?>
        </div>
    </div>
</body>
</html>