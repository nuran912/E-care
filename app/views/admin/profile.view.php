<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/profile.css">
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <img src="/path/to/profile-image.jpg" alt="Profile Image">
            <h2>Admin Name</h2>
        </div>
        <div class="profile-section">
            <h3>Personal Details</h3>
            <form>
                <div class="form-group">
                    <label for="full-name">Full Name</label>
                    <input type="text" id="full-name" name="full-name" value="Admin Name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="admin@example.com">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" value="123-456-7890">
                </div>
                <div class="form-group">
                    <label for="nic-passport">NIC/Passport</label>
                    <input type="text" id="nic-passport" name="nic-passport" value="A12345678">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-update">Update</button>
                    <button type="reset" class="btn-reset">Reset</button>
                </div>
            </form>
        </div>
        <div class="profile-section">
            <h3>Change Password</h3>
            <form>
                <div class="form-group">
                    <label for="current-password">Current Password</label>
                    <input type="password" id="current-password" name="current-password">
                </div>
                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <input type="password" id="new-password" name="new-password">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-update">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
