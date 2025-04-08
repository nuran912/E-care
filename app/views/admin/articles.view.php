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
            <span>Admin Jane</span>
            <span class="role-badge">ADMIN</span>
         </div>

      </header>
      <!-- show file error here -->

      <?php if ((isset($_FILES['article-image']['error'])) && $_FILES['article-image']['error'] !== 0) : ?>
         <div class="error"><?php echo $_FILES['article-image']['error']; ?></div>
      <?php endif; ?>
      <?php if (isset($create_success)): ?>
         <div class="success"><?php echo $create_success; ?></div>
      <?php endif; ?>
      <?php if (isset($delete_success)): ?>
         <div class="success"><?php echo $delete_success; ?></div>
      <?php endif; ?>
      <?php if (isset($edit_success)): ?>
         <div class="success"><?php echo $edit_success; ?></div>
      <?php endif; ?>

      <section class="main-div">
         <div class="search">
            <h2>Find Article</h2>
            <input type="search" class="search-bar" placeholder="Search article here...">
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
                     <th>No. of views</th>
                     <th>Delete</th>
                     <th>Edit</th>
                  </tr>
               </thead>
               <tbody>
                  <?php if (isset($articles) && is_array($articles)): ?>

                     <?php foreach ($articles as $article): ?>
                        <tr>
                           <td><img class="insurance-img" src="<?php echo esc($article['image_url']); ?>"></td>
                           <td><?php echo esc($article['title']); ?></td>
                           <td><?php echo esc($article['category']); ?></td>
                           <td style="font-size: 13px;"><?php echo esc($article['description']); ?></td>
                           <td style="font-size: 13px;"><?php echo esc($article['publish_date']); ?></td>
                           <td><?php echo esc($article['views']); ?></td>
                           <td>
                              <form action="<?= ROOT ?>/Admin/articles/delete/<?php echo esc($article['article_id']); ?>/" method="GET" onsubmit="return confirmDelete();">
                                 <button class="btn-delete" type="submit"><img src="<?= ROOT ?>/assets/img/admin/delete.svg"></button>
                              </form>
                           </td>
                           <td><button class="btn-edit"  onclick="openEditPopup(<?php echo htmlspecialchars(json_encode($article)); ?>)"><img src="<?= ROOT ?>/assets/img/admin/edit.svg"></button></td>
                        </tr>
                     <?php endforeach; ?>

                  <?php else: ?>
                     <p>No Articles found.</p>
                  <?php endif; ?>

               </tbody>
            </table>
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
         function confirmDelete(){
            return confirm('Are you sure you want to delete this article?');
         }
      </script>
      <script src="<?php echo ROOT ?>/assets/js/create.js"></script>

   </div>
</body>

</html>