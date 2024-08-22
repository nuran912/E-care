<!DOCTYPE html>
<html>
    <head></head>

        <style>
            body{
                color: white;
            }
            .background{
                background-image: url(../assets/Laboratory-background.png);
                background-size: 100vw 100vh;
                background-repeat: no-repeat;
                background-attachment: fixed;
                min-height: 100vh;
                width: 100%;
                box-sizing: border-box;
                padding: 7.5% 15%;
                overflow-y: auto;
            }
            .description{
                text-align: center;
                color: #0E2F56;
                padding-top: 100px;
                padding-bottom: 130px;
            }
            .laboratory-container{
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                text-align: center;
                border: 2px ;
                border-radius: 20px;
                padding: 40px 20px;
                max-width: 100vw;
                background: hsl(212.5, 83.7%, 19.6%, 0.9);
                margin-bottom: 10vh;
                position: relative;
            }
            .laboratory-top{
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                margin-bottom: 20px;
            }
            .laboratory-desc{
                text-align: center;
                min-width: 100px;
                min-height: 100px;
            }
            .laboratory-services{
                border: 4px solid;
                border-color: gray;
                border-radius: 20px;
                min-width: 100px;
                min-height: 100px;
                padding-right: 15px;
            }
            .laboratory-services ul{
                text-align: left;
                list-style: disc;
            }
            .laboratory-bottom{
                display: flex;
                flex-direction: row;
                border: 4px solid;
                border-color: gray;
                border-radius: 20px;
                justify-content: space-around;
                align-items: center;
                padding: 15px 10px;
                margin-left: 2.5vw;
                margin-right: 2.5vw;
            }
            .laboratory-info ul{
                text-align: left
            }
            .laboratory-info{
                border: 2px ;
                min-width: 100px;
                min-height: 100px;
            }
        </style>

    </head>
    <body>
        <?php include '../Components/Header.php' ?>
        
        <div>
            <div class="description">
                <h1 style="font-size: 4em;">Laboratories at Your Service</h1>
                <h2 style="font-size: 2.5em;">Your Health, Our Science</h2>
            </div>
            <div class="background">
                <div class="laboratory-container">
                    <div class="laboratory-top">
                        <div class="laboratory-desc">
                            <h1 style="margin-bottom: 30px;">Union Laboratories - Rajagiriya</h1>
                            <p>We are a Paediatrics centered laboratory, complete with <br>Operating Theaters and 
                                Intensive & Critical Care Wards. <br>Reputed for dengue and medical patient management.</p>
                        </div>                            
                        <div class="laboratory-services">
                            <h2>Services</h2>
                            <ul class="services">
                                <li>Blood Tests</li>
                                <li>Urine Tests</li>
                                <li>Genetic Tests</li>
                                <li>Pathology / Immunology</li>
                                <li>STD Tests</li>
                            </ul>
                        </div>
                    </div>
                    <div class="laboratory-bottom">
                        <div class="laboratory-info">
                            <ul>
                                <li>Contact nuber: 011-297 2343</li>
                                <li>Address: 181 Bernard Soysa Mawatha, Colombo 5</li>
                                <li>Working hours: 24h</li>
                            </ul>
                        </div>
                        <div><img src="../assets/Lab-map.png"></div>
                    </div>
                </div>   
                <div class="laboratory-container">
                    <div class="laboratory-top">
                        <div class="laboratory-desc">
                            <h1 style="margin-bottom: 30px;">Union Laboratories - Bambalapitiya</h1>
                            <p>We deliver international standard healthcare, in multi-specialty <br>
                            general laboratory,which is a one-stop facility for high end <br>
                            diagnostic, therapeutic and intensive care services.</p>
                        </div>                            
                        <div class="laboratory-services">
                            <h2>Services</h2>
                            <ul class="services">
                                <li>Blood Tests</li>
                                <li>Urine Tests</li>
                                <li>Genetic Tests</li>
                                <li>Pathology / Immunology</li>
                                <li>STD Tests</li>
                            </ul>
                        </div>
                    </div>
                    <div class="laboratory-bottom">
                        <div class="laboratory-info">
                            <ul>
                                <li>Contact nuber: 011-297 2344</li>
                                <li>Address: 114 Norris Canal Rd, Colombo 10</li>
                                <li>Working hours: 24h</li>
                            </ul>
                        </div>
                        <div><img src="../assets/Lab-map.png"></div>
                    </div>
                </div>   
                <div class="laboratory-container">
                    <div class="laboratory-top">
                        <div class="laboratory-desc">
                            <h1 style="margin-bottom: 30px;">Union Laboratories - Dehiwala</h1>
                            <p>We deliver a comprehensive menu of world-class surgical care, <br>
                                in a high-end facility with support from diagnosis through to<br>
                                intensive care and rehabilitation services.</p>
                        </div>                            
                        <div class="laboratory-services">
                            <h2>Services</h2>
                            <ul class="services">
                                <li>Blood Tests</li>
                                <li>Urine Tests</li>
                                <li>Genetic Tests</li>
                                <li>Pathology / Immunology</li>
                                <li>STD Tests</li>
                            </ul>
                        </div>
                    </div>
                    <div class="laboratory-bottom">
                        <div class="laboratory-info">
                            <ul>
                                <li>Contact nuber: 011-297 2345</li>
                                <li>Address: 21 Kirimandala Mawatha, Colombo 5</li>
                                <li>Working hours: 24h</li>
                            </ul>
                        </div>
                        <div><img src="../assets/Lab-map.png"></div>
                    </div>
                </div>   
            </div>
        </div>

        <?php include '../Components/Footer.php' ?>
    </body>
</html>