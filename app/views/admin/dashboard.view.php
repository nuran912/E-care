<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <header>
            <p>Dashboard</p>
            <div class="user-info">
                <span>Admin Jane</span>
                <span class="role-badge">ADMIN</span>
            </div>
        </header>
        
        <section class="stats-grid">
            <div class="stat-card">
                <img src="<?php echo ROOT ?>/assets/img/admin/user.svg" alt="User Image">
                <div>
                    <p>Total Users</p>
                    <h2>1267</h2>
                </div>
            </div>
            <div class="stat-card">
            <img src="<?php echo ROOT ?>/assets/img/admin/doctor.svg" alt="User Image">
                <div>
                    <p>Total Doctors</p>
                    <h2>56</h2>
                </div>
            </div>
            <div class="stat-card">
            <img src="<?php echo ROOT ?>/assets/img/admin/clerk.svg" alt="User Image">
                <div>
                    <p>Total Clerks</p>
                    <h2>12</h2>
                </div>
            </div>
            <div class="stat-card">
            <img src="<?php echo ROOT ?>/assets/img/admin/insurance.svg" alt="User Image">
                <div>
                    <p>Insurance Partners</p>
                    <h2>5</h2>
                </div>
            </div>
            <div class="stat-card">
            <img src="<?php echo ROOT ?>/assets/img/admin/appointment.svg" alt="User Image">
                <div>
                    <p>Last Month Appointments</p>
                    <h2>225</h2>
                </div>
            </div>
            <div class="stat-card">
            <img src="<?php echo ROOT ?>/assets/img/admin/article.svg" alt="User Image">
                <div>
                    <p>Last Month Articles</p>
                    <h2>24</h2>
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
                        <tr>
                            <td><img src="<?php echo ROOT ?>/assets/img/user.svg" alt="User Image"></td>
                            <td>Mohamed Athhar</td>
                        </tr>
                        <tr>
                            <td><img src="<?php echo ROOT ?>/assets/img/user.svg" alt="User Image"></td>
                            <td>Nuran Alwis</td>
                        </tr>
                        <tr>
                            <td><img src="<?php echo ROOT ?>/assets/img/user.svg" alt="User Image"></td>
                            <td>Manusha Ranaweera</td>
                        </tr>
                        <tr>
                            <td><img src="<?php echo ROOT ?>/assets/img/user.svg" alt="User Image"></td>
                            <td>Okadini KDI</td>
                        </tr>
                      
                    </tbody>
                </table>
            </div>
            <div class="table-card">
                <h3>Recent Doctors <a href="<?php echo ROOT ?>/Admin/doctor" class="see-all">See All</a></h3>
                <table>
                    <thead>
                        <tr>
                            <th>Employee Number</th>
                            <th>Full Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>D001</td>
                            <td>Doctor Strange</td>
                        </tr>
                        <tr>
                            <td>D002</td>
                            <td>Peter Parker</td>
                        </tr>
                        <tr>
                            <td>D003</td>
                            <td>Octo Octavia</td>
                        </tr>
                        <tr>
                            <td>D004</td>
                            <td>Green Goblin</td>
                        </tr>
                        <!-- Repeat rows as needed -->
                    </tbody>
                </table>
            </div>
            <div class="table-card">
                <h3>Recent Clerks <a href="<?php echo ROOT ?>/Admin/clerk" class="see-all">See All</a></h3>
                <table>
                    <thead>
                        <tr>
                            <th>Employee Number</th>
                            <th>Role</th>
                            <th>Full Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>L001</td>
                            <td>Lab</td>
                            <td>Doctor Strange</td>
                        </tr>
                        <tr>
                            <td>R002</td>
                            <td>Record</td>
                            <td>Peter Parker</td>
                        </tr>
                        <tr>
                            <td>A003</td>
                            <td>Appointment</td>
                            <td>Octo Octevia</td>
                        </tr>
                        <tr>
                            <td>L004</td>
                            <td>Report</td>
                            <td>Green Goblin</td>
                        </tr>
                        <!-- Repeat rows as needed -->
                    </tbody>
                </table>
            </div>
            <div class="table-card">
                <h3>Insurance Partners <a href="<?php echo ROOT ?>/Admin/insurance" class="see-all">See All</a></h3>
                <table>
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Allianz Lanka</td>
                            <td>allianz@email.com</td>
                        </tr>
                        <tr>
                            <td>Softlogic Life</td>
                            <td>softlogic@email.com</td>
                        </tr>
                        <tr>
                            <td>Ceylinco Life</td>
                            <td>ceylinco@email.com</td>
                        </tr>
                        <tr>
                            <td>AIA Sri Lanka</td>
                            <td>aia@email.com</td>
                        </tr>
                        <!-- Repeat rows as needed -->
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>
</html>
