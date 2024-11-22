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
                <span>Admin Jane</span>
                <span class="role-badge">ADMIN</span>
            </div>
        </header>
        
        <section class="search">
            <h2>Find User</h2>
            <input type="text" class="search-bar" placeholder="Search user here...">
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
                    <tbody>
                        <tr>
                            <td><img src="<?php echo ROOT ?>/assets/img/user.svg" alt="User Image"></td>
                            <td>Mohamed Athhar</td>
                            <td>athhar@gmail.com</td>
                            <td>0761234567</td>
                            <td>200212345678</td>
                            <td><button class="btn-active">Active</button></td>
                            <td><button class="btn-reset">Reset</button></td>
                        </tr>
                        <tr>
                            <td><img src="<?php echo ROOT ?>/assets/img/user.svg" alt="User Image"></td>
                            <td>Nuran Alwis</td>
                            <td>nuran@gmail.com</td>
                            <td>0761985642</td>
                            <td>200254268791</td>
                            <td><button class="btn-disable">Disable</button></td>
                            <td><button class="btn-reset">Reset</button></td>
                        </tr>
                        <tr>
                            <td><img src="<?php echo ROOT ?>/assets/img/user.svg" alt="User Image"></td>
                            <td>Manusha Ranaweera</td>
                            <td>manusha@gmail.com</td>
                            <td>0763259465</td>
                            <td>200265894154</td>
                            <td><button class="btn-active">Active</button></td>
                            <td><button class="btn-reset">Reset</button></td>
                        </tr>
                        <tr>
                            <td><img src="<?php echo ROOT ?>/assets/img/user.svg" alt="User Image"></td>
                            <td>Okadini KDI</td>
                            <td>okadini@gmail.com</td>
                            <td>0761234567</td>
                            <td>200212345678</td>
                            <td><button class="btn-active">Active</button></td>
                            <td><button class="btn-reset">Reset</button></td>
                        </tr>
                      
                    </tbody>
                </table>
            </div>
            
        </section>
    </div>
</body>
</html>
