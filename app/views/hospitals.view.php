
<!DOCTYPE html>
<html>
    <head><

        <style>
            body{
                color: white;
            }
            .background{
                background-image: url('<?php echo ROOT ?>/assets/img/Hospital-background.jpg');
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
            .hospital-container{
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
            .hospital-top{
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                margin-bottom: 20px;
            }
            .hospital-desc{
                text-align: center;
                min-width: 100px;
                min-height: 100px;
            }
            .hospital-services{
                border: 4px solid;
                border-color: gray;
                border-radius: 20px;
                min-width: 100px;
                min-height: 100px;
                padding-right: 15px;
            }
            .hospital-services ul{
                text-align: left;
                list-style: disc;
            }
            .hospital-bottom{
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
            .hospital-info ul{
                text-align: left
            }
            .hospital-info{
                border: 2px ;
                min-width: 100px;
                min-height: 100px;
            }
        </style>

    </head>
    <body>
        
        <div>
            <div class="description">
                <h1 style="font-size: 4em;">Healthcare Centres at Your Service</h1>
                <h2 style="font-size: 2.5em;">Your Health, Our Network</h2>
            </div>
            <div class="background">
                <div class="hospital-container">
                    <div class="hospital-top">
                        <div class="hospital-desc">
                            <h1 style="margin-bottom: 30px;">Union Medical Hospital</h1>
                            <p>We are a Paediatrics centered hospital, complete with <br>Operating Theaters and 
                                Intensive & Critical Care Wards. <br>Reputed for dengue and medical patient management.</p>
                        </div>                            
                        <div class="hospital-services">
                            <h2>Services</h2>
                            <ul class="services">
                                <li>Family Physician</li>
                                <li>Diabetes Centre</li>
                                <li>Psychiactric Care</li>
                                <li>Radiology</li>
                            </ul>
                        </div>
                    </div>
                    <div class="hospital-bottom">
                        <div class="hospital-info">
                            <ul>
                                <li>Contact nuber: 011-297 2343</li>
                                <li>Address: 181 Bernard Soysa Mawatha, Colombo 5</li>
                                <li>Working hours: 24h</li>
                            </ul>
                        </div>
                        <div><img src="<?php echo ROOT ?>/assets/img/Hospital-map.png"></div>
                    </div>
                </div>   
                <div class="hospital-container">
                    <div class="hospital-top">
                        <div class="hospital-desc">
                            <h1 style="margin-bottom: 30px;">Union Central Hospital</h1>
                            <p>We deliver international standard healthcare, in multi-specialty <br>
                            general hospital,which is a one-stop facility for high end <br>
                            diagnostic, therapeutic and intensive care services.</p>
                        </div>                            
                        <div class="hospital-services">
                            <h2>Services</h2>
                            <ul class="services">
                                <li>Neonatal Care</li>
                                <li>Intensive Care</li>
                                <li>Cosmetic Centre</li>
                                <li>Urology</li>
                            </ul>
                        </div>
                    </div>
                    <div class="hospital-bottom">
                        <div class="hospital-info">
                            <ul>
                                <li>Contact nuber: 011-297 2344</li>
                                <li>Address: 114 Norris Canal Rd, Colombo 10</li>
                                <li>Working hours: 24h</li>
                            </ul>
                        </div>
                        <div><img src="<?php echo ROOT ?>/assets/img/Hospital-map.png"></div>
                    </div>
                </div>   
                <div class="hospital-container">
                    <div class="hospital-top">
                        <div class="hospital-desc">
                            <h1 style="margin-bottom: 30px;">Union Surgical Hospital</h1>
                            <p>We deliver a comprehensive menu of world-class surgical care, <br>
                                in a high-end facility with support from diagnosis through to<br>
                                intensive care and rehabilitation services.</p>
                        </div>                            
                        <div class="hospital-services">
                            <h2>Services</h2>
                            <ul class="services">
                                <li>Heart Centre</li>
                                <li>Gneral Surgery</li>
                                <li>Orthapedics</li>
                                <li>Cancer Care</li>
                            </ul>
                        </div>
                    </div>
                    <div class="hospital-bottom">
                        <div class="hospital-info">
                            <ul>
                                <li>Contact nuber: 011-297 2345</li>
                                <li>Address: 21 Kirimandala Mawatha, Colombo 5</li>
                                <li>Working hours: 24h</li>
                            </ul>
                        </div>
                        <div><img src="<?php echo ROOT ?>/assets/img/Hospital-map.png"></div>
                    </div>
                </div>   
            </div>
        </div>

    </body>
</html>