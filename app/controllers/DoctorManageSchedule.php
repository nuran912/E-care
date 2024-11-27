<?php

class DoctorManageSchedule extends Controller{

    public function index(){

        $this->view('header');

        // $apptSlot = new ApptSlot;
        // $apptSlot->insert($_POST);
        show($_POST['date']);

        $this->view('doctorManageSchedule');
        $this->view('footer');

    }
}