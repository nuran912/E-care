<?php

class DoctorUpcomingAppt extends controller{
    public function index(){
        $this->view('header');
        $this->view('Doctor/doctorUpcomingAppt');
        $this->view('footer');
    }
}