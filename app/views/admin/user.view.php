<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Users</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/user.css">
</head>

<body>
    <div class="dashboard-container">
        <header>
            <p>Users</p>
            <div class="user-info">
                <span><?php echo (ucwords($_SESSION['USER']->name)); ?></span>
                <span class="role-badge">ADMIN</span>
            </div>
        </header>

        <?php if (isset($_SESSION['reset_success'])): ?>
            <div class="success" id="msgBox"><?php echo $_SESSION['reset_success']; ?></div>
            <?php unset($_SESSION['reset_success']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['edit_success'])): ?>
            <div class="success" id="msgBox"><?php echo $_SESSION['edit_success']; ?></div>
            <?php unset($_SESSION['edit_success']); ?>
        <?php endif; ?>

        <section class="search">
            <h2>Find User</h2>
            <input type="search" class="search-bar" id="search-users" name="search-users" placeholder="Search User here..." oninput="filterUsers()">
            <button type="submit" class="btn-search">Search</button>
        </section>
        <section class="tables-section">
            <div class="table-card">
                <table>
                    <thead>
                        <tr>
                            <th>User Image</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>NIC</th>
                            <th>Status</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody id="user-table-body">
                        <?php if (isset($users) && is_array($users)): ?>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><img class="user-img" src="<?php echo ROOT ?>/assets/img/user.svg" alt="User Image"></td>
                                    <td data-search="<?php echo $user['name']; ?>"><?php echo $user['name']; ?></td>
                                    <td data-search="<?php echo $user['email']; ?>"><?php echo $user['email']; ?></td>
                                    <td data-search="<?php echo $user['phone_number']; ?>"><?php echo $user['phone_number']; ?></td>
                                    <td data-search="<?php echo $user['NIC']; ?>"><?php echo $user['NIC']; ?></td>
                                    <td data-search="<?php echo $user['is_active'] ? 'Active' : 'Disabled'; ?>">
                                        <form method="post" action="<?= ROOT ?>/admin/user/toggleStatus" class="status-form">
                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                            <button type="button" class="btn-<?php echo $user['is_active'] ? 'active' : 'disable'; ?>" onclick="toggleStatus(this)">
                                                <?php echo $user['is_active'] ? 'Active' : 'Disabled'; ?>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="<?= ROOT ?>/admin/user/resetPassword" class="reset-form">
                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                            <input type="hidden" name="nic" value="<?php echo $user['NIC']; ?>">
                                            <input type="hidden" name="name" value="<?php echo $user['name']; ?>">
                                            <button type="button" class="btn-reset" onclick="resetPassword(this)">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <p>No Users found.</p>
                        <?php endif; ?>
                </table>
            </div>

        </section>
        <script src="<?php echo ROOT ?>/assets/js/create.js"></script>
        <script>
            const messageBox = document.getElementById('msgBox');
            if (messageBox) {
                setTimeout(() => {
                    messageBox.style.display = 'none';
                    location.reload();
                }, 3000);
            }
        </script>
    </div>
</body>

</html>