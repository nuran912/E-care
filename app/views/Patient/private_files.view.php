<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Private files</title>
        <link rel="stylesheet" href="<?= ROOT; ?>/assets/css/Patient/Documents.css">
    </head>

    <body>
        <main>

            <div class="container">

                <div class="tab-box">
                    <div class="tab-button"><a href="./medical_records">Medical Records</a></div>
                    <div class="tab-button"><a href="./lab_reports">Lab Reports</a></div>
                    <div class="tab-button active">Private Files</div>
                </div>

                <div class="content-box">
                    <div class="upload-container">
                        <div class="upload-document">
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['USER']->user_id)?>">
                                <input type="hidden" name="uploaded_by" value="<?= htmlspecialchars($_SESSION['USER']->user_id)?>">
                                <input type="hidden" name="document_type" value="private">
                                <input type="file" id="real-file" name="real-file" hidden="hidden" accept=".pdf,.png,.jpg,.jpeg">
                                <button type="button" id="custom-button">Choose a Document</button>
                                <span id="custom-text">No file chosen.</span><br>
                                <button type="submit" name="upload" id="private-submit-button">Submit</button>
                            </form>
                        </div>
                    </div>

                

                    <?php if(isset($documents) && is_array($documents)): ?>

                        <?php
                            $groupedByDate = [];

                            foreach($documents as $index => $document):
                                if($document['document_type'] == 'private'):
                                    $dateOnly = date('Y-m-d',strtotime($document['uploaded_at']));
                                    $groupedByDate[$dateOnly][] = $document;
                                endif;
                            endforeach;
                        ?>

                        <?php foreach($groupedByDate as $date => $dailyDocuments): ?>

                            <div class="record-date-time-category"><p><?php echo htmlspecialchars($date); ?></p></div>

                            <?php foreach($dailyDocuments as $document): ?>
                                <div class="private-record">

                                    <span class="label"><?php echo htmlspecialchars($document['document_name']) ?></span>

                                    <div class="button-group">
                                        <button class="private-view-button"><a href="<?= ROOT; ?>/assets/documents/<?php echo htmlspecialchars($document['document_name']) ?>" target="_blank">View</a></button>
                                        
                                        <button class="private-edit-button" data-index="<?= $index ?>">Edit</button>
                                        <div class="popup" id="popup-<?= $index ?>" style="display: none;">
                                            <div class="popup-content">
                                                <form method="POST" action="<?= ROOT; ?>/patient/private_files">
                                                    <input type="hidden" name="document_id" value="<?php echo htmlspecialchars($document['document_id']) ?>">
                                                    <label for="document_name">Update Document Name:</label><br>
                                                    <input type="text" name="document_name" class="document-name" value="<?php echo htmlspecialchars($document['document_name']) ?>">
                                                    <button type="submit" name="submit" class="submit">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    
                                        <form method="POST" onsubmit="return confirmDelete();">
                                            <input type="hidden" name="document_id" value="<?php echo htmlspecialchars($document['document_id']) ?>">
                                            <input type="hidden" name="document_name" value="<?php echo htmlspecialchars($document['document_name']) ?>">
                                            <button type="submit" name="delete" class="private-delete-button">Delete</button>
                                        </form>
                                    </div>

                                </div>
                            <?php endforeach; ?>    
                              
                        <?php endforeach; ?>

                    <?php else: ?>
                        <p>No private files found.</p>
                    <?php endif; ?>

                </div>
            </div>

            <script>
                //delete confirmation box
                function confirmDelete() {
                    return confirm("Are you sure you want to delete this file?");
                }
            </script>

            <script src="<?= ROOT; ?>/assets/js/Patient/Documents.js"></script>
        </main>
    </body>
</html>