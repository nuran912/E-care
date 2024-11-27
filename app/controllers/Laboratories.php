<?php

class Laboratories extends Controller{
    public function index(){
        $this->view('header');
        $this->view('laboratories');
        $this->view('footer');
    }
}