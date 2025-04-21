<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Read Article</title>
   <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/articles.css">
   <script src="<?php echo ROOT ?>/assets/js/articles.js"></script>
</head>

<body>
   <?php if (isset($articles) && is_array($articles)): ?>
      <?php foreach ($articles as $article): ?>
         <div class="article-cover">
            <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="Cover Image">
            <div class="cover-overlay">
               <h1><?php echo htmlspecialchars($article['title']); ?></h1>
            </div>
         </div>
         <div class="article-details">
            <p class="article-description"><?php echo htmlspecialchars($article['description']); ?></p>
            <p class="article-content"><?php echo nl2br(($article['content'])); ?></p>
            <span class="publish-date">Published on: <?php echo htmlspecialchars($article['publish_date']); ?></span>
         </div>
      <?php endforeach; ?>
   <?php else: ?>
      <p class="no-article">No Article found.</p>
   <?php endif; ?>
   <div class="back-button">
      <a href="<?= ROOT ?>/Articles">Back to Articles</a>
   </div>
</body>

</html>