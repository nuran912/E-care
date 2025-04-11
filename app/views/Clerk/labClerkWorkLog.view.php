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
        }

        .date{
            margin-top: 30px;
            font-weight: bold;
            font-size: large;
            color: #003366;
        }

        .uploadedInfo{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            justify-items: center;
            align-items: center;
            background-color: #003366;
            color: white;
            border-radius: 6px;
            padding: 25px  5px;
            margin-bottom: 10px;
            width: 100%;
        }

        .item{
            border: 2px solid #908585;
            border-radius: 4px;
            padding: 4px 10px;
            color: black;
            background-color: #ebe0e0;
            font-weight: bold;
            width: 170px;
            text-align: center;
        }

        label {
            font-weight: 500;
            margin-bottom: 8px;
            font-weight: bold;
        }
        
        .view{
            background: rgb(88, 223, 250);
            cursor: pointer;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size:medium;
        }

        .view:hover {
            background: rgb(70, 178, 250);
        }

        .view a {
            text-decoration: none;
            color: black;
        }

        .set {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 10px;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a,
        .pagination span {
            margin: 0 8px;
            padding: 6px 12px;
            text-decoration: none;
            background-color: #f0f0f0;
            border-radius: 4px;
            color: #333;
        }

        .pagination a:hover {
            background-color: #3366cc;
            color: white;
        }

        .pagination .current-page {
            font-weight: bold;
            background-color: #3b83ff;
            color: white;
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

                    //group documents by date

                    $groupedByDate = [];
                    foreach($documents as $index => $document):
                        if($document['document_type'] == 'lab_report'):
                            $dateOnly = date('Y-m-d',strtotime($document['uploaded_at']));
                            $groupedByDate[$dateOnly][] = $document;
                        endif;
                    endforeach;
                ?>

                <?php

                    //sort by date descending
                    krsort($groupedByDate);  

                    //pagination
                    $dates = array_keys($groupedByDate);
                    $totalPages = count($dates);
                    $currentPage = isset($_GET['page']) ? max(1,min((int)$_GET['page'],$totalPages)) : 1;

                    $selectedDate = $dates[$currentPage - 1];
                    $dailyDocuments = $groupedByDate[$selectedDate];
                ?>

                <div class="date"><p><?php echo date('Y, F j, l',strtotime($selectedDate)) ?></p></div>

                <?php foreach($dailyDocuments as $document): ?>

                    <div class="uploadedInfo">

                        <div class="set">
                            <label>Patient ID</label>
                            <div class="item"><?php echo htmlspecialchars($document['user_id']) ?></div>
                        </div>

                        <div class="set">
                            <label>Reference Number</label>
                            <div class="item"><?php echo htmlspecialchars($document['ref_no']) ?></div>
                        </div>

                        <div class="set">
                            <label>Category</label>
                            <div class="item"><?php echo htmlspecialchars($document['document_category']) ?></div>
                        </div>

                        <button class="view"><a href="<?= ROOT; ?>/assets/documents/<?php echo htmlspecialchars($document['document_name']) ?>">View</a></button>

                    </div>
                    
                <?php endforeach; ?>
                
                <!-- Pagination Controls -->
                <div class="pagination">
                    <?php if($currentPage > 1): ?>
                        <a href="?page=<?= $currentPage - 1 ?>" class="prev">Prev</a>
                    <?php else: ?>
                        <span class="prev-disabled">Prev</span>
                    <?php endif; ?>

                    <?php for($i = 1; $i <= $totalPages; $i++): ?>
                        <span class="<?= $i == $currentPage ? 'current-page' : '' ?>"><?= $i ?></span>
                    <?php endfor; ?>
                            
                    <?php if($currentPage < $totalPages): ?>
                        <a href="?page=<?= $currentPage + 1?>" class="next">Next</a>
                    <?php else: ?>
                        <span class="next-disabled">Next</span>
                    <?php endif; ?>
                </div>
             
            <?php else: ?>
                <p>No uploaded lab reports.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
