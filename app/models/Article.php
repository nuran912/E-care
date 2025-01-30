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
}