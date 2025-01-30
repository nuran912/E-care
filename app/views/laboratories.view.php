<!DOCTYPE html>
<html>
    <head></head>

        <style>
            body{
                margin: 0;
                padding: 0;
                color: white;
                font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            }
            .background{
                background-image: url('<?php echo ROOT ?>/assets/img/Laboratory-background.png');
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
        
        <div>
            <div class="description">
                <h1 style="font-size: 4em;">Laboratories at Your Service</h1>
                <h2 style="font-size: 2.5em;">Your Health, Our Science</h2>
            </div>
            <div class="background">
                <?php foreach($data as $lab) : { ?>
                    <div class="laboratory-container">
                    <div class="laboratory-top">
                        <div class="laboratory-desc">
                            <h1 style="margin-bottom: 30px;"><?=$lab['name']?></h1></h1>
                            <p><?=$lab['description']?></p>
                        </div>                            
                        <div class="laboratory-services">
                            <h2>Services</h2>
                            <ul class="services">
                                <?=$lab['services']?>
                            </ul>
                        </div>
                    </div>
                    <div class="laboratory-bottom">
                        <div class="laboratory-info">
                            <ul>
                                <li>Contact number: 0<?=$lab['contact']?></li>
                                <li>Address: <?=$lab['address']?></li>
                                <li>Working hours: <?=$lab['working_hours']?>h</li>
                            </ul>
                        </div>
                        <div><img src="<?php echo ROOT ?>/assets/img/Lab-map.png"></div>
                    </div>
                </div> 
                <?php } endforeach; ?>  
                
            </div>
        </div>

    </body>
</html>