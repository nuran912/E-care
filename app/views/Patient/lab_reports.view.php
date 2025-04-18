<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Lab reports</title>
        <link rel="stylesheet" href="<?= ROOT; ?>/assets/css/Patient/Documents.css">
    </head>

    <body>
        <main>

            <div class="container">

                <div class="tab-box">
                    <button class="tab-button"><a href="./medical_records">Medical Records</a></button>
                    <button class="tab-button active">Lab Reports</button>
                    <button class="tab-button"><a href="./private_files">Private Files</a></button>
                </div>

                <div class="content-box">

                    <?php if(isset($documents) && is_array($documents)): ?>

                        <?php foreach($documents as $document): ?>

                            <?php if($document['document_type'] == 'lab_report'):?>

                                <div class="record-date-time-category">
                                    <?php echo htmlspecialchars($document['uploaded_at']) ?>
                                </div>
                                
                                <div class="record">
                                    <span class="label"><p><?php echo htmlspecialchars($document['document_name']) ?></p></span>
                                    <span class="ref-no"><p>Ref No: <?php echo htmlspecialchars($document['ref_no']) ?></p></span>
                                    <button class="view-button"><a href="<?= ROOT; ?>/assets/documents/<?php echo htmlspecialchars($document['document_name']) ?>" target="_blank">View</a></button>
                                </div>
        
                            <?php endif; ?>

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