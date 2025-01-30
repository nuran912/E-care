<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Medical records/Lab reports/Private files</title>
        <link rel="stylesheet" href="<?= ROOT; ?>/assets/css/Patient/Documents.css">
    </head>

    <body>
        <main>

            <div class="container">
                <div class="tab-box">
                    <button class="tab-button active">Medical Records</button>
                    <button class="tab-button">Lab Reports</button>
                    <button class="tab-button">Private Files</button>
                    <div class="line"></div>
                </div>

                <div class="content-box">

                    <!-- Medical Records Section -->
                    <div class="content active">

                        <?php if(isset($documents) && is_array($documents)): ?>

                            <?php foreach($documents as $document): ?>

                                <?php if($document['document_type'] == 'medical_record'):?>

                                    <div class="record-date-time"><p><?php echo htmlspecialchars($document['uploaded_at']) ?></p></div>
                                        <div class="record">
                                            <span class="label"><p><?php echo htmlspecialchars($document['document_name']) ?></p></span>
                                            <span class="ref-no"><p>Ref No: <?php echo htmlspecialchars($document['ref_no']) ?></p></span>
                                            <button class="view-button"><a href="<?= ROOT; ?>/assets/documents/<?php echo htmlspecialchars($document['document_name']) . ".pdf" ?>">View</a></button>
                                        </div>
                                    </div>
                                
                                <?php endif; ?>
                            
                            <?php endforeach; ?>
                        
                        <?php else: ?>
                            <p>No medical records found.</p>
                        <?php endif; ?>
                    

                    <!-- Lab Reports Section -->
                    <div class="content">

                        <?php if(isset($documents) && is_array($documents)): ?>

                            <?php foreach($documents as $document): ?>

                                <?php if($document['document_type'] == 'lab_report'):?>

                                    <div class="record-date-time"><p><?php echo htmlspecialchars($document['uploaded_at']) ?></p></div>
                                    <div class="record">
                                        <span class="label"><p><?php echo htmlspecialchars($document['document_name']) ?></p></span>
                                        <span class="ref-no"><p>Ref No: <?php echo htmlspecialchars($document['ref_no']) ?></p></span>
                                        <button class="view-button"><a href="<?= ROOT; ?>/assets/documents/<?php echo htmlspecialchars($document['document_name']) . ".pdf" ?>">View</a></button>
                                    </div>
                                
                                <?php endif; ?>

                            <?php endforeach; ?>
                        
                        <?php else: ?>
                            <p>No lab reports found.</p>
                        <?php endif; ?>
                    </div>
                            
                    <!-- Private Files Section -->
                    <div class="content">
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

                            <?php foreach($documents as $index => $document): ?>

                                <?php if($document['document_type'] == 'private'): ?>
                                    <div class="record-date-time"><p><?php echo htmlspecialchars($document['uploaded_at']) ?></p></div>
                                    <div class="private-record">
                                        <span class="label"><?php echo htmlspecialchars($document['document_name']) ?></span>
                                        <button class="private-view-button"><a href="<?= ROOT; ?>/assets/documents/<?php echo htmlspecialchars($document['document_name']) ?>">View</a></button>
                                            
                                        <button class="private-edit-button" data-index="<?= $index ?>">Edit</button>
                                        <div class="popup" id="popup-<?= $index ?>" style="display: none;">
                                            <div class="popup-content">
                                                <form method="POST" action="<?= ROOT; ?>/patient/documents">
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
                                
                                <?php endif; ?>
                                
                            <?php endforeach; ?>
                        </div>

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


    <!-- <?php include '../footer.view.php'; ?> -->
</html>