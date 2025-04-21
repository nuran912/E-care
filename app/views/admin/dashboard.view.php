<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/dashboard.css">
    <script src="<?php echo ROOT ?>/assets/js/dash.js"></script>
</head>
<body>
    <div class="dashboard-container">
        <header>
            <p>Dashboard</p>
            <div class="user-info">
                <span><?php echo (ucwords($_SESSION['USER']->name)); ?></span>
                <span class="role-badge">ADMIN</span>
            </div>
        </header>
        
        <section class="stats-grid">
            <div class="stat-card">
                <img src="<?php echo ROOT ?>/assets/img/admin/user.svg" alt="User Image">
                <div>
                    <p>Total Users</p>
                    <h2><?php echo $userCount; ?></h2>
                </div>
            </div>
            <div class="stat-card">
            <img src="<?php echo ROOT ?>/assets/img/admin/doctor.svg" alt="User Image">
                <div>
                    <p>Total Doctors</p>
                    <h2><?php echo $doctorCount; ?></h2>
                </div>
            </div>
            <div class="stat-card">
            <img src="<?php echo ROOT ?>/assets/img/admin/clerk.svg" alt="User Image">
                <div>
                    <p>Total Clerks</p>
                    <h2><?php echo $clerkCount; ?></h2>
                </div>
            </div>
            <div class="stat-card">
            <img src="<?php echo ROOT ?>/assets/img/admin/insurance.svg" alt="User Image">
                <div>
                    <p>Hospital & Labs</p>
                    <h2><?php echo $hospitalCount + $labCount; ?></h2>
                </div>
            </div>
            <div class="stat-card">
            <img src="<?php echo ROOT ?>/assets/img/admin/appointment.svg" alt="User Image">
                <div>
                    <p>Last Month Appointments</p>
                    <h2><?php echo $appointmentCount; ?></h2>
                </div>
            </div>
            <div class="stat-card">
            <img src="<?php echo ROOT ?>/assets/img/admin/article.svg" alt="User Image">
                <div>
                    <p>Last Month Articles</p>
                    <h2><?php echo $articleCount; ?></h2>
                </div>
            </div>
        </section>
        <section class="tables-section">
            <div class="table-card">
                <h3>Recent Users <a href="<?php echo ROOT ?>/Admin/user" class="see-all">See All</a></h3>
                <table>
                    <thead>
                        <tr>
                            <th>User Image</th>
                            <th>Full Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><img src="<?php echo ROOT ?>/assets/img/user.svg" alt="User Image"></td>
                            <td><?php echo $user['name']; ?></td> 
                        </tr>
                        <?php endforeach; ?>
                        
                      
                    </tbody>
                </table>
            </div>
            <div class="table-card">
                <h3>Recent Doctors <a href="<?php echo ROOT ?>/Admin/doctor" class="see-all">See All</a></h3>
                <table>
                    <thead>
                        <tr>
                            <th>Registration Number</th>
                            <th>Full Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($doctors as $doctor): ?>
                        <tr>
                            <td><?php echo $doctor['registration_number']; ?></td>
                            <td><?php echo $doctor['name']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
            </div>
            <div class="table-card">
                <h3>Recent Clerks <a href="<?php echo ROOT ?>/Admin/clerk" class="see-all">See All</a></h3>
                <table>
                    <thead>
                        <tr>
                            <th>Employee Number</th>
                            <th>Type</th>
                            <th>Full Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clerks as $clerk): ?>
                        <tr>
                            <td><?php echo $clerk['emp_id']; ?></td>
                            <td><?php echo $clerk['type']; ?></td>
                            <td><?php echo $clerk['name']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                       
                    </tbody>
                </table>
            </div>
            <div class="table-card">
                <h3>Recent Hospital <a href="<?php echo ROOT ?>/Admin/hospital" class="see-all">See All</a></h3>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($hospitals as $hospital): ?>
                        <tr>
                            <td><?php echo $hospital['name']; ?></td>
                            <td><?php echo $hospital['contact']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>
</html>
