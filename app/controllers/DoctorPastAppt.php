<?php

class DoctorPastAppt extends Controller{
    public function index(){
        $this->view('header');
        $this->view('doctorPastAppt');
        $this->view('footer');
    }
}