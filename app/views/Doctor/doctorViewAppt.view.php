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
            font-size: large;
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
            flex-direction: row;
            justify-content: space-between;
            gap: 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        .info2 {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }
        .info3 {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            gap: 15px;
            margin-top: 20px;
            margin-bottom: px;
        }


        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
        }
        .item2 {
            display: flex;
            flex-direction: column;
            gap: 10px;
            justify-content: space-between;
            align-items: flex-start;
            padding: 8px 0;
            border-bottom: 1px solid #e0e0e0;
            margin-top: 15px;
        }
        .item3 {
            display: flex;
            /* justify-content: space-between; */
            align-items: center;
            padding: 8px 0;
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

        h2 {
            color: #374151;
            margin-bottom: 50px;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 4px solid #003366;
        }

        .buttons {
            display: flex; 
            flex-direction: row; 
            justify-content: space-around; /* Changed from space-around */
            gap: 20px; /* Add spacing between buttons */
            margin-top: 25px;
            padding: 0 10px; /* Add padding if buttons feel cramped */
        }

        button {
            background-color: #0E2F56;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            padding: 12px;
            border-radius: 8px;
            margin: 0; /* Reset default margins */
            width: 250px; /* Use fixed width for consistency */
            font-size: medium;
            text-align: center;
        }

        button:hover {
            background-color: #0a2340;
        }

        .noshow {
            background-color: #dc3545;
        }

        .noshow:hover {
            background-color: #c82333;
        }


    </style>
</head>
<body>
    <!-- <?php
        show($data);
    ?> -->
    <form method="POST" action="<?=ROOT?>/Doctor/doctorViewAppt/<?=$data[0]->appointment_id?>">
    <div class='container'>
        <h2>Patient Information</h2>
        <div class="info">
            <div class="item">
                <label for="name">Patient Name:</label>
                <p><?=$data[0]->patient_name?></p>
            </div>
            
            <div class="item">
                <label for="age">Appointment number:</label>
                <p><?=$data[0]->appointment_number?></p>
            </div>
        </div>
        <div class="item2">
            <label for="docs">Documents shared by the patient:</label>
            <div class="docs">
                <?php 
                    if(!empty($data[2])){
                        foreach($data[2] as $doc){  ?>
                            <p>
                                &nbsp;&nbsp;
                                <!-- the document path is appended according to pateint,doc id,doc type, doc name -->
                                <a href="<?=ROOT?>/assets/documents/<?=$data[1]->user_id?>/<?=$doc[2]?>s/<?=$doc[1]?>" target="_blank">
                                    <?=$doc[1]?>
                                </a></br>
                            </p>
                        
                <?php    }
                }else{ ?>
                    <p style="color:rgb(123, 119, 119);">No documents have been shared by the patient</p>
                <?php   }
                ?>
            </div>
        </div>
        <div class="info2">
            <label for="noteBox">Notes:</label>
            <!-- Notes are not editable if the appointment is a past appointment⬇️ -->
            <?php 
                $isReadonly = false;
                $currentDate = new DateTime();
                $sessionDate = new DateTime($data[0]->session_date);
                if($sessionDate->format('Y-m-d') < $currentDate->format('Y-m-d')){
                    $isReadonly = true;
                }
            ?>
            <textarea id="noteBox" name="noteBox" <?php echo $isReadonly ? 'readonly' : ''; ?> placeholder="Type your notes here...."  class="noteBox" style="border: 1px solid #ccc; padding: 10px; min-height: 150px; border-radius: 5px;">
                <?=$data[0]->doctor_notes?>
            </textarea>
        </div>
        <div class="info3">
            <div class="item3">
                <label for="status">Appointment status:</label>
                <select id="status" name="status" style="width: 150px; border-radius: 5px; padding: 3px; font-size:large; text-align: center;">
                <?php
                    // if the appointment is a past appointment, the status is not editable⬇️
                    if($sessionDate->format('Y-m-d') < $currentDate->format('Y-m-d')){ ?>
                        <option value="<?=$data[0]->status?>" disabled selected><?=$data[0]->status?></option>
                    <?php }else{ ?>
                    <option value="<?=$data[0]->status?>" disabled selected><?=$data[0]->status?></option>
                    <option value="completed">completed</option>
                    <option value="no show">no show</option>
                    <?php } ?>
                </select>
            </div>
            <?php 
                //finish appointment option is only there for pending appointments⬇️
                $currentDate = new DateTime();
                $sessionDate = new DateTime($data[0]->session_date);
                if($sessionDate->format('Y-m-d') >= $currentDate->format('Y-m-d')){ ?>

                    <button class="completed" type="submit">Finish appointment</button>
                
            <?php }
            ?>
        </div>
    </div>
    </form>
</body>
</html>
