<?php

class Home extends Controller {
    public function index($a = '', $b = '', $c = '') {
        $this->view('header');
        $this->view('home');
        $this->view('footer');
    }
}

