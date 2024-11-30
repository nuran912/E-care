<?php

class DoctorPendingAppt extends Controller{
    public function index(){
        $this->view('header');
        $this->view('Doctor/doctorPendingAppt');
        $this->view('footer');
    }
}