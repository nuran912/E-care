<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin - Doctor</title>
   <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/user.css">
</head>

<body>
   <div class="dashboard-container">
      <header>
         <p>Doctors</p>
         <div class="user-info">
            <span><?php echo (ucwords($_SESSION['USER']->name)); ?></span>
            <span class="role-badge">ADMIN</span>
         </div>
      </header>

      <?php if (isset($_SESSION['reset_success'])): ?>
         <div class="success"><?php echo $_SESSION['reset_success']; ?></div>
         <?php unset($_SESSION['reset_success']); ?>
      <?php endif; ?>

      <section class="main-div">
         <div class="search">
            <h2>Find Doctor</h2>
            <input type="search" class="search-bar" placeholder="Search doctor here...">
            <button type="submit" class="btn-search">Search</button>
         </div>


         <div class="search">
            <h2>Add A New Doctor</h2>
            <button type="submit" name="create-doctor" class="btn-search">Create</button>
         </div>
      </section>
      <section class="tables-section">
         <div class="table-card">
            <table>
               <thead>
                  <tr>
                     <th>Register Number</th>
                     <th>Full Name</th>
                     <th>Specialization</th>
                     <th>Email</th>
                     <th>Contact_No</th>
                     <th>NIC</th>
                     <th>Status</th>
                     <th>Password</th>
                     <th>Edit</th>
                  </tr>
               </thead>
               <tbody>
                  <?php if (isset($doctors) && is_array($doctors)): ?>
                     <?php foreach ($doctors as $doctor) : ?>
                        <tr>
                           <td><?php echo $doctor->registration_number; ?></td>
                           <td><?php echo $doctor->name; ?></td>
                           <td><?php echo $doctor->specialization; ?></td>
                           <td><?php echo $doctor->email; ?></td>
                           <td><?php echo $doctor->phone_number; ?></td>
                           <td><?php echo $doctor->NIC; ?></td>
                           <td>
                              <form method="post" action="<?= ROOT ?>/admin/doctor/toggleStatus" class="status-form">
                                 <input type="hidden" name="user_id" value="<?php echo $doctor->user_id; ?>">
                                 <button type="button" class="btn-<?php echo $doctor->is_active ? 'active' : 'disable'; ?>" onclick="toggleStatus(this)">
                                    <?php echo $doctor->is_active ? 'Active' : 'Disabled'; ?>
                                 </button>
                              </form>
                           </td>
                           <td>
                              <form method="post" action="<?= ROOT ?>/admin/doctor/resetPassword" class="reset-form">
                                 <input type="hidden" name="user_id" value="<?php echo $doctor->user_id; ?>">
                                 <input type="hidden" name="nic" value="<?php echo $doctor->NIC; ?>">
                                 <input type="hidden" name="name" value="<?php echo $doctor->name; ?>">
                                 <button type="button" class="btn-reset" onclick="resetPassword(this)">Reset</button>
                              </form>
                           </td>
                           <td><button class="btn-edit"><img src="<?= ROOT ?>/assets/img/admin/edit.svg"></button></td>
                        </tr>
                     <?php endforeach; ?>

                  <?php else: ?>
                     <p>No Doctors found.</p>
                  <?php endif; ?>

               </tbody>
            </table>
         </div>

      </section>

      <!-- Create Card -->
      <div class="overlay"></div>
      <div class="popup">
         <h2>Add A New Doctor</h2>
         <form>
            <div class="form-row">
               <input type="file" id="doctor-image" name="doctor-image" accept="image/*" hidden>
               <img src="" alt="Image Preview" class="image-preview" id="image-preview" onclick="document.getElementById('doctor-image').click();">
               <div class="form-group">
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="full-name" placeholder=" " required>
                        <label>Full Name</label>
                     </div>
                     <div class="form-group">
                        <input type="email" name="email" placeholder=" " required>
                        <label>Email</label>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="nic" placeholder=" " required>
                        <label>NIC</label>
                     </div>
                     <div class="form-group">
                        <input type="text" name="phone" placeholder=" " required>
                        <label>Phone Number</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group">
                  <input type="text" name="specialization" placeholder=" " required>
                  <label>Specialization</label>
               </div>
               <div class="form-group">
                  <input type="text" name="doctor-number" placeholder=" " style="width: 300px;" required>
                  <label>Doctor Number</label>
               </div>
               <lable><input type="checkbox" name="active">Active</lable>
            </div>
            <div class="form-row">
               <div class="form-group">
                  <textarea name="qualifications" rows="4" placeholder=" "></textarea>
                  <label>Qualifications</label>
               </div>
            </div>
            <div class="form-row">
               <button type="button" class="btn-create">Create</button>
               <button type="button" class="btn-cancel">Cancel</button>
            </div>
         </form>
      </div>

      <!-- End Create Card -->

      <!-- Edit Card -->
      <div class="popup-edit">
         <h2>Edit Doctor</h2>
         <form>
            <div class="form-row">
               <input type="file" id="edit-doctor-image" name="doctor-image" accept="image/*" hidden>
               <img src="<?= ROOT ?>/assets/img/user.svg" alt="Image Preview" class="image-preview" id="edit-image-preview" onclick="document.getElementById('edit-doctor-image').click();">
               <div class="form-group">
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="full-name" placeholder=" " value="Mohamed Athhar" required>
                        <label>Full Name</label>
                     </div>
                     <div class="form-group">
                        <input type="email" name="email" placeholder=" " value="athhar@gamil.com" required>
                        <label>Email</label>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="nic" placeholder=" " value="200210544893" required>
                        <label>NIC</label>
                     </div>
                     <div class="form-group">
                        <input type="text" name="phone" placeholder=" " value="0755428964" required>
                        <label>Phone Number</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group">
                  <input type="text" name="specialization" placeholder=" " value="General" required>
                  <label>Specialization</label>
               </div>
               <div class="form-group">
                  <input type="text" name="doctor-number" placeholder=" " value="D001" style="width: 300px;" required>
                  <label>Doctor Number</label>

               </div>
               <lable><input type="checkbox" name="active" checked="true">Active</lable>
            </div>
            <div class="form-row">
               <div class="form-group">
                  <textarea name="qualifications" rows="4">MBBS, MD (General Medicine) - 2010 
                  </textarea>
                  <label>Qualifications</label>
               </div>

            </div>
            <div class="form-row">
               <button type="button" class="btn-create">Update</button>
               <button type="button" class="btn-cancel">Cancel</button>
            </div>
         </form>
      </div>
      <script src="<?php echo ROOT ?>/assets/js/create.js"></script>

   </div>
</body>

</html>