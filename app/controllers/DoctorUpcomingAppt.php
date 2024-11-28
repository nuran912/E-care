<?php

class DoctorUpcomingAppt extends controller{
    public function index(){
        $this->view('header');
        $this->view('doctorUpcomingAppt');
        $this->view('footer');
    }
}