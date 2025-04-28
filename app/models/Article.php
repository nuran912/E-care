<?php

class Article {
   use Model;

   protected $table = 'articles';

   protected $allowedColumns = [
      'article_id',
      'image_url',
      'title',
      'category',
      'description',
      'content',
      'publish_date',
      'author_id',
      'views',
      'created_at',
      'updated_at'
   ];

   public $order_column = 'created_at';

   public function countAllArticlesLastMonth() {
      $sql = "SELECT COUNT(*) as total FROM $this->table WHERE created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
      // $sql = "SELECT COUNT(*) as total FROM $this->table"; 
      $result = $this->query($sql);
      return $result ? $result[0]->total : 0;
   }

   //get article by ID
   public function getArticleById($article_id) {
      $sql = "SELECT * FROM $this->table WHERE article_id = :article_id";
      $params = [':article_id' => $article_id];
      $result = $this->query($sql, $params);
      return json_decode(json_encode($result), true);
   }
}