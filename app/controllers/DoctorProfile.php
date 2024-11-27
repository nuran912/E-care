
<?php

class DoctorProfile extends Controller {
    public function index($a = '', $b = '', $c = '') {
        $this->view('header');
        $this->view('doctorProfile');
        $this->view('footer');
    }
}
