<?php

class Hospitals extends Controller{
    public function index(){
        $this->view('header');
        
        $hospital = new Hospital;
        $data = $hospital->findAll();
        // show($data);

        $this->view('hospitals', $data);
        $this->view('footer');
    }
}