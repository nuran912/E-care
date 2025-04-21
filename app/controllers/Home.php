<?php

class Home extends Controller {
    public function index($a = '', $b = '', $c = '') {
        $this->view('header');
        
        // show($_SESSION);

        $insurance_company = new InsuranceCompany;
        $insurance_company->setLimit(4);
        $insurance_companies = $insurance_company->findAll();

        $article = new Article;
        $article->setLimit(3);
        $articles = $article->findAll();
        
        $username = empty($_SESSION['USER']) ? 'Guest' : $_SESSION['USER']->name;

        $data = [
            'insurance_companies' => $insurance_companies,
            'articles' => $articles,
            'username' => $username
        ];
        $this->view('home', $data);
        $this->view('footer');
    }
}

