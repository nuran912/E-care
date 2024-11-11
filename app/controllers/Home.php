<?php

class Home extends Controller {
    public function index($a = '', $b = '', $c = '') {
        $this->view('header');
        
        $insurance_company = new InsuranceCompany;
        $insurance_companies = $insurance_company->findAll();
        
        // Pass the data to the view
        $this->view('home', ['insurance_companies' => $insurance_companies]);
        $this->view('footer');
    }
}

