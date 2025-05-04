<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin - Aricles</title>
   <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/user.css">
</head>

<body>
   <div class="dashboard-container">
      <header>
         <p>Articles</p>
         <div class="user-info">
            <span><?php echo (ucwords($_SESSION['USER']->name)); ?></span>
            <span class="role-badge">ADMIN</span>
         </div>

      </header>
      <!-- show file error here -->

      <!-- <?php if ((isset($_FILES['article-image']['error'])) && $_FILES['article-image']['error'] !== 0) : ?>
         <div class="error"><?php echo $_FILES['article-image']['error']; ?></div>
      <?php endif; ?> -->
      <?php if (isset($_SESSION['edit_success'])): ?>
         <div class="success" id="msgBox"><?php echo $_SESSION['edit_success']; ?></div>
         <?php unset($_SESSION['edit_success']); ?>
      <?php endif; ?>
      <?php if (isset($_SESSION['create_success'])): ?>
         <div class="success" id="msgBox"><?php echo $_SESSION['create_success']; ?></div>
         <?php unset($_SESSION['create_success']); ?>
      <?php endif; ?>
      <?php if (isset($_SESSION['create_error'])): ?>
         <div class="error" id="msgBox"><?php echo $_SESSION['create_error']; ?></div>
         <?php unset($_SESSION['create_error']); ?>
      <?php endif; ?>

      <section class="main-div">
         <div class="search">
            <h2>Find Article</h2>
            <input type="search" class="search-bar" id="search-articles" name="search-articles" placeholder="Search article here..." oninput="filterArticles()">
            <button type="submit" class="btn-search">Search</button>
         </div>


         <div class="search">
            <h2>Add New Article</h2>
            <button type="submit" name="create-doctor" class="btn-search">Create</button>

         </div>
      </section>
      <section class="tables-section">
         <div class="table-card">
            <table>
               <thead>
                  <tr>
                     <th>Cover image</th>
                     <th>Title</th>
                     <th>Category</th>
                     <th>Description</th>
                     <th>Publish Date</th>
                     <th>Delete</th>
                     <th>Edit</th>
                  </tr>
               </thead>
               <tbody id="article-table-body">
                  <?php if (isset($articles) && is_array($articles)): ?>

                     <?php foreach ($articles as $article): ?>
                        <tr>
                           <td><img class="insurance-img" src="<?php echo esc($article['image_url']); ?>"></td>
                           <td data-search="<?php echo esc($article['title']); ?>"><?php echo esc($article['title']); ?></td>
                           <td data-search="<?php echo esc($article['category']); ?>"><?php echo esc($article['category']); ?></td>
                           <td style="font-size: 13px;" data-search="<?php echo esc($article['description']); ?>"><?php echo esc($article['description']); ?></td>
                           <td style="font-size: 13px;" data-search="<?php echo esc($article['publish_date']); ?>"><?php echo esc($article['publish_date']); ?></td>
                           <td>
                              <form action="<?= ROOT ?>/Admin/articles/delete/<?php echo esc($article['article_id']); ?>/" method="GET" onsubmit="return confirmDelete();">
                                 <button class="btn-delete" type="submit"><img src="<?= ROOT ?>/assets/img/admin/delete.svg"></button>
                              </form>
                           </td>
                           <td><button class="btn-edit" onclick="openEditPopup(<?php echo htmlspecialchars(json_encode($article)); ?>)"><img src="<?= ROOT ?>/assets/img/admin/edit.svg"></button></td>
                        </tr>
                     <?php endforeach; ?>

                  <?php else: ?>
                     <p>No Articles found.</p>
                  <?php endif; ?>

               </tbody>
            </table>
            <div class="pagination">
               <button id="prev-page" onclick="changePage(-1)">Prev</button>
               <span id="page-numbers"></span>
               <button id="next-page" onclick="changePage(1)">Next</button>
            </div>
         </div>

      </section>

      <!-- Create Card -->
      <div class="overlay"></div>
      <div class="popup">
         <h2>Add New Article</h2>
         <form action="<?= ROOT ?>/Admin/articles/create" method="POST" enctype="multipart/form-data">
            <div class="form-row">
               <div class="form-group">
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="title" placeholder=" " required>
                        <label>Title</label>
                     </div>
                     <div class="form-group">
                        <input type="text" name="category" placeholder=" " required>
                        <label>Category</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group">
                  <input type="file" id="create-doctor-image" name="article-image" accept="image/*" hidden>
                  <img src="" class="article-img-preview" name="article-image" id="image-preview" onclick="document.getElementById('create-doctor-image').click();">

               </div>
               <div class="form-group">
                  <textarea name="description" rows="5" placeholder=" " required></textarea>
                  <label>Description</label>
               </div>
            </div>
            <div class="form-group">

               <textarea name="content" rows="7" placeholder=" " required></textarea>
               <label>Content</label>

            </div>
            <div class="form-row">
               <button type="submit" class="btn-create">Create</button>
               <button type="button" class="btn-cancel">Cancel</button>
            </div>
         </form>
      </div>
      <!-- End Create Card -->

      <!-- Edit Card -->
      <div class="popup-edit">
         <h2>Edit Article</h2>
         <form id="edit-article-form" action="<?= ROOT ?>/Admin/articles/edit" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="article_id" id="edit-article-id">
            <input type="hidden" name="image_url" id="image-url">
            <div class="form-row">
               <div class="form-group">
                  <div class="form-row">
                     <div class="form-group">
                        <input type="text" name="title" id="edit-title" placeholder=" " required>
                        <label>Title</label>
                     </div>
                     <div class="form-group">
                        <input type="text" name="category" id="edit-category" placeholder=" " required>
                        <label>Category</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group">
                  <input type="file" id="edit-article-image" name="article-image" accept="image/*" hidden>
                  <img src="" class="article-img-preview" name="article-image" id="edit-image-preview" onclick="document.getElementById('edit-article-image').click();">
               </div>
               <div class="form-group">
                  <textarea name="description" id="edit-description" rows="5" placeholder=" " required></textarea>
                  <label>Description</label>
               </div>
            </div>
            <div class="form-group">
               <textarea name="content" id="edit-content" rows="7" placeholder=" " required></textarea>
               <label>Content</label>
            </div>
            <div class="form-row">
               <button type="submit" class="btn-create">Update</button>
               <button type="button" class="btn-cancel" onclick="closeEditPopup()">Cancel</button>
            </div>
         </form>
      </div>
      <script>
         function confirmDelete() {
            return confirm('Are you sure you want to delete this article?');
         }
         const messageBox = document.getElementById('msgBox');
         if (messageBox) {
            setTimeout(() => {
               messageBox.style.display = 'none';
               location.reload();
            }, 5000);
         }

         let currentPage = 1;
         const rowsPerPage = 5;
         let filteredRows = []; // Store filtered rows

         function paginateTable() {
            const tableBody = document.getElementById('article-table-body');
            if (!tableBody) {
               console.error('Element #user-table-body not found');
               return;
            }

            const rows = filteredRows.length > 0 ? filteredRows : Array.from(tableBody.querySelectorAll('tr'));
            const totalRows = rows.length;
            const totalPages = Math.ceil(totalRows / rowsPerPage);

            rows.forEach((row, index) => {
               row.style.display = (index >= (currentPage - 1) * rowsPerPage && index < currentPage * rowsPerPage) ? '' : 'none';
            });

            const pageNumbers = document.getElementById('page-numbers');
            if (pageNumbers) {
               pageNumbers.textContent = `Page ${currentPage} of ${totalPages}`;
            }

            const prevButton = document.getElementById('prev-page');
            const nextButton = document.getElementById('next-page');
            if (prevButton && nextButton) {
               prevButton.disabled = currentPage === 1;
               nextButton.disabled = currentPage === totalPages;
            }
         }

         function changePage(direction) {
            currentPage += direction;
            paginateTable();
         }

         // Search and filter function
         function filterArticles() {
            const searchInput = document.getElementById('search-articles');
            if (!searchInput) {
               console.error('Element #search-users not found');
               return;
            }

            const searchValue = searchInput.value.toLowerCase();
            const tableBody = document.getElementById('article-table-body');
            const tableRows = Array.from(tableBody.querySelectorAll('tr'));

            // Update filteredRows based on the search input
            filteredRows = tableRows.filter(row => {
               const cells = row.querySelectorAll('td[data-search]');
               return Array.from(cells).some(cell =>
                  cell.getAttribute('data-search').toLowerCase().includes(searchValue)
               );
            });

            // Hide all rows if no match is found
            tableRows.forEach(row => {
               row.style.display = 'none';
            });

            // Show only the filtered rows
            filteredRows.forEach(row => {
               row.style.display = '';
            });

            currentPage = 1; // Reset to the first page after filtering
            paginateTable(); // Reapply pagination to filtered rows
         }

         document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-artilces');
            if (searchInput) {
               searchInput.addEventListener('input', filterArticles); // Ensure filterUsers is triggered
            }

            paginateTable(); // Initialize pagination
         });
      </script>
      <script src="<?php echo ROOT ?>/assets/js/create.js"></script>

   </div>
</body>

</html>