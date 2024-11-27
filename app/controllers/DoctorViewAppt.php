<?php

class DoctorViewAppt extends Controller{
    public function index(){
        $this->view('header');
        $this->view('doctorViewAppt');
        $this->view('footer');
    }
}