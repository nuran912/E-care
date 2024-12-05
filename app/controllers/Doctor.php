<?php

if ($_SESSION['USER']->role != 'doctor') {
    redirect('Home');
}

class Doctor extends Controller{

    public function index($a = '', $b = '', $c = ''){
        $this->profile();
    }

    public function profile($a = '', $b = '', $c = ''){
    //   show($_SESSION['USER']);
      $doctor = new DoctorModel;
      $user = new User;
      $data1 = array($doctor->getDoctorByUserId($_SESSION['USER']->user_id));
      $data2 = array($user->getById($_SESSION['USER']->user_id));
      $data = array_merge($data1, $data2);
      $data['error'] = "";
      $data['success'] = "";

      $this->view('header');
      
      if( $a == 'update'){
          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $doctor = new DoctorModel;
            $user = new User;
            $doctorData = $doctor->getDoctorByUserId($_SESSION['USER']->user_id);
            $userData = $user->getById($_SESSION['USER']->user_id);

            $dataToUpdate = $_POST;
            if(empty($dataToUpdate['password']) || empty($dataToUpdate['newpassword'])){
                unset($dataToUpdate['password']);
                unset($dataToUpdate['newpassword']);
                $doctor->update($doctorData->id, $dataToUpdate, 'id');
                $user->updateDoctorDetails($userData->user_id, $dataToUpdate, 'user_id');
                $_SESSION['success'] = "Profile updated successfully";
              }else if(!empty($dataToUpdate['password']) && !empty($dataToUpdate['newpassword'])){
                if($dataToUpdate['password'] == $_SESSION['USER']->password){
                    $dataToUpdate['password'] = $dataToUpdate['newpassword'];
                    unset($dataToUpdate['newpassword']);
                    $doctor->update($doctorData->id, $dataToUpdate, 'id');
                    $user->updateDoctorDetails($userData->user_id, $dataToUpdate, 'user_id');
                    $_SESSION['success'] = "Profile updated successfully";
                }
              }
            //   else if(!empty($dataToUpdate['password']) || !empty($dataToUpdate['newpassword'])){
            //     $_SESSION['error'] = "Enter current and new passwords to update your password";
            //   } else{
            //     $_SESSION['error'] == "update failed";
            //   }
              redirect('Doctor/profile');
            }
        }
        // $data['success'] = $_SESSION['success'];
        // $data['error'] = $_SESSION['error'];
    $this->view('Doctor/doctorProfile', $data);
    $this->view('footer');
    }

    public function doctorPastAppt($a = '', $b = '', $c = ''){
        $this->view('header');

        $appointments = new Appointments;
        $doctor = new DoctorModel;
        $doctorData = $doctor->getDoctorByUserId($_SESSION['USER']->user_id);
        $appointmentsData = $appointments->getAppointmentsByDoctorId($doctorData->id);

        $this->view('Doctor/doctorPastAppt', $appointmentsData);
        $this->view('footer');
    }

    public function doctorPendingAppt($a = '', $b = '', $c = ''){
        $this->view('header');

        $appointments = new Appointments;
        $doctor = new DoctorModel;
        $doctorData = $doctor->getDoctorByUserId($_SESSION['USER']->user_id);
        // show($_SESSION['USER']);
        // show($doctorData);
        $appointmentsData = $appointments->getAppointmentsByDoctorId($doctorData->id);
        // show($appointmentsData);

        $this->view('Doctor/doctorPendingAppt', $appointmentsData);
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