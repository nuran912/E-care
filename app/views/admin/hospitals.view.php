<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin - Hospitals</title>
   <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/user.css">
   <script src="<?php echo ROOT ?>/assets/js/create.js"></script>
</head>

<body>
   <div class="dashboard-container">
      <header>
         <p>Hospitals</p>
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
            <h2>Find Hospital</h2>
            <input type="search" class="search-bar" id="search-hospitals" name="search-hospitals" placeholder="Search Hospital here..." oninput="filterHospitals()">
            <button type="submit" class="btn-search">Search</button>
         </div>


         <div class="search">
            <h2>Add A New Hospital</h2>
            <button type="submit" name="create-doctor" class="btn-search">Create</button>
         </div>
      </section>
      <section class="tables-section">
         <div class="table-card">
            <table>
               <thead>
                  <tr>
                     <th>Hospital Code</th>
                     <th>Name</th>
                     <th>Address</th>
                     <th>Contact</th>
                     <th>Hospital Fee</th>
                     <th>Working Hours</th>
                     <th>Location</th>
                     <th>Edit</th>
                  </tr>
               </thead>
               <tbody id="hospitals-table-body">
                  <?php if (isset($hospitals) && is_array($hospitals)): ?>
                     <?php foreach ($hospitals as $hospital) : ?>
                        <tr>
                           <td data-search="<?php echo $hospital['id']; ?>">H00<?php echo $hospital['id']; ?></td>
                           <td data-search="<?php echo $hospital['name']; ?>"><?php echo ucfirst($hospital['name']); ?></td>
                           <td data-search="<?php echo $hospital['address']; ?>"><?php echo $hospital['address']; ?></td>
                           <td data-search="<?php echo $hospital['contact']; ?>"><?php echo $hospital['contact']; ?></td>
                           <td data-search="<?php echo $hospital['hospital_fee']; ?>">Rs.<?php echo $hospital['hospital_fee']; ?></td>
                           <td data-search="<?php echo $hospital['working_hours']; ?>"><?php echo $hospital['working_hours']; ?></td>
                           <td><a href="<?php echo $hospital['location']; ?>" target="_blank"><img src="<?= ROOT ?>/assets/img/admin/location.svg" height="40px" width="40px"></a></td>
                           <td><button class="btn-edit" onclick="hospitalEditPopup(<?php echo htmlspecialchars(json_encode($hospital)); ?>"><img src="<?= ROOT ?>/assets/img/admin/edit.svg"></button></td>
                        </tr>
                     <?php endforeach; ?>

                  <?php else: ?>
                     <p>No Hospitals found.</p>
                  <?php endif; ?>

               </tbody>
            </table>
         </div>

      </section>

      <!-- Create Card -->
      <div class="overlay"></div>
      <div class="popup">
         <h2>Add A New Hospital</h2>
         <form id="create-hospital-form" action="<?= ROOT ?>/Admin/hospitals/create" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="create-hospital-id">
            <div class="form-row">
               <div class="form-group">
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="name" placeholder=" " id="create-hospital-name" required>
                        <label>Hospital Name</label>
                     </div>
                     <div class="form-group">
                        <input type="text" name="address" placeholder=" " id="create-hospital-address" required>
                        <label>Address</label>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="contact" placeholder=" " id="create-hospital-contact" required>
                        <label>Contact Number</label>
                     </div>
                     <div class="form-group">
                        <input type="url" name="location" placeholder=" " id="create-hospital-location" required>
                        <label>Location (Google Maps)</label>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="hospital_fee" placeholder="" id="create-hospital-fee" required>
                        <label>Hospital Fee (Rs.)</label>
                     </div>
                     <div class="form-group">
                        <input type="text" name="working_hours" placeholder="eg: 24h " id="create-hospital-working" required>
                        <label>Working Hours</label>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group">
                        <textarea name="description" rows="10" placeholder=" " id="create-hospital-des"></textarea>
                        <label>Description</label>
                     </div>

                     <div class="form-group">
                        <p style="color:#007bff; margin-top: -1rem; margin-left: 10px;">Services Provided</p>
                        <div class="form-checkbox">
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="Family Physician" id="create-hospital-services">
                              <span>Family Physician</span>
                              <input type="checkbox" name="services[]" value="Diabetes Centre" id="create-hospital-services">
                              <span>Diabetes Centre</span>
                           </div>
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="Psychiatric Care" id="create-hospital-services">
                              <span>Psychiatric Care</span>
                              <input type="checkbox" name="services[]" value="Radiology" id="create-hospital-services">
                              <span>Radiology</span>
                           </div>
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="Heart Centre" id="create-hospital-services">
                              <span>Heart Centre</span>
                              <input type="checkbox" name="services[]" value="General Surgery" id="create-hospital-services">
                              <span>General Surgery</span>
                           </div>
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="Orthopedics" id="create-hospital-services">
                              <span>Orthopedics</span>
                              <input type="checkbox" name="services[]" value="Cancer Care" id="create-hospital-services">
                              <span>Cancer Care</span>
                           </div>
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="Neonatal Care" id="create-hospital-services">
                              <span>Neonatal Care</span>
                              <input type="checkbox" name="services[]" value="Intensive Care" id="create-hospital-services">
                              <span>Intensive Care</span>
                           </div>
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="Cosmetic Centre" id="create-hospital-services">
                              <span>Cosmetic Centre</span>
                              <input type="checkbox" name="services[]" value="Urology" id="create-hospital-services">
                              <span>Urology</span>
                           </div>

                        </div>
                     </div>
                  </div>
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
         <form id="edit-clerk-form" action="<?= ROOT ?>/Admin/clerk /edit" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="emp_id" id="edit-clerk-id">
            <input type="hidden" name="user_id" id="edit-user-id">
            <div class="form-row">
               <input type="file" id="edit-doctor-image" name="clerk-image" accept="image/*" hidden>
               <img src="<?= ROOT ?>/assets/img/user.svg" alt="Image Preview" class="image-preview" id="edit-image-preview" onclick="document.getElementById('edit-doctor-image').click();">
               <div class="form-group">
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="name" placeholder=" " id="edit-clerk-name" required>
                        <label>Full Name</label>
                     </div>
                     <div class="form-group">
                        <input type="email" name="email" placeholder=" " id="edit-clerk-email" required>
                        <label>Email</label>
                     </div>
                  </div>
                  <div class="form-row">
                     <!-- <div class="form-group">
                        
                        <select name="gender" id="edit-clerk-gender">
                           <option value="Male" selected>Male</option>
                           <option value="Female">Female</option>
                        </select>
                        <label>Gender</label>
                     </div> -->
                     <div class="form-group">
                        <input type="text" name="nic" placeholder=" " id="edit-clerk-nic" required>
                        <label>NIC</label>
                     </div>
                     <div class="form-group">
                        <input type="text" name="phone_number" placeholder=" " id="edit-clerk-phone" required>
                        <label>Phone Number</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group">
                  <input type="hidden">
                  <label>Type</label>
                  <select name="type" id="edit-clerk-type">
                     <option value="lab" selected>Lab clerk</option>
                     <option value="record">Record clerk</option>
                     <option value="reception">Reception clerk</option>
                  </select>
               </div>
               <div class="form-group">
                  <input type="text" name="emp_id" id="edit-clerk-emp-id" required disabled>
                  <label>Employee Number</label>

               </div>
            </div>
            <div class="form-row">
               <div class="form-group">
                  <input type="hidden">
                  <label>Hospital</label>
                  <select name="hospital" id="edit-clerk-hospital" onchange="toggleDropdownsEdit()">
                     <option value="" selected>None</option>
                     <?php foreach ($hospitals as $hospital): ?>
                        <option value="<?php echo $hospital['id']; ?>"><?php echo $hospital['name']; ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
               <div class="form-group">
                  <input type="hidden">
                  <label>Laboratory</label>
                  <select name="lab" id="edit-clerk-lab" onchange="toggleDropdownsEdit()">
                     <option value="" selected>None</option>
                     <?php foreach ($labs as $lab): ?>
                        <option value="<?php echo $lab['id']; ?>"><?php echo $lab['name']; ?></option>
                     <?php endforeach; ?>
                  </select>

               </div>
            </div>
            <div class="form-row">
               <button type="submit" class="btn-create">Update</button>
               <button type="button" class="btn-cancel" onclick="closeEditPopup()">Cancel</button>
            </div>
         </form>
      </div>

   </div>
</body>

</html>