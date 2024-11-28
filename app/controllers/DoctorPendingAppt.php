<?php

class DoctorPendingAppt extends Controller{
    public function index(){
        $this->view('header');
        $this->view('doctorPendingAppt');
        $this->view('footer');
    }
}