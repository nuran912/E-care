
<!DOCTYPE html>
<html>
    <head>

        <style>
            body{
                margin: 0;
                padding: 0;
                color: white;
                font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
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
        <?php
    function slugify($text) {
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text)));
}
    ?>
    
        <div>
            <div class="description">
                <h1 style="font-size: 4em;">Healthcare Centres at Your Service</h1>
                <h2 style="font-size: 2.5em;">Your Health, Our Network</h2>
            </div>
            <div class="background">
                
                <?php foreach($data as $hospital) : { ?> 
                    <div class="hospital-container" id="<?= slugify($hospital['name']) ?>" >
                    <div class="hospital-top">
                        <div class="hospital-desc">
                            <h1 style="margin-bottom: 30px;"><?=$hospital['name']?></h1>
                            <p><?=$hospital['description']?></p>
                        </div>                            
                        <div class="hospital-services">
                            <h2>Services</h2>
                            <ul class="services">
                                <?=$hospital['services']?>  
                            </ul>
                        </div>
                    </div>
                    <div class="hospital-bottom">
                        <div class="hospital-info">
                            <ul>
                                <li>Contact nuber: 0<?=$hospital['contact']?></li>
                                <li>Address: <?=$hospital['address']?></li>
                                <li>Working hours: <?=$hospital['working_hours']?></li>
                            </ul>
                        </div>
                        <div><img src="<?php echo ROOT ?>/assets/img/Hospital-map.png"></div>
                    </div>
                </div>  
                <?php } endforeach; ?>
                
            </div>
        </div>
    </body>
</html>