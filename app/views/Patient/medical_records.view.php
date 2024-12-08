<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Medical records</title>
        <link rel="stylesheet" href="<?= ROOT; ?>/assets/css/Patient/Documents.css">
    </head>

    <body>
        <main>

            <div class="container">
                
                <div class="tab-box">
                    <button class="tab-button active">Medical Records</button>
                    <button class="tab-button"><a href="./lab_reports">Lab Reports</a></button>
                    <button class="tab-button"><a href="./private_files">Private Files</a></button>
                </div>

                <div class="content-box">

                    <?php if(isset($documents) && is_array($documents)): ?>

                        <?php foreach($documents as $document): ?>

                            <?php if($document['document_type'] == 'medical_record'):?>

                                <div class="record-date-time-category">
                                    <?php echo htmlspecialchars($document['uploaded_at']) ?>
                                    <span class="document-category"><?php echo htmlspecialchars($document['document_category']) ?></span>
                                </div>

                                <div class="record">
                                    <span class="label"><p><?php echo htmlspecialchars($document['document_name']) ?></p></span>
                                    <span class="ref-no"><p>Ref No: <?php echo htmlspecialchars($document['ref_no']) ?></p></span>
                                    <button class="view-button"><a href="<?= ROOT; ?>/assets/documents/<?php echo htmlspecialchars($document['document_name']) ?>">View</a></button>
                                </div>
        
                            <?php endif; ?>

                        <?php endforeach; ?>

                    <?php else: ?>
                        <p>No medical records found.</p>
                    <?php endif; ?>

                </div>
            </div>

            <script src="<?= ROOT; ?>/assets/js/Patient/Documents.js"></script> 

        </main>
    </body>
</html>