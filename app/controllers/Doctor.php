<?php

if ($_SESSION['USER']->role != 'doctor') {
    redirect('Home');
}

class Doctor extends Controller{

    public function index($a = '', $b = '', $c = ''){
        $this->profile();
    }

    public function profile($a = '', $b = '', $c = ''){
    
      $doctor = new DoctorModel;
      $user = new User;
      // show($_SESSION['USER']);
      $data1 = array($doctor->getDoctorByUserId($_SESSION['USER']->user_id));
      $data2 = array($user->getById($_SESSION['USER']->user_id));
      $data = array_merge($data1, $data2);
      // show($data1);
      // show($data2);
      // show($data);

      $this->view('header');
      $this->view('Doctor/doctorProfile', $data);
      $this->view('footer');

      if( $a == 'update'){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $doctor = new DoctorModel;
            $user = new User;
            $doctorData = $doctor->getDoctorByUserId($_SESSION['USER']->user_id);
            $userData = $user->getById($_SESSION['USER']->user_id);
            // show($doctorData->id);
            // show($userData->user_id);
            // show($_POST);
            
            $doctor->update($doctorData->id, $_POST, 'id');
            $user->updateDoctorDetails($userData->user_id, $_POST, 'user_id');
            redirect('Doctor/profile');
            }
      }
   }

}