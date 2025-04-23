<?php

class Home extends Controller {
    public function index($a = '', $b = '', $c = '') {
        $this->view('header');


        $article = new Article;
        $article->setLimit(3);
        $article->order_type = 'desc';
        $articles = $article->findAll();
        
        $username = empty($_SESSION['USER']) ? 'Guest' : $_SESSION['USER']->name;

        $data = [
            'articles' => $articles,
            'username' => $username
        ];
        $this->view('home', $data);
        $this->view('footer');
    }
}

