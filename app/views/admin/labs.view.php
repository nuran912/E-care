<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin - Laboratories</title>
   <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/user.css">
</head>

<body>
   <div class="dashboard-container">
      <header>
         <p>Laboratories</p>
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
      <?php if (isset($_SESSION['create_success'])): ?>
         <div class="success" id="msgBox"><?php echo $_SESSION['create_success']; ?></div>
         <?php unset($_SESSION['create_success']); ?>
      <?php endif; ?>

      <section class="main-div">
         <div class="search">
            <h2>Find Laboratory</h2>
            <input type="search" class="search-bar" id="search-labs" name="search-labs" placeholder="Search Laboratory here..." oninput="filterLabs()">
            <button type="submit" class="btn-search">Search</button>
         </div>


         <div class="search">
            <h2>Add A New Laboratory</h2>
            <button type="submit" name="create-doctor" class="btn-search">Create</button>
         </div>
      </section>
      <section class="tables-section">
         <div class="table-card">
            <table>
               <thead>
                  <tr>
                     <th>Laboratory Code</th>
                     <th>Name</th>
                     <th>Address</th>
                     <th>Contact</th>
                     <th>Lab Fee</th>
                     <th>Working Hours</th>
                     <th>Location</th>
                     <th>Edit</th>
                  </tr>
               </thead>
               <tbody id="labs-table-body">
                  <?php if (isset($labs) && is_array($labs)): ?>
                     <?php foreach ($labs as $lab) : ?>
                        <tr>
                           <td data-search="<?php echo $lab['id']; ?>">L00<?php echo $lab['id']; ?></td>
                           <td data-search="<?php echo $lab['name']; ?>"><?php echo ucfirst($lab['name']); ?></td>
                           <td data-search="<?php echo $lab['address']; ?>"><?php echo $lab['address']; ?></td>
                           <td data-search="<?php echo $lab['contact']; ?>"><?php echo $lab['contact']; ?></td>
                           <td data-search="<?php echo $lab['lab_fee']; ?>">Rs.<?php echo $lab['lab_fee']; ?></td>
                           <td data-search="<?php echo $lab['working_hours']; ?>"><?php echo $lab['working_hours']; ?></td>
                           <td><a href="<?php echo $lab['location']; ?>" target="_blank"><img src="<?= ROOT ?>/assets/img/admin/location.svg" height="40px" width="40px"></a></td>
                           <td><button class="btn-edit" onclick="labEditPopup(<?php echo htmlspecialchars(json_encode($lab)); ?>)"><img src="<?= ROOT ?>/assets/img/admin/edit.svg"></button></td>
                        </tr>
                     <?php endforeach; ?>

                  <?php else: ?>
                     <p>No Laboratories found.</p>
                  <?php endif; ?>

               </tbody>
            </table>
         </div>

      </section>

      <!-- Create Card -->
      <div class="overlay"></div>
      <div class="popup">
         <h2>Add A New Laboratory</h2>
         <form id="create-hospital-form" action="<?= ROOT ?>/Admin/labs/create" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="create-hospital-id">
            <div class="form-row">
               <div class="form-group">
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="name" placeholder=" " id="create-hospital-name" required>
                        <label>Laboratory Name</label>
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
                        <input type="text" name="lab_fee" placeholder="" id="create-hospital-fee" required>
                        <label>Laboratory Fee (Rs.)</label>
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
                              <input type="checkbox" name="services[]" value="Blood Testing" id="create-hospital-services">
                              <span>Blood Testing</span>
                              <input type="checkbox" name="services[]" value="Urine Analysis" id="create-hospital-services">
                              <span>Urine Analysis</span>
                           </div>
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="Pathology Services" id="create-hospital-services">
                              <span>Pathology Services</span>
                              <input type="checkbox" name="services[]" value="Microbiology Testing" id="create-hospital-services">
                              <span>Microbiology Testing</span>
                           </div>
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="Genetic Testing" id="create-hospital-services">
                              <span>Genetic Testing</span>
                              <input type="checkbox" name="services[]" value="Drug Screening" id="create-hospital-services">
                              <span>Drug Screening</span>
                           </div>
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="Hormone Testing" id="create-hospital-services">
                              <span>Hormone Testing</span>
                              <input type="checkbox" name="services[]" value="Cancer Screening" id="create-hospital-services">
                              <span>Cancer Screening</span>
                           </div>
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="Allergy Testing" id="create-hospital-services">
                              <span>Allergy Testing</span>
                              <input type="checkbox" name="services[]" value="Pregnancy Testing" id="create-hospital-services">
                              <span>Pregnancy Testing</span>
                           </div>
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="STD Testing" id="create-hospital-services">
                              <span>STD Testing</span>
                              <input type="checkbox" name="services[]" value="DNA Testing" id="create-hospital-services">
                              <span>DNA Testing</span>
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
         <h2>Edit Laboratory</h2>
         <form id="edit-lab-form" action="<?= ROOT ?>/Admin/labs/edit" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="edit-lab-id">
            <div class="form-row">
               <div class="form-group">
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="name" placeholder=" " id="edit-lab-name" required>
                        <label>Hospital Name</label>
                     </div>
                     <div class="form-group">
                        <input type="text" name="address" placeholder=" " id="edit-lab-address" required>
                        <label>Address</label>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="contact" placeholder=" " id="edit-lab-contact" required>
                        <label>Contact Number</label>
                     </div>
                     <div class="form-group">
                        <input type="url" name="location" placeholder=" " id="edit-lab-location" required>
                        <label>Location (Google Maps)</label>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="lab_fee" placeholder="" id="edit-lab-fee" required>
                        <label>Laboratory Fee (Rs.)</label>
                     </div>
                     <div class="form-group">
                        <input type="text" name="working_hours" placeholder="eg: 24h " id="edit-lab-working" required>
                        <label>Working Hours</label>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group">
                        <textarea name="description" rows="10" placeholder=" " id="edit-lab-des"></textarea>
                        <label>Description</label>
                     </div>

                     <div class="form-group">
                        <p style="color:#007bff; margin-top: -1rem; margin-left: 10px;">Services Provided</p>
                        <div class="form-checkbox">
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="Blood Testing" id="edit-lab-services">
                              <span>Blood Testing</span>
                              <input type="checkbox" name="services[]" value="Urine Analysis" id="edit-lab-services">
                              <span>Urine Analysis</span>
                           </div>
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="Pathology Services" id="edit-lab-services">
                              <span>Pathology Services</span>
                              <input type="checkbox" name="services[]" value="Microbiology Testing" id="edit-lab-services">
                              <span>Microbiology Testing</span>
                           </div>
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="Genetic Testing" id="edit-lab-services">
                              <span>Genetic Testing</span>
                              <input type="checkbox" name="services[]" value="Drug Screening" id="edit-lab-services">
                              <span>Drug Screening</span>
                           </div>
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="Hormone Testing" id="edit-lab-services">
                              <span>Hormone Testing</span>
                              <input type="checkbox" name="services[]" value="Cancer Screening" id="edit-lab-services">
                              <span>Cancer Screening</span>
                           </div>
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="Allergy Testing" id="edit-lab-services">
                              <span>Allergy Testing</span>
                              <input type="checkbox" name="services[]" value="Pregnancy Testing" id="edit-lab-services">
                              <span>Pregnancy Testing</span>
                           </div>
                           <div class="form-row">
                              <input type="checkbox" name="services[]" value="STD Testing" id="edit-lab-services">
                              <span>STD Testing</span>
                              <input type="checkbox" name="services[]" value="DNA Testing" id="edit-lab-services">
                              <span>DNA Testing</span>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="form-row">
               <button type="submit" class="btn-create">Update</button>
               <button type="button" class="btn-cancel" onclick="closeEditPopup()">Cancel</button>
            </div>
         </form>
      </div>

   </div>
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

</body>

</html>