<?php

class Laboratories extends Controller{
    public function index(){
        $this->view('header');
        
        $laboratory = new Laboratory;
        $data = $laboratory->findAll();
        // show($data);

        $this->view('laboratories', $data);
        $this->view('footer');
    }
}