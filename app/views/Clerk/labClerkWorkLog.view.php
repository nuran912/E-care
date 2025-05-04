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

        .search {
            background-color: #0E2F56;
            border: none;
            color: white;
            font-weight: bold;
            padding: 4px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100px;
            margin-top: 20px;
        }

        .search_date {
            width: 120px;
            margin: 20px 20px 20px 10px;
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

        <form method="get" style="margin-bottom: 20px; text-align: center;">
            <label for="search-date">Search by date:</label>
            <input type="date" name="search_date" class="search_date" value="<?= isset($search_date) ? htmlspecialchars($search_date) : '' ?>" required>
            <button type="submit" class="search">Search</button>
        </form>

        <div class="uploadedDocuments">

            <?php if(empty($documents)): ?>
                
                <p style="margin-top: 30px; text-align: center;">No uploaded lab reports.</p>
            
            <?php else: ?>

                <?php if(isset($documents) && is_array($documents)): ?>

                    <?php foreach($documents as $date => $docsForDate): ?>
                        <div class="date">
                            <p><?php echo date('Y, F j, l',strtotime($date)) ?></p>
                        </div>

                        <?php foreach($docsForDate as $document): ?>

                            <div class="uploadedInfo">

                                <div class="set">
                                    <label>Patient ID</label>
                                    <div class="item"><?= htmlspecialchars($document['user_id']) ?></div>
                                </div>

                                <div class="set">
                                    <label>Reference Number</label>
                                    <div class="item"><?= htmlspecialchars($document['ref_no']) ?></div>
                                </div>

                                <div class="set">
                                    <label>Category</label>
                                    <div class="item"><?= htmlspecialchars($document['document_category']) ?></div>
                                </div>

                                <button class="view"><a href="<?= ROOT; ?>/assets/documents/<?= htmlspecialchars($document['user_id']) ?>/lab_reports/<?= htmlspecialchars($document['document_name']) ?>">View</a></button>

                            </div>
                            
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    
                    <!-- pagination setup -->
                    <?php if($search_date && $totalPages > 1): ?>
                        <div class="pagination">

                            <?php if($currentPage > 1): ?>
                                <a href="?search_date=<?= urlencode($search_date) ?>&page=<?= $currentPage - 1 ?>" class="prev">Prev</a>
                            <?php endif; ?>

                            <?php for($i = 1; $i <= $totalPages; $i++): ?>
                                <span class="<?= $i == $currentPage ? 'current-page' : '' ?>"><?= $i ?></span>
                            <?php endfor; ?>

                            <?php if($currentPage < $totalPages): ?>
                                <a href="?search_date=<?= urlencode($search_date)?>&page=<?= $currentPage + 1?>" class="next">Next</a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
