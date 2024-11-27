<?php

class Hospitals extends Controller{
    public function index(){
        $this->view('header');
        $this->view('hospitals');
        $this->view('footer');
    }
}