<?php

class Patient extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $this->view('header');
        $this->view('footer');
    }

    public function profile()
    {
        $this->view('header');

        $Retriveappointments = new Appointments();






        $this->view('patient/profile');


        $this->view('footer');
    }

    public function appointments()
    {
        $this->view('header');

        $Pastappointments = new Appointments;
        // $data['patient_id'] = $_SESSION['USER'];
        // $data['status'] = 'completed';
        // $Pastappointments = $Pastappointments->where($data);


        $this->view('patient/appointments');
        $this->view('footer');
    }
}
