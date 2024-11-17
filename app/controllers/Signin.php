<?php

class Signin extends Controller {
    public function index($a = '', $b = '', $c = '') {
        $this->view('header');
        
         $this->view('signin');

        $this->view('footer');
    }
}

