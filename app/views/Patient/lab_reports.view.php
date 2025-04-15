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
                            
                        <?php foreach($documents as $document): ?>

                            <div class="record-date-time-category">
                                <p><?php echo date('Y, F j, l',strtotime($document['uploaded_at'])); ?></p>
                            </div>
                            <div class="record">
                                <span class="ref-no"><p><?php echo htmlspecialchars($document['ref_no']) ?></p></span>
                                <span class="label"><p><?php echo htmlspecialchars($document['document_name']) ?></p></span>
                                <span class="doc-category"><p><?php echo htmlspecialchars($document['document_category'])?></p></span>
                                <button class="view-button"><a href="<?= ROOT; ?>/assets/documents/<?php echo htmlspecialchars($document['document_name']) ?>" target="_blank">View</a></button>
                            </div>
                        <?php endforeach; ?>
                        
                        <!-- Pagination Controls -->
                        <div class="pagination">
                            <?php if($currentPage > 1): ?>
                                <a href="?page=<?= $currentPage - 1 ?>" class="prev">Prev</a>
                            <?php endif; ?>

                            <?php for($i = 1; $i <= $totalPages; $i++): ?>
                                <span class="<?= $i == $currentPage ? 'current-page' : '' ?>"><?= $i ?></span>
                            <?php endfor; ?>
                            
                            <?php if($currentPage < $totalPages): ?>
                                <a href="?page=<?= $currentPage + 1?>" class="next">Next</a>
                            <?php endif; ?>
                        </div>

                    <?php else: ?>
                        <p>No lab reports found.</p>
                    <?php endif; ?>

                </div>
            </div>

            <script src="<?= ROOT; ?>/assets/js/Patient/Documents.js"></script>
        </main>
    </body>
</html>