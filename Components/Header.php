<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/Style/Header.css">
        <style type="text/css">
            body{ margin: 0;
            }
            nav{ 
            }
            .navbar{ background: rgb(88, 223, 250); font-family: sans-serif; padding: 5px 10px; 
            }
            .navdiv{ display: flex; align-items: center; justify-content:space-between;
            }
            li{ list-style: none; display: inline-block; margin-right: 25px;
            }
            li a{ color: black; font-size: 18px; font-weight: bold; text-decoration: none;
            }
            button{ background-color: #0E2F56; border-radius: 7px; flex-grow: 1; display: inline-flex; justify-content: center; padding: 4px 6px;    
            }
            button a{color: white; font-weight: bold; font-size: 18px; text-decoration: none;
            }
        </style>
    </head>

    <body>
        <nav class="navbar">
            <div class="navdiv">
                <div class="logo-div">
                    <a href="../Pages/Home.php" class="logo">
                        <?php include '../assets/icons/Logo_white.svg'; ?><br>
                        <?php include '../assets/icons/UNION_HOSPITAL_white.svg'; ?></a>
                </div>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Services</a></li>
                    <li><button style="color: blue"><a href="../Pages/Appointment.php">Appointment</a></button></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <button style="margin-left: 150px; margin-right: 50px;"><a href="../Pages/SignIn.php">Sign In</a></button>
                </ul>
            </div>
        </nav>
    </body>
</html>