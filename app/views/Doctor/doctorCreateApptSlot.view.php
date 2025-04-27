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

        h2 {
            color: #374151;
            margin-bottom: 40px;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 4px solid #003366;
        }

        .createAppt {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 7.5%;
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

        input[type="date"],
        input[type="time"],
        input[type="text"],
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
        input[type="time"]:focus,
        input[type="text"]:focus,
        select:focus {
            outline: none;
            border-color: #3b82f6;
            background-color: #ffffff;
        }

        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(50%);
        }

        .form-footer {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            margin-bottom: 20px;
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
        a{
            text-decoration: none;
            color: #003366;
        }

        @media (max-width: 600px) {
            .form-group {
                grid-template-columns: 1fr;
            }
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
            padding: 10px;
            margin-top: 8px;
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

        .tabs{
            display: flex;
            flex-direction: row;
            justify-content: center;
            margin-bottom: 40px;
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
    <!-- <?php show($_SESSION); ?> -->

    <!-- Success Message -->
    <?php if (isset($_SESSION['createSuccess'])): ?>
         <div id="successMessage" class="alert alert-success">
            <?= htmlspecialchars($_SESSION['createSuccess']); ?>
         </div>
         <?php unset($_SESSION['createSuccess']); ?>
    <?php endif; ?>

    <!-- Error Message -->
    <?php if (isset($_SESSION['createError'])): ?>
         <div id="errorMessage" class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['createError']); ?>
         </div>
         <?php unset($_SESSION['createError']); ?>
      <?php endif; ?>

    <div class='container'>
        <div class="tabs">
            <div class="tab active">Create New Slot</div>
            <div class="tab"><a href="<?=ROOT?>/Doctor/doctorApptSlots">Appointment Slots</a></div>
        </div>
        <form class="createAppt" method="POST" action="<?=ROOT?>/Doctor/doctorCreateApptSlot/create">
            <div class="form-group">
                <div class="item">
                    <label for="date">&nbsp&nbspDate</label>
                    <input type="date" id="date" name="date" min="<?=date("Y-m-d");?>" required>
                </div>
                <div class="item">
                    <label for="count">&nbsp&nbspNo. of patients</label>
                    <input type="text" id="count" name="count" placeholder="Enter number of patients" required>
                </div>
            </div>
            <div class="form-group">
                <div class="item">
                    <label for="duration">&nbsp&nbspDuration of slot(hours)</label>
                    <input type="text" id="duration" name="duration" required>
                </div>
                <div class="item">
                    <label for="time">&nbsp&nbspTime</label>
                    <input type="time" id="time" name="time" min="09:00" max="21:00" required>
                </div>
            </div>
            <div class="form-group">
                <div class="item">
                    <label for="hospital">&nbsp&nbspHospital</label>
                    <select id="hospital" name="hospital" required>
                        <?php
                            $hospitals = new Hospital;
                            $hospitals = $hospitals->getAll();
                            foreach($hospitals as $hospital){ ?>
                                <option value="<?=$hospital->id?>"><?=$hospital->name?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="item">
                    <label for="repeat">&nbsp&nbspRepeat</label>
                    <select id="repeat" name="repeat" required>
                        <option value="0">Never</option>
                        <option value="1">Weekly (For 4 Weeks)</option>
                        <option value="2">Monthly (For 4 Months)</option>
                    </select>
                </div>
            </div>
            <div class="form-footer">
                <button type="submit">Create Slot</button>
            </div>
        </form>
    </div>

    <script>
         // Auto-hide success/error messages after 5 seconds
         document.addEventListener("DOMContentLoaded", function() {
            const successMessage = document.getElementById("successMessage");
            const errorMessage = document.getElementById("errorMessage");
            const passSuccessMessage = document.getElementById("passSuccessMessage");
            const passErrorMessage = document.getElementById("passErrorMessage");
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = "none";
                    // window.location.href = "<?php echo ROOT ?>/Patient/profile";
                  }, 5000);
               }
               if (errorMessage) {
                  setTimeout(() => {
                     errorMessage.style.display = "none";
                  }, 5000);
               }
            });
    </script>
</body>
</html>