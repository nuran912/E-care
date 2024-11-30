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
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 60vw;
            margin: 7.5% auto;
            padding: 5%;
        }

        h3 {
            color: #374151;
            margin-bottom: 24px;
            text-align: center;
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
        }

        button:hover {
            background-color: #2563eb;
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
        .item2{
            border: 2px solid #908585;
            border-radius: 4px;
            padding: 4px 10px;
            background-color: #ebe0e0;
            font-weight: bold;
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
            background: rgb(250, 65, 65);
            padding: 10px;
            margin-top: 8px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size:medium
        }
        
    </style>
</head>
<body>
    <div class='container'>
        <h3>Create New Appointment Slot</h3>
        <form class="createAppt" method="POST" action="<?=ROOT?>/Doctor/doctorManageSchedule/create">
            <div class="form-group">
                <div class="item">
                    <label for="date">&nbsp&nbspDate</label>
                    <input type="date" id="date" name="date">
                </div>
                <!-- <div class="item">
                    <label for="time">&nbsp&nbspTime</label>
                    <input type="time" id="time" name="time">
                </div> -->
                <div class="item">
                    <label for="count">&nbsp&nbspNo. of patients</label>
                    <input type="text" id="count" name="count" placeholder="Enter number of patients">
                </div>
            </div>
            <div class="form-group">
                <div class="item">
                    <label for="duration">&nbsp&nbspDuration of slot(hours)</label>
                    <input type="text" id="duration" name="duration">
                </div>
                <!-- <div class="item">
                    <label for="fee">&nbsp&nbspAppointment fee</label>
                    <input type="text" id="fee" name="fee">
                </div> -->
                <div class="item">
                    <label for="time">&nbsp&nbspTime</label>
                    <input type="time" id="time" name="time">
                </div>
            </div>
            <div class="form-group">
                <div class="item">
                    <label for="hospital">&nbsp&nbspHospital</label>
                    <select id="hospital" name="hospital">
                        <option value="UNION MEDICAL">Union Medical Hospital</option>
                        <option value="UNION CENTRAL">Union Central Hospital</option>
                        <option value="UNION SURGICAL">Union Surgical Hospital</option>
                    </select>
                </div>
                <!-- <div class="item">
                    <label for="count">&nbsp&nbspNo. of patients</label>
                    <input type="text" id="count" name="count" placeholder="Enter number of patients">
                </div> -->
            </div>
            <div class="form-footer">
                <button type="submit">Create Slot</button>
            </div>
        </form>
        <!-- <h3><a href="./doctorUpcomingAppt">View Upcoming Appointments</a></h3> -->
    </div>
    <div class="container">
        <h3>Upcoming Appointments</h3>      
        <?php
            usort($data, function($a, $b) {
                return strtotime($a->date) <=> strtotime($b->date); // Compare dates as timestamps
            });
            foreach($data as $appt) :
                $hospital = new Hospital;
                $hospital = $hospital->getHospitalById($appt->hospital_id);
                // show($hospital);
                // show($hospital[0]->name);
                // $hospitalName = $hospital->name;
                // show(gettype($appt->date));
                // show(((new DateTime($appt->date))->format('Y-m-d')));
                // show(gettype($appt));
                // show((new DateTime())->format('Y-m-d'));
                if(((new DateTime($appt->date))->format('Y-m-d')) > (new DateTime())->format('Y-m-d')){  ?>
                <!-- show((new DateTime($appt['current_date']))->format('Y-m-d')); -->
            <div class="appointments">
            <div class="date"> &nbsp<?php echo $appt->date ?></div>
            <div class="apptInfo">
                <div>
                    <label>hospital</label>
                    <div class="item2"><?php echo $hospital[0]->name ?></div>
                </div>
                <div>
                    <label>start time</label>
                    <div class="item2"><?php echo $appt->start_time ?></div>
                </div>
                <div>
                    <label>end time</label>
                    <div class="item2"><?php echo (new DateTime($appt->start_time))->modify('+'.$appt->duration.' hours')->format('H:i:s'); ?></div>
                </div>
                <div>
                    <label>total patients</label>
                    <div class="item2"><?php echo $appt->total_slots ?></div>
                </div>
                <form class="buttons" method="GET" action="<?= ROOT?>/Doctor/doctorManageSchedule/cancelAppointment/<?= $appt->id ?>"  onsubmit="return confirmCancel()">
                    <button class="cancel" >Cancel</button>
                </form>
            </div>
        </div>
            <br/>
        <?php
            }
        endforeach;  
        ?>
    </div>
    <script>
        function confirmCancel(){
            return confirm("Are you sure you want to cancel this appointment?");
        }
    </script>
</body>
</html>