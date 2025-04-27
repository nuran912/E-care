<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointment Schedule</title>
    <style>
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            background-color: #f3f6fa;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 60vw;
            margin: 7.5% auto;
            padding: 2.5% 5%;
        }

        .item {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 500;
            margin-bottom: 8px;
            font-weight: bold;
        }

        select {
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #f9fafb;
            transition: border-color 0.3s ease;
            font-size: 14px;
            color: #111827;
        }
        select:focus {
            outline: none;
            border-color: #111827;
            background-color: #ffffff;
        }

        button {
            background-color: #0E2F56;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
            font-size:medium
        }

        button:hover {
            background-color: #0a2340;
        }
        .appointments{
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }
        .date{
            margin-top: 15px;
            font-weight: bold;
            font-size: large;
            color: #003366;
        }
        .apptInfo{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            /* border: 2px solid #ada8a8; */
            background-color: #003366;
            color: white;
            border-radius: 6px;
            padding: 25px  5px;
            width: 100%;
        }
        .item2{
            /* border: 2px solid #908585; */
            border-radius: 4px;
            padding: 4px 10px;
            background-color: #ebe0e0;
            font-weight: bold;
            color: black;
        }
        .item1{
            display: flex;
            flex-direction: column;   
        }
        .buttons{
            display: flex;
            flex-direction: row;
            gap: 15px;
            justify-content: center;
        }
        .view{
            background: rgb(88, 223, 250);
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: medium;
        }
        .cancel{
            background: #dc3545;
            padding: 5px 10px;
            margin: 12.5px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size:medium
        }
        .cancel:hover{
            background-color: #c82333;
        }

        .error {
            position:relative;
            /* background-color: darkred; */
            /* border-color: #c82333; */
            color: #0E2F56;
            border: 3px red solid;
            padding: 5px;
            border-radius: 10px;
            font-size: 14px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* width: 200px; */
            justify-content: center;
            align-items: center;
            display: flex;
            margin: auto;
            margin-top: 10px;
            margin-bottom: 20px;
            text-align: center;
            /* z-index: 1000; */
        }

        .success {
            position:relative;
            /* background-color: green; */
            /* border-color: lightgreen; */
            color: #0E2F56;
            border: 3px lightgreen solid;
            padding: 5px;
            border-radius: 10px;
            font-size: 14px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* width: 200px; */
            justify-content: center;
            align-items: center;
            display: flex;
            margin: auto;
            margin-top: 10px;
            margin-bottom: 20px;
            text-align: center;
            /* z-index: 1000; */
        }
        
        .filters {
            display: flex;
            align-items: center;  /* Ensure vertical centering */
            gap: 20px;
            justify-content: center;
        }

        .filters label {
            font-size: 16px;
            white-space: nowrap;
        }

        .filters input, .filters select,
        .filters button {
            height: 40px;
            padding: 8px 12px;
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        input[type=date]{
            padding: 0px 7px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #f9fafb;
            transition: border-color 0.3s ease;
            font-size: 14px;
            color: #111827;
        }
        input[type="date"]:focus{
            outline: none;
            border-color: #111827;
            background-color: #ffffff;
        }

        .tabs{
            display: flex;
            flex-direction: row;
            justify-content: center;
            width: 100%;
            margin-bottom: 40px;
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

        .pageNav{
            display: flex;
            flex-direction: row;
            gap: 3px;
        }

        .alert {
         padding: 15px;
         margin: 15px 0;
         border-radius: 5px;
         font-size: 16px;
         font-weight: bold;
         text-align: center; 
         font-family: 'Lucida Sans';
         justify-content: center;
         align-items: center;
         
         }

         .alert-success {
         background-color: #d4edda;
         color: #155724;
         border: 1px solid #c3e6cb;
         margin-left: 30%;
         
         width: 40%;
         }

         .alert-danger {
         background-color: #f8d7da;
         color: #721c24;
         border: 1px solid #f5c6cb;
         width: 40%;
         margin-left: 30%;
         
         }

    </style>
</head>
<body>

    <?php show($_SESSION); ?>

     <!-- Success Message -->
    <?php if (isset($_SESSION['cancelSuccess'])): ?>
         <div id="successMessage" class="alert alert-success">
            <?= htmlspecialchars($_SESSION['cancelSuccess']); ?>
         </div>
         <?php unset($_SESSION['cancelSuccess']); ?>
    <?php endif; ?>

    <!-- Error Message -->
    <?php if (isset($_SESSION['cancelError'])): ?>
         <div id="errorMessage" class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['cancelError']); ?>
         </div>
         <?php unset($_SESSION['cancelError']); ?>
      <?php endif; ?>

    <div class="container">
        <div class="tabs">
            <div class="tab"><a href="<?=ROOT?>/Doctor/doctorCreateApptSlot">Create New Slot</a></div>
            <div class="tab active">Appointment Slots</div>
        </div>

        <?php 
            $currentFilter = $data[0][0][0];
            $navStartDate = $data[0][0][1]; //filter start date
            switch ($currentFilter){
                case "Week":
                    $mod = "7 days";
                    break;
                case "Date":
                    $mod = "1 day";
                    break;
                case "Month":
                    $mod = "28 days";
                    break;
            }
            $prev = ((new DateTime($data[0][0][1]))->modify('-'.$mod)->format('Y-m-d'));
            $next = ((new DateTime($data[0][0][1]))->modify('+'.$mod)->format('Y-m-d'));
            $navEndDate = ((new DateTime($next))->modify("-1 day")->format('Y-m-d'));   //filter end date
        ?>
        <form method="post" class="filters" action="<?=ROOT?>/Doctor/doctorApptSlots/filter">
            <label for="filteredDate">Filter By :</label>
            <select id="filter" name="filter">
                <option value="<?=$data[0][0][0]?>"><?=$data[0][0][0]?></option>
                <?php if($data[0][0][0] != "Week"){ ?><option value="Week">Week</option><?php } ?>
                <?php if($data[0][0][0] != "Date"){ ?><option value="Date">Date</option><?php } ?>
                <?php if($data[0][0][0] != "Month"){ ?><option value="Month">Month</option><?php } ?>
            </select>
            <?php if($currentFilter == "Date"){ ?>
                <input id="selectedDate" type="date" name="selectedDate" value="<?= (!empty($data[0][0][1])) ? $data[0][0][1] : date("Y-m-d"); ?>">
            <?php } ?>
            <button class="filterButton" type="submit">Search</button>
        </form>
            
        <?php 
            if($currentFilter != "Date"){   ?>
                <h2 style="text-align: center;">From &nbsp; <?=(new DateTime($navStartDate))->format('F d, Y')?> &nbsp; to &nbsp;<?=(new DateTime($navEndDate))->format('F d, Y')?></h2>
            <?php   }
        ?>

        <!-- pagination attempt-->
        <?php
            $appointments = $data[0][1];  // all appointments grouped by date
            //This gets a flat list of the date keys, to render the appointment headers
            $allDates = array_keys($appointments);
            $daysPerPage = 3;   //will display 3 days worth of appointments, regardless of the no. of appointments

            //get the page number from the url. if none , default to 1. else retrieve from url.
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;   
            $currentPage = max($currentPage, 1);    //Just a safety check: makes sure page number isn't less than 1 (eg: if someone types ?page=0).

            $totalPages = ceil(count($allDates) / $daysPerPage);    //Calculate how many pages of 3-day chunks are needed.
            $startIndex = ($currentPage - 1) * $daysPerPage;    //calculate the starting index for slicing the dates.
            //array_slice takes only the relevant 3 date keys for the current page. keeps "2025-04-01" as the key instead of reindexing to 0, 1, 2
            $pageDates = array_slice($allDates, $startIndex, $daysPerPage, true);
        ?>


        <div class="appointments">
        <?php
        if(empty($data[0][1])){   ?>
        <!-- <h2 style="text-align: center;">No appointments scheduled.</h2> -->
            <?php if($currentFilter == 'Date'){ ?>
                <h2 style="text-align: center;">No appointment slots found for <?=(new DateTime($navStartDate))->format('F d, Y')?></h2>
            <?php }  
                if($currentFilter != 'Date'){?>
                <h2 style="text-align: center;">No appointment slots found for this <?=$currentFilter?></h2>
            <?php }}else{  ?>
        <?php // foreach(array_keys($data[0][1]) as $dateSlot) : ?>
        <?php foreach($pageDates as $dateSlot) : ?>
            <div class="date"> &nbsp<?php echo (new DateTime($dateSlot))->format('F d, Y') ?></div>
            <?php foreach($data[0][1][$dateSlot] as $appt) :
                $hospital = new Hospital;
                $hospital = $hospital->getHospitalById($appt->hospital_id);
            ?>
                <div class="apptInfo">
                    <div class="item1">
                        <label>hospital</label>
                        <div class="item2"> <?php echo $hospital->name ?> </div>
                    </div>
                    <div class="item1">
                        <label>start time</label>
                        <div class="item2"> <?php echo $appt->start_time ?> </div>
                    </div>
                    <div class="item1">
                        <label>end time</label>
                        <div class="item2"> <?php echo (new DateTime($appt->start_time))->modify('+'.$appt->duration.' hours')->format('H:i:s'); ?> </div>
                    </div>
                    <div class="item1">
                        <label>patient slots</label>
                        <div class="item2"> <?php echo $appt->filled_slots ." of ".$appt->total_slots." filled " ?> </div>
                    </div>
                    <div class="item1">
                        <label>status</label>
                        <div class="item2"> <?php echo $appt->status ?> </div>
                    </div>
                    <?php if($appt->status != "cancelled"){ ?>
                        <form class="buttons" method="GET" action="<?= ROOT?>/Doctor/doctorApptSlots/cancelAppointment/<?= $appt->id ?>" onsubmit="return confirmCancel()">
                            <button class="cancel">Cancel</button>
                        </form>
                    <?php } ?>
                </div>
            <?php endforeach; ?>
        <?php endforeach; }?>
            
        </div>
        <div class="navs">
                
                <form method="post" action="<?=ROOT?>/Doctor/doctorApptSlots/navs/<?=$prev?>/<?=$currentFilter?>">
                    <div>
                        <button type="submit" class="navButton">Prev <?=$currentFilter?></button>
                    </div>
                </form>

                <!-- new method -->
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


                <form method="post" action="<?=ROOT?>/Doctor/doctorApptSlots/navs/<?=$next?>/<?=$currentFilter?>">
                    <div>
                        <button type="submit" class="navButton">Next <?=$currentFilter?></button>
                    </div>
                </form> 
            </div>
    </div>
    <script>
        function confirmCancel(){
            return confirm("Are you sure you want to cancel this appointment?");
        }
        // Auto-hide success/error messages after 5 seconds
        document.addEventListener("DOMContentLoaded", function() {
            const successMessage = document.getElementById("successMessage");
            const errorMessage = document.getElementById("errorMessage");
            const passSuccessMessage = document.getElementById("passSuccessMessage");
            const passErrorMessage = document.getElementById("passErrorMessage");
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = "none";
                    unset($_SESSION['cancelSuccess']);
                    // window.location.href = "<?php echo ROOT ?>/Patient/profile";
                  }, 5000);
               }
               if (errorMessage) {
                  setTimeout(() => {
                     errorMessage.style.display = "none";
                     unset($_SESSION['cancelError']);
                  }, 5000);
               }
            });
    </script>
</body>
</html>