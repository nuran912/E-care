<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/profile.css">
</head>

<body>

    <!-- <?php show($data); ?> -->

    <div class="profile-container">

        <?php if (isset($edit_success)): ?>
            <div class="success" id="message-box"><?php echo $edit_success; ?></div>
        <?php endif; ?>
        <?php if (isset($edit_error)): ?>
            <div class="error" id="message-box"><?php echo $edit_error; ?></div>
        <?php endif; ?>
        <?php if (isset($validation_errors)): ?>

            <?php foreach ($validation_errors as $error): ?>
                <div class="error" id="message-box">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="profile-header">
            <form method="POST" enctype="multipart/form-data" action="<?= ROOT; ?>/Admin/profile">
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['USER']->user_id) ?>">
                <input type="file" name="profile-pic" id="user-image" class="user-image" accept="image/*" hidden>
            </form>
            <div class="profilePic">
                <img src="<?= $data['profilePic'] ?>" alt="Profile Picture" id="image-preview" onclick="document.getElementById('user-image').click();">
            </div>
            <!-- <img src="<?php echo ROOT ?>/assets/img/user.svg" alt="Profile Image"> -->
            <div>
                <h2><?php echo $user->name ?></h2>
                <h5>ADMIN</h5>
            </div>
        </div>

        <div class="profile-section">
            <h3>Personal Details</h3>
            <form method="POST" action="<?php echo ROOT ?>/Admin/profile/edit">
                <div class="form-group">
                    <label for="full-name">Full Name</label>
                    <input type="text" id="full-name" name="name" value="<?php echo $user->name ?>" required>
                    
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $user->email ?>" required>
                    
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone_number" value="<?php echo $user->phone_number ?>" required>
                    
                </div>
                <div class="form-group">
                    <label for="nic-passport">NIC/Passport</label>
                    <input type="text" id="nic" name="NIC" value="<?php echo $user->NIC ?>" required>
                    
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-update">Update</button>
                    <button type="reset" class="btn-reset">Reset</button>
                </div>
            </form>
        </div>

        <div class="profile-section">
            <h3>Change Password</h3>
            <form method="POST" action="<?php echo ROOT ?>/Admin/profile/change-password">
                <div class="form-group">
                    <label for="current-password">Current Password</label>
                    <input type="password" id="current-password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <input type="password" id="new-password" name="newPassword" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-update">Change Password</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Hide the message box after 3 seconds and refresh the page
        const messageBox = document.getElementById('message-box');
        if (messageBox) {
            setTimeout(() => {
                messageBox.style.display = 'none';
                location.reload();
            }, 5000);
        }
        // Preview the image before uploading
        document.getElementById('user-image').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview').src = e.target.result;
                }
                reader.readAsDataURL(file);

                this.form.submit();
            }
        });
    </script>
</body>

</html>