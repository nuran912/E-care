<?php

class DoctorPastAppt extends Controller{
    public function index(){
        $this->view('header');
        $this->view('Doctor/doctorPastAppt');
        $this->view('footer');
    }
}