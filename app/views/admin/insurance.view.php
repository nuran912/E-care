<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin - Insurance Partners</title>
   <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/user.css">
</head>

<body>
   <div class="dashboard-container">
      <header>
         <p>Insurance Partners</p>
         <div class="user-info">
            <span>Admin Jane</span>
            <span class="role-badge">ADMIN</span>
         </div>
      </header>

      <section class="main-div">
         <div class="search">
            <h2>Find Insurance Partner</h2>
            <input type="search" class="search-bar" placeholder="Search user here...">
            <button type="submit" class="btn-search">Search</button>
         </div>


         <div class="search">
            <h2>Add New Insurance Partners</h2>
            <button type="submit" name="create-doctor" class="btn-search">Create</button>
         </div>
      </section>
      <section class="tables-section">
         <div class="table-card">
            <table>
               <thead>
                  <tr>
                     <th>Logo</th>
                     <th>Name</th>
                     <th>Claim Email</th>
                     <th>Web Link</th>
                     <th>Phone</th>
                     <th>Status</th>
                     <th>Edit</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td><img class="insurance-img" src="<?php echo ROOT ?>/assets/img/home-img/insurance/allianz.svg"></td>
                     <td>Allianz Lanka</td>
                     <td>allianz.health@gmail.com</td>
                     <td><a href="#">Allianz</a></td>
                     <td>0761234567</td>
                     <td><button class="btn-active">Active</button></td>
                     <td><button class="btn-edit"><img src="<?= ROOT ?>/assets/img/admin/edit.svg"></button></td>
                  </tr>
                  <tr>
                     <td><img class="insurance-img" src="<?php echo ROOT ?>/assets/img/home-img/insurance/aia.svg"></td>
                     <td>AIA Sri Lanka</td>
                     <td>aia.health@yahoo.lk</td>
                     <td><a href="">AIA</a></td>
                     <td>0766584235</td>
                     <td><button class="btn-active">Active</button></td>
                     <td><button class="btn-edit"><img src="<?= ROOT ?>/assets/img/admin/edit.svg"></button></td>
                  </tr>
                  <tr>
                     <td><img class="insurance-img" src="<?php echo ROOT ?>/assets/img/home-img/insurance/ceylinco.svg"></td>
                     <td>Ceylinco Life</td>
                     <td>ceylinco.health@gmail.com</td>
                     <td><a href="#">Ceylico</a></td>
                     <td>0767913254</td>
                     <td><button class="btn-active">Active</button></td>
                     <td><button class="btn-edit"><img src="<?= ROOT ?>/assets/img/admin/edit.svg"></button></td>
                  </tr>
                  <tr>
                     <td><img class="insurance-img" src="<?php echo ROOT ?>/assets/img/home-img/insurance/softlogic.svg"></td>
                     <td>Softlogic Life</td>
                     <td>softlogic.life@gmail.com</td>
                     <td><a href="#">SoftLogic</a></td>
                     <td>0763561284</td>
                     <td><button class="btn-active">Active</button></td>
                     <td><button class="btn-edit"><img src="<?= ROOT ?>/assets/img/admin/edit.svg"></button></td>
                  </tr>

               </tbody>
            </table>
         </div>

      </section>

      <!-- Create Card -->
      <div class="overlay"></div>
      <div class="popup">
         <h2>Add New Insurance Partners</h2>
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
                  <!-- <input type="text" name="role" placeholder=" " required> -->
                  <select name="role" id="role">
                     <option value="lab">Lab clerk</option>
                     <option value="record">Record clek</option>
                     <option value="reception">Reception clerk</option>
                  </select>
                  <label>Role</label>
               </div>
               <div class="form-group">
                  <input type="text" name="doctor-number" placeholder=" " style="width: 300px;" required>
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

      <!-- End Create Card -->

      <!-- Edit Card -->
      <div class="popup-edit">
         <h2>Edit Insurance Partners</h2>
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
               <button type="button" class="btn-create">Create</button>
               <button type="button" class="btn-cancel">Cancel</button>
            </div>
         </form>
      </div>
      <script src="<?php echo ROOT ?>/assets/js/create.js"></script>

   </div>
</body>

</html>