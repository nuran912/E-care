<?php
class Appointment_successful_page extends Controller
{
    public function index()
    {
        $this->view('header');



        




        
        $this->view('Clerk/appointment_successful_page', []);



        $this->view('footer');
    }
}