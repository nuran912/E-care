<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin - Clerk</title>
   <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/user.css">
</head>

<body>
   <div class="dashboard-container">
      <header>
         <p>Clerks</p>
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

      <section class="main-div">
         <div class="search">
            <h2>Find Clerk</h2>
            <input type="search" class="search-bar" id="search-clerks" name="search-clerks" placeholder="Search Clerk here..." oninput="filterClerks()">
            <button type="submit" class="btn-search">Search</button>
         </div>


         <div class="search">
            <h2>Add A New Clerk</h2>
            <button type="submit" name="create-doctor" class="btn-search">Create</button>
         </div>
      </section>
      <section class="tables-section">
         <div class="table-card">
            <table>
               <thead>
                  <tr>
                     <th>Employee Number</th>
                     <th>Type</th>
                     <th>Full Name</th>
                     <th>Email</th>
                     <th>Phone</th>
                     <th>NIC</th>
                     <th>Hospital/Lab</th>
                     <th>Status</th>
                     <th>Password</th>
                     <th>Edit</th>
                  </tr>
               </thead>
               <tbody id="clerk-table-body">
                  <?php if (isset($clerks) && is_array($clerks)): ?>
                     <?php foreach ($clerks as $clerk) : ?>
                        <tr>
                           <td data-search="<?php echo $clerk['emp_id']; ?>"><?php echo $clerk['emp_id']; ?></td>
                           <td data-search="<?php echo $clerk['type']; ?>"><?php echo ucfirst($clerk['type']); ?></td>
                           <td data-search="<?php echo $clerk['name']; ?>"><?php echo $clerk['name']; ?></td>
                           <td data-search="<?php echo $clerk['email']; ?>"><?php echo $clerk['email']; ?></td>
                           <td data-search="<?php echo $clerk['phone_number']; ?>"><?php echo $clerk['phone_number']; ?></td>
                           <td data-search="<?php echo $clerk['NIC']; ?>"><?php echo $clerk['NIC']; ?></td>
                           <td data-search="<?php echo $clerk['lab'] ? $clerk['lab'] : $clerk['hospital']; ?>">
                              <?php if($clerk['lab'] == null){
                                 echo $clerk['hospital'];
                              } else{
                                 echo $clerk['lab'];
                              } ?></td>
                           <td data-search="<?php echo $clerk['is_active'] ? 'Active' : 'Disabled'; ?>">
                              <form method="post" action="<?= ROOT ?>/admin/clerk/toggleStatus" class="status-form">
                                 <input type="hidden" name="user_id" value="<?php echo $clerk['user_id']; ?>">
                                 <button type="button" class="btn-<?php echo $clerk['is_active'] ? 'active' : 'disable'; ?>" onclick="toggleStatus(this)">
                                    <?php echo $clerk['is_active'] ? 'Active' : 'Disabled'; ?>
                                 </button>
                              </form>
                           </td>
                           <td>
                              <form method="post" action="<?= ROOT ?>/admin/clerk/resetPassword" class="reset-form">
                                 <input type="hidden" name="user_id" value="<?php echo $clerk['user_id']; ?>">
                                 <input type="hidden" name="nic" value="<?php echo $clerk['NIC']; ?>">
                                 <input type="hidden" name="name" value="<?php echo $clerk['name']; ?>">
                                 <button type="button" class="btn-reset" onclick="resetPassword(this)">Reset</button>
                              </form>
                           </td>
                           <td><button class="btn-edit" onclick="doctorEditPopup(<?php echo htmlspecialchars(json_encode($clerk)); ?>)"><img src="<?= ROOT ?>/assets/img/admin/edit.svg"></button></td>
                        </tr>
                     <?php endforeach; ?>

                  <?php else: ?>
                     <p>No Clerks found.</p>
                  <?php endif; ?>

               </tbody>
            </table>
         </div>

      </section>

      <!-- Create Card -->
      <div class="overlay"></div>
      <div class="popup">
         <h2>Add A New Clerk</h2>
         <form id="create-clerk-form" action="<?= ROOT ?>/Admin/clerk/create" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="emp_id" id="create-emp-id">
            <input type="hidden" name="user_id" id="create-user-id">
            <div class="form-row">
               <input type="file" id="create-doctor-image" name="clerk-image" accept="image/*" hidden>
               <img src="<?= ROOT ?>/assets/img/user.svg" alt="Image Preview" class="image-preview" id="image-preview" onclick="document.getElementById('create-doctor-image').click();">
               <div class="form-group">
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="name" placeholder=" " id="create-clerk-name" required>
                        <label>Full Name</label>
                     </div>
                     <div class="form-group">
                        <input type="email" name="email" placeholder=" " id="create-clerk-email" required>
                        <label>Email</label>
                     </div>
                  </div>
                  <div class="form-row">
                  <div class="form-group">
                        <!-- <input type="radio" value="Male" name="gender" placeholder=" " id="create-doctor-gender" required>Male -->
                        <select name="gender" id="create-clerk-gender">
                           <option value="Male" selected>Male</option>
                           <option value="Female">Female</option>
                        </select>
                        <label>Gender</label>
                     </div>
                     <div class="form-group">
                        <input type="text" name="nic" placeholder=" " id="create-clerk-nic" required>
                        <label>NIC</label>
                     </div>
                     <div class="form-group">
                        <input type="text" name="phone_number" placeholder=" " id="create-clerk-phone" required>
                        <label>Phone Number</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group">
                  <input type="hidden">
                  <label>Type</label>
                  <select name="type" id="create-clerk-type">
                     <option value="lab" selected>Lab clerk</option>
                     <option value="record">Record clerk</option>
                     <option value="reception">Reception clerk</option>
                  </select>
               </div>
               <div class="form-group">
                  <input type="text" name="emp_id" 
                     value="<?php 
                        $lastRegNum = end($clerks)['emp_id'];
                        $numericPart = intval(substr($lastRegNum, 3));
                        echo ('EMP' . str_pad($numericPart + 1, 3, '0', STR_PAD_LEFT)); 
                     ?>" 
                     id="create-clerk-emp-id" required >
                  <label>Employee Number</label>

               </div>                                           
            </div>
            <div class="form-row">
               <div class="form-group">
                  <input type="hidden">
                  <label>Hospital</label>
                  <select name="hospital" id="create-clerk-hospital" onchange="toggleDropdowns()">
                     <option value="" selected>None</option>
                     <?php foreach ($hospitals as $hospital): ?>
                        <option value="<?php echo $hospital['id']; ?>"><?php echo $hospital['name']; ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
               <div class="form-group">
               <input type="hidden">
                  <label>Laboratory</label>
                  <select name="lab" id="create-clerk-lab" onchange="toggleDropdowns()">
                  <option value="" selected>None</option>
                     <?php foreach ($labs as $lab): ?>
                        <option value="<?php echo $lab['id']; ?>"><?php echo $lab['name']; ?></option>
                     <?php endforeach; ?>
                  </select>

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
         <h2>Edit Clerk</h2>
         <form>
            <div class="form-row">
               <input type="file" id="edit-doctor-image" name="doctor-image" accept="image/*" hidden>
               <img src="<?= ROOT ?>/assets/img/user.svg" alt="Image Preview" class="image-preview" id="edit-image-preview" onclick="document.getElementById('edit-doctor-image').click();">
               <div class="form-group">
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="full-name" placeholder=" " value="Doctor Strange" required>
                        <label>Full Name</label>
                     </div>
                     <div class="form-group">
                        <input type="email" name="email" placeholder=" " value="athhar@gmail.com" required>
                        <label>Email</label>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="nic" placeholder=" " value="200212345678" required>
                        <label>NIC</label>
                     </div>
                     <div class="form-group">
                        <input type="text" name="phone" placeholder=" " value="0761234567" required>
                        <label>Phone Number</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group">
                  <select name="role" id="role">
                     <option value="lab" selected>Lab clerk</option>
                     <option value="record">Record clek</option>
                     <option value="reception">Reception clerk</option>
                  </select>
                  <label>Role</label>
               </div>
               <div class="form-group">
                  <input type="text" name="doctor-number" placeholder=" " value="L001" style="width: 300px;" required>
                  <label>Employee Number</label>

               </div>
               <lable><input type="checkbox" name="active" checked>Active</lable>
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