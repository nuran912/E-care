<?php

class ReceptionClerkPendingAppointments extends Controller {
    
    public function index() {
        $this->view('header');
        $this->view('receptionClerkPendingAppointments');
        $this->view('footer');
    }

}

?>