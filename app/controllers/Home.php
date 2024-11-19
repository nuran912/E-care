<?php

class Home extends Controller {
    public function index($a = '', $b = '', $c = '') {
        $this->view('header');
        
        $insurance_company = new InsuranceCompany;
        $insurance_company->setLimit(4);
        $insurance_companies = $insurance_company->findAll();

        $article = new Article;
        $article->setLimit(3);
        $articles = $article->findAll();
        // show($articles);
        
        // Pass the data to the view
        $data = [
            'insurance_companies' => $insurance_companies,
            'articles' => $articles
        ];
        $this->view('home', $data);
        $this->view('footer');
    }
}

