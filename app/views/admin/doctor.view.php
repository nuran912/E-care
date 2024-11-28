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
            <span>Admin Jane</span>
            <span class="role-badge">ADMIN</span>
         </div>
      </header>

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
                     <th>Doctor Number</th>
                     <th>Full Name</th>
                     <th>Speacilization</th>
                     <th>Email</th>
                     <th>Phone</th>
                     <th>NIC</th>
                     <th>Status</th>
                     <th>Password</th>
                     <th>Edit</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>D001</td>
                     <td>Mohamed Athhar</td>
                     <td>General</td>
                     <td>athhar@gmail.com</td>
                     <td>0761234567</td>
                     <td>200212345678</td>
                     <td><button class="btn-active">Active</button></td>
                     <td><button class="btn-reset">Reset</button></td>
                     <td><button class="btn-edit"><img src="<?= ROOT ?>/assets/img/admin/edit.svg"></button></td>
                  </tr>
                  <tr>
                     <td>D001</td>
                     <td>Nuran Alwis</td>
                     <td>General</td>
                     <td>nuran@gmail.com</td>
                     <td>0761985642</td>
                     <td>200254268791</td>
                     <td><button class="btn-disable">Disable</button></td>
                     <td><button class="btn-reset">Reset</button></td>
                     <td><button class="btn-edit"><img src="<?= ROOT ?>/assets/img/admin/edit.svg"></button></td>
                  </tr>
                  <tr>
                     <td>D001</td>
                     <td>Manusha Ranaweera</td>
                     <td>General</td>
                     <td>manusha@gmail.com</td>
                     <td>0763259465</td>
                     <td>200265894154</td>
                     <td><button class="btn-active">Active</button></td>
                     <td><button class="btn-reset">Reset</button></td>
                     <td><button class="btn-edit"><img src="<?= ROOT ?>/assets/img/admin/edit.svg"></td>
                  </tr>
                  <tr>
                     <td>D001</td>
                     <td>Okadini KDI</td>
                     <td>General</td>
                     <td>okadini@gmail.com</td>
                     <td>0761234567</td>
                     <td>200212345678</td>
                     <td><button class="btn-active">Active</button></td>
                     <td><button class="btn-reset">Reset</button></td>
                     <td><button class="btn-edit"><img src="<?= ROOT ?>/assets/img/admin/edit.svg"></td>
                  </tr>

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
                  <textarea name="qualifications" rows="4" >MBBS, MD (General Medicine) - 2010 
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