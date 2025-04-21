<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Aricles</title>
   <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/articles.css">
   <script src="<?php echo ROOT ?>/assets/js/articles.js"></script>
</head>

<body>
   <div class="dashboard-container">

      <section class="hero">
         <h1>Welcome to Our Articles</h1>
         <p>Discover the latest insights, trends, and stories curated just for you.</p>
         <a href="#articles" class="btn-cta">Explore Now</a>
      </section>

      <section class="main-div">
         <div class="search">
            <h2>Find Article</h2>
            <input type="search" id="search-bar" class="search-bar" placeholder="Search by title or category...">
            <button type="button" class="btn-search" id="btn-search">Search</button>
         </div>
      </section>
      
      <div class="articles" id="articles">
         <?php if (isset($articles) && is_array($articles)): ?>
            <div class="cards" id="article-cards">
               <?php foreach ($articles as $article): ?>
                  <div class="card" data-title="<?php echo htmlspecialchars($article['title']); ?>" data-category="<?php echo htmlspecialchars($article['category']); ?>" data-date="<?php echo htmlspecialchars($article['publish_date']); ?>">
                     <div class="article-img"><img src="<?php echo htmlspecialchars($article['image_url']); ?>" ></div>
                     <div class="card-meta">
                        <span><?php echo htmlspecialchars($article['publish_date']); ?></span>
                        <span><?php echo htmlspecialchars($article['category']); ?></span>
                     </div>
                     <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                     <a href="<?= ROOT?>/Articles/read/<?php echo htmlspecialchars($article['article_id']); ?>">Read</a>
                  </div>
               <?php endforeach; ?>
            </div>
            <div class="pagination" id="pagination">
               <!-- Pagination buttons will be dynamically generated -->
            </div>
         <?php else: ?>
            <p>No Articles found.</p>
         <?php endif; ?>
      </div>
   </div>
</body>

</html>