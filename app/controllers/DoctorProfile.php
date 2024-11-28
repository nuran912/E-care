
<?php

class DoctorProfile extends Controller {
    public function index($a = '', $b = '', $c = '') {

        $doctor = new Doctor;
        $user = new User;
        // show($_SESSION['USER']);
        $data1 = array($doctor->getDoctorByUserId($_SESSION['USER']->user_id));
        $data2 = array($user->getById($_SESSION['USER']->user_id));
        $data = array_merge($data1, $data2);
        // show($data1);
        // show($data2);
        // show($data);

        $this->view('header');
        $this->view('doctorProfile', $data);
        $this->view('footer');
    }

    public function update(){
        $doctor = new Doctor;
        $user = new User;
        $doctorData = $doctor->getDoctorByUserId($_SESSION['USER']->user_id);
        $userData = $user->getById($_SESSION['USER']->user_id);
        // show($doctorData->id);
        // show($userData->user_id);
        // show($_POST);
        
        $doctor->update($doctorData->id, $_POST, 'user_id');
        $user->updateDoctorDetails($userData->user_id, $_POST, 'user_id');
        redirect('/doctorprofile');
    }
}
