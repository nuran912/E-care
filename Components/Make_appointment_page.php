<!DOCTYPE html>
<html lang="en">

        <head>
    <meta charset="UTF-8">
    <title>Doctor Search</title>
    <link rel="stylesheet" href="../Style/Make_appointment.css" />
</head>

<body>
    <div class="search-container">
        <h2>Doctor Search</h2>
        <form method="GET" action="search_action_url_here">

            <div class="form-group">
                <label for="doctor-name">Doctor Name:</label>
                <input type="text" id="doctor-name" name="doctor-name" placeholder="Enter doctor's name">
            </div>

            <div class="form-group">
                <label for="hospital">Hospital:</label>
                <input type="text" id="hospital" name="hospital" placeholder="Enter hospital name">
            </div>

            <div class="form-group">
                <label for="specialization">Specialization:</label>
                <input type="text" id="specialization" name="specialization" placeholder="Enter specialization">
            </div>

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date">
            </div>

            <div class="button-container">
                <button type="submit" class="search-button">Search</button>
                <!-- <button type="reset" class="reset-button">Reset</button> -->
            </div>
        </form>
    </div>
</body>

</html>