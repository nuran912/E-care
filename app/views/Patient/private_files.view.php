<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Private files</title>
        <link rel="stylesheet" href="<?= ROOT; ?>/assets/css/Patient/Documents.css">
        <style>
            .alert {
                padding: 15px;
                margin: 15px 0;
                border-radius: 5px;
                font-size: 16px;
                font-weight: bold;
                text-align: center; 
                font-family: 'Lucida Sans';
                justify-content: center;
                align-items: center;  
            }

            .alert-danger {
                background-color: #f8d7da;
                color: #721c24;
                border: 1px solid #f5c6cb;
                width: 55%;
                margin-left: 20%;
            }
        </style>
    </head>

    <body>

        <!-- Error Message -->
        <?php if (isset($data['same_name_error'])): ?>
        <div id="errorMessage" class="alert alert-danger">
            <?= htmlspecialchars($data['same_name_error']); ?>
        </div>
        <?php unset($data['error']); ?>
        <?php endif; ?>

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
                                <input type="file" id="real-file" name="real-file" hidden="hidden" accept=".pdf,.png,.jpg,.jpeg" required>
                                <button type="button" id="custom-button">Upload a Document</button>
                                <span id="custom-text">No file chosen.</span><br>
                                <button type="submit" name="upload" id="private-submit-button">Submit</button>
                            </form>
                        </div>
                    </div>

                    <?php if (empty($documents)): ?>
                        <p style="margin-top: 30px; text-align: center;">No private files available.</p>

                    <?php else: ?>
                        <?php if(isset($documents) && is_array($documents)): ?>

                            <?php $popupIndex = 0; ?>

                            <?php foreach($documents as $document): ?>

                                <div class="record-date-time-category">
                                    <p><?php echo date('Y, F j, l',strtotime($document['uploaded_at'])); ?></p>
                                </div>

                                <div class="private-record">

                                    <span class="label"><?php echo htmlspecialchars($document['document_name']) ?></span>

                                    <div class="button-group">
                                        
                                        <button class="private-view-button">
                                            <a href="<?= ROOT; ?>/assets/documents/<?= htmlspecialchars($_SESSION['USER']->user_id)?>/private_files/<?= htmlspecialchars($document['document_name']) ?>" target="_blank">View</a>
                                        </button>
                                        
                                        <?php 
                                            $document_name = pathinfo($document['document_name'],PATHINFO_FILENAME);
                                            $extension = pathinfo($document['document_name'],PATHINFO_EXTENSION);
                                        ?>

                                        <button class="private-edit-button" data-index="<?= $popupIndex ?>">Edit</button>
                                        <div class="popup" id="popup-<?= $popupIndex ?>" style="display: none;">
                                            <div class="popup-content">
                                                <form method="POST" action="<?= ROOT; ?>/Patient/private_files">
                                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['USER']->user_id)?>">
                                                    <input type="hidden" name="document_id" value="<?= htmlspecialchars($document['document_id']) ?>">
                                                    <label for="document_name">Update Document Name:</label><br>
                                                    <input type="text" name="document_name" class="document-name" value="<?= $document_name ?>">
                                                    <input type="hidden" name="extension" value="<?= $extension ?>">
                                                    <button type="submit" name="update" class="update">Update</button>
                                                </form>
                                            </div>
                                        </div>

                                        <?php $popupIndex++; ?>
                                        
                                        <form method="POST" onsubmit="return confirmDelete();">
                                            <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['USER']->user_id)?>">
                                            <input type="hidden" name="document_id" value="<?= htmlspecialchars($document['document_id']) ?>">
                                            <input type="hidden" name="document_name" value="<?= htmlspecialchars($document['document_name']) ?>">
                                            <button type="submit" name="delete" class="private-delete-button">Delete</button>
                                        </form>
                                    </div>
                                </div>   
                                
                            <?php endforeach; ?>

                            <!-- Pagination Control -->
                            <div class="pagination">

                                <?php if($currentPage > 1): ?>
                                    <a href="?page=<?= $currentPage - 1 ?>" class="prev">Prev</a>
                                <?php endif; ?>

                                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                                    <span class="<?= $i == $currentPage ? 'current-page' : '' ?>"><?= $i ?></span>
                                <?php endfor; ?>

                                <?php if($currentPage < $totalPages): ?>
                                    <a href="?page=<?= $currentPage + 1 ?>" class="next">Next</a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
            </div>

            <script>
                // Auto-hide success/error messages after 5 seconds
                document.addEventListener("DOMContentLoaded", function() {
                    const errorMessage = document.getElementById("errorMessage");
                    if (errorMessage) {
                        setTimeout(() => {
                            errorMessage.style.display = "none";
                        }, 5000);
                    }
                });

                //delete confirmation box
                function confirmDelete() {
                    return confirm("Are you sure you want to delete this file?");
                }
            </script>

            <script src="<?= ROOT ?>/assets/js/Patient/Documents.js"></script>
        </main>
    </body>
</html>