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
            border-bottom: 4px solid #d1c9c9;
            flex-grow: 1;
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
            border: 2px solid #908585;
            border-radius: 4px;
            padding: 4px 10px;
            color: black;
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
            background: rgb(88, 223, 250);
            cursor: pointer;
            padding: 10px;
            /* margin-top: 18px; */
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size:medium;
        }
        .view:hover{
            background: rgb(70, 178, 250)
        }

        .filters{
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 50px;
            margin-top: 20px;
            padding-bottom: 3px;
        }
        input[type="date"],
        select {
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #f9fafb;
            transition: border-color 0.3s ease;
            font-size: 14px;
            color: #111827;
        }

        input[type="date"]:focus,
        select:focus {
            outline: none;
            border-color: #111827;
            background-color: #ffffff;
        }

        label {
            font-weight: 500;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .filterButton {
            background-color: #0E2F56;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
            font-size:medium;
        }

        .filterButton:hover {
            background-color: #0a2340;
        }
        
        .navs{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 100%;
            margin-top: 30px;
        }
        .navButton {
            background-color: #0E2F56;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
            font-size:small;
        }

        .navButton:hover {
            background-color: #0a2340;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="tabs">
            <div class="tab active">Pending Appointments</div>
            <div class="tab"><a href="<?=ROOT?>/Doctor/doctorPastAppt">Past Appointments</a></div>
        </div>
        <form method="post" class="filters" action="<?=ROOT?>/Doctor/doctorPendingAppt/filter">
            <label for="filteredDate">Filter By Date:</label>
            <input id="filteredDate" type="date" name="filteredDate" min="<?=date("Y-m-d");?>" value="<?= (!empty($data[0])) ? $data[0] : date("Y-m-d"); ?>">
            <button class="filterButton" type="submit">
                Search
            </button>
        </form>
        <div class="appointments">
            <?php
            if(empty($data[1])){   ?>
                <h3 style="text-align: center;">No appointments found for this date</h3>
            <?php }else{  ?>
            <div class="date"> &nbsp&nbsp<?=$data[0]?></div>
            <div style="border: 3.5px solid #ada8a8; border-radius: 6px; padding: 25px  15px; display: flex; flex-direction: column; align-items: center;">
            <?php
            foreach(array_keys($data[1]) as $apptSlot){
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
        
                foreach($data[1][$apptSlot] as $appt){
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
                        <div>
                            <label>Status</label>
                            <div class="item"><?=$appt->status?></div>
                        </div>
                        <form class="buttons" method="GET" action="<?=ROOT?>/Doctor/doctorViewAppt/<?=$appt->appointment_id?>">
                            <button class="view" type="submit">View</button>
                        </form>
                    </div>
                    <?php
                }}
            }   
            ?>
            </div> <!-- Close the appointments container here -->
            <div class="navs">
                <?php 
                    $prevDate = ((new DateTime($data[0]))->modify('-1 day')->format('Y-m-d'));
                    $nextDate = ((new DateTime($data[0]))->modify('+1 day')->format('Y-m-d'));
                ?>
                <?php 
                if($data[0] > date('Y-m-d')){  ?>
                    <form method="post" action="<?=ROOT?>/Doctor/doctorPendingAppt/filter/<?=$prevDate?>">
                        <button type="submit" class="navButton">Prev</button>
                    </form>
                <?php   }
            ?>
                <form method="post" action="<?=ROOT?>/Doctor/doctorPendingAppt/filter/<?=$nextDate?>">
                    <button type="submit" class="navButton">Next</button>
                </form> 
            </div>
        </div>
    </div>
</body>
</html>
