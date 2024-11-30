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
    $this->view('Doctor/doctorProfile', $data);
    $this->view('footer');
    }

    public function doctorPastAppt($a = '', $b = '', $c = ''){
        $this->view('header');
        $this->view('Doctor/doctorPastAppt');
        $this->view('footer');
    }

    public function doctorPendingAppt($a = '', $b = '', $c = ''){
        $this->view('header');
        $this->view('Doctor/doctorPendingAppt');
        $this->view('footer');
    }

    public function doctorManageSchedule($a = '', $b = '', $c = ''){

        $this->view('header');

        $hospital = new Hospital;

        if( $a == 'create'){
            $data['name'] = $_POST['hospital'];
            $hospital = $hospital->first($data);
            $data['date'] = $_POST['date'];
            $data['start_time'] = $_POST['time'];
            $data['duration'] = $_POST['duration'];
            $data['hospital_id'] = $hospital->id;
            $data['total_slots'] = $_POST['count'];

            $doctor = new DoctorModel;
            $doctor = $doctor->getDoctorByUserId($_SESSION['USER']->user_id);
            $data['doctor_id'] = $doctor->id;

            $apptSlot = new Availabletime;
            $apptSlot->insert($data);

            redirect('Doctor/doctorManageSchedule');
        }

        if( $a == 'cancelAppointment'){
            $apptId = $b;
            $apptSlot = new Availabletime;
            if(!empty($apptId)){
                $apptSlot->delete($apptId);
            }
            redirect('Doctor/doctorManageSchedule');
        }

        $apptSlot = new Availabletime;
        $doctor = new DoctorModel;
        $doctor = $doctor->getDoctorByUserId($_SESSION['USER']->user_id);
        $data = $apptSlot->getByDoctorId($doctor->id);

        $this->view('Doctor/doctorManageSchedule', $data);
        $this->view('footer');
    }
}