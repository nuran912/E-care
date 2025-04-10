<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Lab Reports</title>
        <link rel="stylesheet" href="<?= ROOT; ?>/assets/css/Patient/Documents.css">
    </head>

    <body>
        <main>

            <div class="container">

                <div class="tab-box">
                    <div class="tab-button"><a href="./medical_records">Medical Records</a></div>
                    <div class="tab-button active">Lab Reports</div>
                    <div class="tab-button"><a href="./private_files">Private Files</a></div>
                </div>

                <div class="content-box">

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

                            <div class="record-date-time-category"><p><?php echo date('Y, F j, l',strtotime($date)); ?></p></div>
                            
                            <?php foreach($dailyDocuments as $document): ?>
                                <div class="record">
                                    <span class="ref-no"><p><?php echo htmlspecialchars($document['ref_no']) ?></p></span>
                                    <span class="label"><p><?php echo htmlspecialchars($document['document_name']) ?></p></span>
                                    <span class="doc-category"><p><?php echo htmlspecialchars($document['document_category'])?></p></span>
                                    <button class="view-button"><a href="<?= ROOT; ?>/assets/documents/<?php echo htmlspecialchars($document['document_name']) ?>" target="_blank">View</a></button>
                                </div>
                            <?php endforeach; ?>
                            
                        <?php endforeach; ?>

                    <?php else: ?>
                        <p>No lab reports found.</p>
                    <?php endif; ?>

                </div>
            </div>

            <script src="<?= ROOT; ?>/assets/js/Patient/Documents.js"></script>
        </main>
    </body>
</html>