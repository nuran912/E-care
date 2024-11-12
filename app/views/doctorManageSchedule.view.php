<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr Manage Schedule</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .container{
            display: flex;
            flex-direction: column;
            margin: 7.5%;
            padding: 5%;
        }
        .createAppt{
            border: 2px solid #908585;
            border-radius: 15px;
            padding: 7.5%;
            display: flex;
        }
        .item{
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h3>&nbsp&nbspCreate New Appointment Slot</h3>
        <div class="createAppt">
            <div >
                <div class="item">
                    <label>Date</label>
                    <input type="date" id="date" name="date">
                </div>
                <div class="item">
                    <label>Time</label>
                    <input type="time" id="date" name="time">
                </div>
            </div>
            <div>
                <div class="item">
                    <label>Hospital</label>
                    <select>
                        <option value="medical">Union Medical Hospital</option>
                        <option value="central">Union Central Hospital</option>
                        <option value="surgical">Union Surgical Hospital</option>
                    </select> 
                </div>
                <div class="item">
                    <label>No. of patients</label>
                    <input type="text" id="count" name="count">
                </div>
            </div>
        </div>
    </div>
</body>
</html>