<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Log</title>
    <style>
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container{
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
            margin: 5% auto;
            padding: 5%;
            background-color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            gap: 5%;
            max-width: 800px;
            width: 100%;
        }

        .tabs{
            display: flex;
            flex-direction: row;
            justify-content: center;
            border-bottom: 2px solid #d1c9c9;
            margin-bottom: 40px;
            width: 100%;
        }

        .tab{
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            flex-grow: 1;
            position: relative;
        }

        .tab.active{
            color: #1c3a47;
            font-weight: bold;
        }

        .tab.active::after {
            content: "";
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 5px;
            border-radius: 10px;
            background-color: #1c3a47;
            transition: all 0.3s ease-in-out;
        }

        .tab, .tab a{
            color: #919191;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
        }
        
        .uploadedDocuments{
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 3px;
            align-items: flex-start;
        }

        .date{
            font-weight: bold;
            color: #1c3a47;
            margin: 20px 0 10px;
            letter-spacing: 0.1em;
        }

        .uploadedInfo{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            padding: 10px 20px;
            border: 1px solid #ccc;
            width: 100%;
            max-width: 750px;
            margin: 0 0 10px 0;
            margin-bottom: 10px;
        }

        .item{
            padding: 8px;
            background-color: #d3d3d3;
            text-align: center;
            border-radius: 4px;
            border: 1px solid #888;
        }
        
        .view{
            background-color: #0059FF;
            font-weight: bold;
            align-self: center;
            padding: 8px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            text-align: center;
            min-width: 100px;
        }

        .view a {
            text-decoration: none;
            color: white;
        }

        .set {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="tabs">
            <div class="tab"><a href="./labClerkUploadDoc">Upload Document</a></div>
            <div class="tab active">Work Log</div>
        </div>

        <div class="uploadedDocuments">

            <?php if(isset($documents) && is_array($documents)): ?>

                <?php
                    $groupedByDate = [];
                    foreach($documents as $index => $document):
                        if($document['document_type'] == 'lab_report'):
                            $dateOnly = date('Y-m-d',strtotime($document['uploaded_at']));
                            $groupedByDate[$dateOnly][] = $document;
                        endif;
                    endforeach;
                ?>
                    
                <?php foreach($groupedByDate as $date => $dailyDocuments): ?>

                    <div class="date"><p><?php echo htmlspecialchars($date); ?></p></div>

                    <?php foreach($dailyDocuments as $document): ?>

                        <div class="uploadedInfo">

                            <div class="set">
                                <h4>Patient ID</h4>
                                <div class="item"><?php echo htmlspecialchars($document['user_id']) ?></div>
                            </div>

                            <div class="set">
                                <h4>Reference Number</h4>
                                <div class="item"><?php echo htmlspecialchars($document['ref_no']) ?></div>
                            </div>

                            <div class="set">
                                <h4>Category</h4>
                                <div class="item"><?php echo htmlspecialchars($document['document_type']) ?></div>
                            </div>

                            <button class="view"><a href="<?= ROOT; ?>/assets/documents/<?php echo htmlspecialchars($document['document_name']) ?>">View</a></button>

                        </div>
                    
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
