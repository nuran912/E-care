<?php

class DoctorViewAppt extends Controller{
    public function index(){
        $this->view('header');
        $this->view('Doctor/doctorViewAppt');
        $this->view('footer');
    }
}