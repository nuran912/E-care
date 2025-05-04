<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Documents</title>
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

        form.documentInfo {
            width: 100%;
            max-width: 600px;
            margin-top: 20px;
        }

        .tabs{
            display: flex;
            flex-direction: row;
            justify-content: center;
            border-bottom: 2px solid #d1c9c9;
            margin-bottom: 30px;
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

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .section {
            display: flex;
            gap: 20px;
        }

        .item {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-size: 14px;
            font-weight: 500;
        }

        input[type="text"], select, input[type="file"] {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
            transition: border-color 0.2s ease-in-out;
        }

        input[type="text"]:focus, select:focus, input[type="file"]:focus {
            border-color: #007BFF;
        }

        button {
            padding: 10px 20px;
            background-color: #0E2F56;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        button:hover {
            background-color: #0056b3;
        }

        .buttons{
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
        }

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

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            margin-left: 40%;
            width: 300px;
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

    <!-- Success Message -->
    <?php if (isset($data['success'])): ?>
        <div id="successMessage" class="alert alert-success">
            <?= htmlspecialchars($data['success']); ?>
        </div>
        <?php unset($data['success']); ?>
    <?php endif; ?>

    <!-- Error Message -->
    <?php if (isset($data['error'])): ?>
    <div id="errorMessage" class="alert alert-danger">
        <?= htmlspecialchars($data['error']); ?>
    </div>
    <?php unset($data['error']); ?>
    <?php endif; ?>

    <!-- Same File Error Message -->
    <?php if (isset($data['same_name_error'])): ?>
    <div id="errorMessage" class="alert alert-danger">
        <?= htmlspecialchars($data['same_name_error']); ?>
    </div>
    <?php unset($data['same_name_error']); ?>
    <?php endif; ?>

    <div class="container">

        <div class="tabs">
            <div class="tab active">Upload Document</div>
            <div class="tab"><a href="./labClerkWorkLog">Work Log</a></div>
        </div>

        <form class="documentInfo" method="POST" enctype="multipart/form-data">

            <div class="section">
                <div class="item">
                    <label for="patientEmail">Patient Email</label>
                    <input type="text" id="patientEmail" name="patient_email" placeholder="Enter patient email address" required />
                </div>

                <div class="item">
                    <label for="refNumber">Reference Number</label>
                    <input type="text" id="refNumber" name="ref_no" placeholder="Enter reference number" required />
                </div>
            </div>

            <input type="hidden" name="uploaded_by" value="<?= htmlspecialchars($_SESSION['USER']->user_id)?>">

            <div class="section">
                <div class="item">
                    <label for="document_category">Document Category</label>
                    <select id="documentCategory" name="document_category" required>
                        <option value="" disabled selected>Select a document category</option>
                        <option value="Blood report">Blood Report</option>
                        <option value="Urine report">Urine Report</option>
                        <option value="Stool report">Stool Report</option>
                        <option value="Biospy report">Biopsy Report</option>
                        <option value="Pathology report">Pathology Report</option>
                        <option value="Histology report">Histology Report</option>
                        <option value="Serology report">Serology Report</option>
                        <option value="Microbiology report">Microbiology Report</option>
                        <option value="Genetic test">Genetic Test Report</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="item">
                    <label for="file">Choose File</label>
                    <input type="file" id="file" name="file" accept=".pdf,.png,.jpeg,.jpg" required />
                </div>
            </div>

            <div class="buttons">
                <button type="submit" name="upload">Submit</button>
                <button type="reset">Cancel</button>
            </div>

        </form>
    </div>

    <script>
        // Auto-hide success/error messages after 5 seconds
        document.addEventListener("DOMContentLoaded", function() {
            const successMessage = document.getElementById("successMessage");
            const errorMessage = document.getElementById("errorMessage");
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = "none";
                    window.location.href = "<?= ROOT ?>/Clerk/labClerkWorkLog";
                }, 5000);
            }
            if (errorMessage) {
                setTimeout(() => {
                    errorMessage.style.display = "none";
                    window.location.href = "<?= ROOT ?>/Clerk/labClerkUploadDoc";
                }, 5000);
            }
        });
    </script>
</body>
</html>
