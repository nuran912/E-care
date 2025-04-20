<?php

class Articles extends Controller {
   public function index($a = '', $b = '', $c = '') {
       $this->view('header');
      
       $article = new Article;
      //  $article->setLimit(3);
       $article->order_type = 'desc';
       $articles = $article->findAll();
       
      //  $username = empty($_SESSION['USER']) ? 'Guest' : $_SESSION['USER']->name;

       $data = [
           'articles' => $articles
         //   'username' => $username
       ];
       $this->view('articles', $data);
       $this->view('footer');
   }
   public function read($a = '', $b = '', $c = '') {
      $this->view('header');
     
      $article = new Article;
     //  $article->setLimit(3);
      $article->order_type = 'desc';      
      $article_id = $a;
      // show($article_id);
      $article->setLimit(1);
      
      $articles = $article->getArticleById($article_id);
      // show($articles);

      if (empty($articles)) {
         $this->view('error', ['message' => 'Article not found']);
         return;
      }

      $data = [
         'articles' => $articles
      ];
      
      $this->view('readArticle', $data);
      $this->view('footer');
  }
}

?>