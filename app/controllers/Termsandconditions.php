<?php

class TermsAndconditions extends Controller
{
    public function index()
    {
        $this->view('header');
        $this->view('termsAndConditions');
        $this->view('footer');
    }
}
