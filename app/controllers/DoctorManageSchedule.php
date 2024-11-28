<?php

class DoctorManageSchedule extends Controller{
    public function index(){
        $this->view('header');
        $this->view('doctorManageSchedule');
        $this->view('footer');
    }
}