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
      <?php if (isset($_SESSION['edit_success'])): ?>
         <div class="success"><?php echo $_SESSION['edit_success']; ?></div>
         <?php unset($_SESSION['edit_success']); ?>
      <?php endif; ?>
      <?php if (isset($_SESSION['create_success'])): ?>
         <div class="success"><?php echo $_SESSION['create_success']; ?></div>
         <?php unset($_SESSION['create_success']); ?>
      <?php endif; ?>

      <section class="main-div">
         <div class="search">
            <h2>Find Doctor</h2>
            <input type="search" class="search-bar" id="search-doctor" name="search-doctor" placeholder="Search doctor here..." oninput="filterDoctors()">
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
               <tbody id="doctor-table-body">
                  <?php if (isset($doctors) && is_array($doctors)): ?>
                     <?php foreach ($doctors as $doctor) : ?>
                        <tr>
                           <td data-search="<?php echo $doctor['registration_number']; ?>"><?php echo $doctor['registration_number']; ?></td>
                           <td data-search="<?php echo $doctor['name']; ?>"><?php echo $doctor['name']; ?></td>
                           <td data-search="<?php echo $doctor['specialization']; ?>"><?php echo $doctor['specialization']; ?></td>
                           <td data-search="<?php echo $doctor['email']; ?>"><?php echo $doctor['email']; ?></td>
                           <td data-search="<?php echo $doctor['phone_number']; ?>"><?php echo $doctor['phone_number']; ?></td>
                           <td data-search="<?php echo $doctor['NIC']; ?>"><?php echo $doctor['NIC']; ?></td>
                           <td data-search="<?php echo $doctor['is_active'] ? 'Active' : 'Disabled'; ?>">
                              <form method="post" action="<?= ROOT ?>/admin/doctor/toggleStatus" class="status-form">
                                 <input type="hidden" name="user_id" value="<?php echo $doctor['user_id']; ?>">
                                 <button type="button" class="btn-<?php echo $doctor['is_active'] ? 'active' : 'disable'; ?>" onclick="toggleStatus(this)">
                                    <?php echo $doctor['is_active'] ? 'Active' : 'Disabled'; ?>
                                 </button>
                              </form>
                           </td>
                           <td>
                              <form method="post" action="<?= ROOT ?>/admin/doctor/resetPassword" class="reset-form">
                                 <input type="hidden" name="user_id" value="<?php echo $doctor['user_id']; ?>">
                                 <input type="hidden" name="nic" value="<?php echo $doctor['NIC']; ?>">
                                 <input type="hidden" name="name" value="<?php echo $doctor['name']; ?>">
                                 <button type="button" class="btn-reset" onclick="resetPassword(this)">Reset</button>
                              </form>
                           </td>
                           <td><button class="btn-edit" onclick="doctorEditPopup(<?php echo htmlspecialchars(json_encode($doctor)); ?>)"><img src="<?= ROOT ?>/assets/img/admin/edit.svg"></button></td>
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
         <form id="create-doctor-form" action="<?= ROOT ?>/Admin/doctor/create" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="doctor_id" id="create-doctor-id">
            <input type="hidden" name="user_id" id="create-user-id">
            <div class="form-row">
               <input type="file" id="create-doctor-image" name="doctor-image" accept="image/*" hidden>
               <img src="<?= ROOT ?>/assets/img/user.svg" alt="Image Preview" class="image-preview" id="image-preview" onclick="document.getElementById('create-doctor-image').click();">
               <div class="form-group">
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="name" placeholder=" " id="create-doctor-name" required>
                        <label>Full Name</label>
                     </div>
                     <div class="form-group">
                        <input type="email" name="email" placeholder=" " id="create-doctor-email" required>
                        <label>Email</label>
                     </div>
                  </div>
                  <div class="form-row">
                  <div class="form-group">
                        <!-- <input type="radio" value="Male" name="gender" placeholder=" " id="create-doctor-gender" required>Male -->
                        <select name="gender" id="create-doctor-gender">
                           <option value="Male" selected>Male</option>
                           <option value="Female">Female</option>
                        </select>
                        <label>Gender</label>
                     </div>
                     <div class="form-group">
                        <input type="text" name="nic" placeholder=" " id="create-doctor-nic" required>
                        <label>NIC</label>
                     </div>
                     <div class="form-group">
                        <input type="text" name="phone_number" placeholder=" " id="create-doctor-phone" required>
                        <label>Phone Number</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group">
                  <input type="text" name="specialization" placeholder=" " id="create-doctor-specialization" required>
                  <label>Specialization</label>
               </div>
               <div class="form-group">
                  <input type="text" name="registration_number" 
                     value="<?php 
                        $lastRegNum = end($doctors)['registration_number'];
                        $numericPart = intval(substr($lastRegNum, 3));
                        echo ('REG' . str_pad($numericPart + 1, 3, '0', STR_PAD_LEFT)); 
                     ?>" 
                     id="create-doctor-registration-number" required >
                  <label>Registration Number</label>

               </div>
               
               <div class="form-group">
                  <input type="text" name="doctor_fee" placeholder=" " id="create-doctor-fee" style="width: 150px;" required>
                  <label>Doctor Fee(Rs.)</label>
               </div>
               <div class="form-group">
                  <input type="hidden" name="">
                  <label>Practicing Government_Hospitals</label>
               </div>
               <div class="form-group">
                     <input type="checkbox" name="government_hospital" id="create-doctor-government" >
                     <!-- <label>Practicing Government Hospitals</label> -->
               </div>
            </div>
            <div class="form-row">
               <div class="form-group">
                  <textarea name="other_qualifications" rows="2" placeholder=" " id="create-doctor-qualifications"></textarea>
                  
                  <label>Qualifications</label>
               </div>

            </div>
            <div class="form-row">
               <div class="form-group">
                  <textarea name="special_note" rows="2" placeholder=" " id="create-doctor-note"></textarea>
                  
                  <label>Special Notes</label>
               </div>

            </div>
            <div class="form-row">
               <button type="submit" class="btn-create">Create</button>
               <button type="button" class="btn-cancel" onclick="closeEditPopup()">Cancel</button>
            </div>
         </form>
      </div>

      <!-- End Create Card -->

      <!-- Edit Card -->
      <div class="popup-edit">
         <h2>Edit Doctor</h2>
         <form id="edit-doctor-form" action="<?= ROOT ?>/Admin/doctor/edit" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="doctor_id" id="edit-doctor-id">
            <input type="hidden" name="user_id" id="edit-user-id">
            <div class="form-row">
               <input type="file" id="edit-doctor-image" name="doctor-image" accept="image/*" hidden>
               <img src="<?= ROOT ?>/assets/img/user.svg" alt="Image Preview" class="image-preview" id="edit-image-preview" onclick="document.getElementById('edit-doctor-image').click();">
               <div class="form-group">
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="name" placeholder=" " id="edit-doctor-name" required>
                        <label>Full Name</label>
                     </div>
                     <div class="form-group">
                        <input type="email" name="email" placeholder=" " id="edit-doctor-email" required>
                        <label>Email</label>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="nic" placeholder=" " id="edit-doctor-nic" required>
                        <label>NIC</label>
                     </div>
                     <div class="form-group">
                        <input type="text" name="phone_number" placeholder=" " id="edit-doctor-phone" required>
                        <label>Phone Number</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group">
                  <input type="text" name="specialization" placeholder=" " id="edit-doctor-specialization" required>
                  <label>Specialization</label>
               </div>
               <div class="form-group">
                  <input type="text" name="registration_number" placeholder=" " id="edit-doctor-registration-number" required disabled>
                  <label>Registration Number</label>

               </div>
               
               <div class="form-group">
                  <input type="text" name="doctor_fee" placeholder=" " id="edit-doctor-fee" style="width: 150px;" required>
                  <label>Doctor Fee(Rs.)</label>
               </div>
               <div class="form-group">
                  <input type="hidden" name="">
                  <label>Practicing Government_Hospitals</label>
               </div>
               <div class="form-group">
                     <input type="checkbox" name="government_hospital" id="edit-doctor-government" >
                     <!-- <label>Practicing Government Hospitals</label> -->
               </div>
            </div>
            <div class="form-row">
               <div class="form-group">
                  <textarea name="other_qualifications" rows="2" placeholder=" " id="edit-doctor-qualifications">
                  </textarea>
                  <label>Qualifications</label>
               </div>

            </div>
            <div class="form-row">
               <div class="form-group">
                  <textarea name="special_note" rows="2" placeholder=" " id="edit-doctor-note">
                  </textarea>
                  <label>Special Notes</label>
               </div>

            </div>
            <div class="form-row">
               <button type="submit" class="btn-create">Update</button>
               <button type="button" class="btn-cancel" onclick="closeEditPopup()">Cancel</button>
            </div>
         </form>
      </div>
      <script src="<?php echo ROOT ?>/assets/js/create.js"></script>

   </div>
</body>

</html>