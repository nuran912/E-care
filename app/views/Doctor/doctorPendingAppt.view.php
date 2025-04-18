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

        .navButton.active {
            background-color: #0d62cb;
            text-decoration: underline;
        }

        .navButton:disabled {
            background-color: #d1d1d1;
            cursor: not-allowed;
            color: #9e9e9e; 
        }

        .pageNav{
            display: flex;
            flex-direction: row;
            gap: 3px;
        }
        
    </style>
</head>
<body>
    <?php
        // show($data);
    ?>
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

        <!-- pagination attempt-->
        <?php
            $appointments = $data[1];
            
            if(!empty($appointments)){
                $allSlots = array_keys($appointments);
                $slotsPerPage = 1;
    
                //get the page number from the url. if none , default to 1. else retrieve from url.
                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
                $currentPage = max($currentPage, 1);
    
                $totalPages = ceil(count($allSlots) / $slotsPerPage); 
                $startIndex = ($currentPage - 1) * $slotsPerPage;
                $slotTime = array_slice($allSlots, $startIndex, $slotsPerPage, true);
                // show($slotTime);
            }
        ?>

        <div class="appointments">
            <h2 style="text-align: center;">Appointments for <?=(new DateTime($data[0]))->format('F d, Y')?></h2>
            <?php
            if(empty($data[1])){   ?>
                <h3 style="text-align: center;">No appointments found for this date</h3>
            <?php }else{  ?>
            <!-- <div class="date"> &nbsp&nbsp<?=$data[0]?></div> -->
            <!-- <div style="border: 3.5px solid #ada8a8; border-radius: 6px; padding: 25px  15px; display: flex; flex-direction: column; align-items: center;"> -->
            <?php
            if(!empty($appointments)){
            // foreach(array_keys($data[1][$slotTime[0]]) as $apptSlot){
                $slot = new Availabletime;
                $hospital = new Hospital;
                $slot = $slot->getByScheduleId($slotTime[$currentPage-1]);
                $hospital = $hospital->getHospitalById($slot->hospital_id);
                ?>
                <div style="width:100%; display: flex; flex-direction: row; justify-content:space-between">
                    <div class="date"> &nbsp&nbsp<?=$slot->start_time?></div>
                    <div class="date"> &nbsp&nbsp<?=$hospital->name?></div>
                </div>
                <?php
                foreach($data[1][$slotTime[$currentPage-1]] as $appt){
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
                    <?php   }
                }}
            // }   
            ?>
            <!-- </div> Close the appointments container here -->
            <div class="navs">
                <?php 
                    $prevDate = ((new DateTime($data[0]))->modify('-1 day')->format('Y-m-d'));
                    $nextDate = ((new DateTime($data[0]))->modify('+1 day')->format('Y-m-d'));
                ?>
                <?php 
                $actionUrl = ($data[0] > date('Y-m-d')) ? ROOT . "/Doctor/doctorPendingAppt/filter/$prevDate" : "";
                $disableButton = ($data[0] <= date('Y-m-d')) ? 'disabled' : ''; ?>
                    <form method="post" action="<?= $actionUrl ?>">
                        <button type="submit" class="navButton" <?= $disableButton ?>>Prev Date</button>
                    </form>
                
                <?php
                if(!empty($appointments)){  ?>
                <!-- pages -->
                <div class="pageNav">
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?= $currentPage - 1 ?>"><button class="navButton">Prev Page</button></a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?= $i ?>"><button class="navButton <?= $i == $currentPage ? 'active' : '' ?>"><?= $i ?></button></a>

                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?= $currentPage + 1 ?>"><button class="navButton">Next Page</button></a>
                    <?php endif; ?>
                </div>
                <?php   }
                ?>

                <form method="post" action="<?=ROOT?>/Doctor/doctorPendingAppt/filter/<?=$nextDate?>">
                    <button type="submit" class="navButton">Next Date</button>
                </form> 
            </div>
            
        </div>
    </div>
</body>
</html>
