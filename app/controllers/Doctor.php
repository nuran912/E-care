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
      $data['error'] = [];
      $data['success'] = "";
      $data['status'] = [];
      $data['passUpdateSuccess'] = "";
      $data['passUpdateError'] = "";
      $_SESSION['updateData'] = [];
      

      $this->view('header');
      
      if( $a == 'update'){
          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $doctor = new DoctorModel;
            // $user = new User;
            $doctorData = $doctor->getDoctorByUserId($_SESSION['USER']->user_id);
            $userData = $user->getById($_SESSION['USER']->user_id);

            $originalProfileInfo = [
                'name' => $userData->name,
                'registration_number' => $doctorData->registration_number,
                'specialization' => $doctorData->specialization,
                'other_qualifications' => $doctorData->other_qualifications,
                'NIC' => $userData->NIC,
                'phone_number' => $userData->phone_number,
                'email' => $userData->email,
            ];

            $dataToUpdate = $_POST;
            $passswordToUpdate = array("password"=>$dataToUpdate['password'] , "newpassword"=>$dataToUpdate['newpassword']);
            
            $data['status'] = $doctor->profileValidation($dataToUpdate, $originalProfileInfo);
            
            if(empty($dataToUpdate['password']) && empty($dataToUpdate['newpassword'])){
                if($data['status'] === true){
                    $doctor->update($doctorData->id, $dataToUpdate, 'id');
                    $user->updateDoctorDetails($userData->user_id, $dataToUpdate, 'user_id');
                    $data['success'] = "Profile information updated successfully";
                }else{
                    $data['error'] = $data['status'];
                }
            }else{
                $passswordToUpdate = $doctor->passwordValidation($passswordToUpdate, $userData->password);
                unset($dataToUpdate['password']);
                unset($dataToUpdate['newpassword']);
                if($data['status'] === true){
                    $doctor->update($doctorData->id, $dataToUpdate, 'id');
                    $user->updateDoctorDetails($userData->user_id, $dataToUpdate, 'user_id');
                    $data['success'] = "Profile information updated successfully";
                }else{
                    $data['error'] = $data['status'];
                }
                if($passswordToUpdate['passUpdateStatus'] === true){
                    $user->updateDoctorDetails($userData->user_id, $passswordToUpdate, 'user_id');
                    $_SESSION['USER']->password = $passswordToUpdate['password'];
                    $data['passUpdateSuccess'] = "Password updated successfully";
                }else{
                    $data['passUpdateError'] = $passswordToUpdate['passUpdateStatus'];
                }
            }
            // redirect('Doctor/profile');
            
            }
        }
    $this->view('Doctor/doctorProfile', $data);
    $this->view('footer');
    }

    public function doctorPastAppt($a = '', $b = '', $c = ''){
        $slot = new AvailableTime;

        $this->view('header');

        $appointments = new Appointments;
        $doctor = new DoctorModel;
        $doctorData = $doctor->getDoctorByUserId($_SESSION['USER']->user_id);
        $appointmentsData = $appointments->getAppointmentsByDoctorIdGroupedByDate($doctorData->id);
        foreach( array_keys($appointmentsData) as $date){
            $appointmentsData[$date] = $appointments->groupByScheduleId($slot, $appointmentsData, $date);
        }

        $this->view('Doctor/doctorPastAppt', $appointmentsData);
        $this->view('footer');
    }

    public function doctorPendingAppt($a = '', $b = '', $c = ''){
        $slot = new AvailableTime;

        $this->view('header');

        $appointments = new Appointments;
        $doctor = new DoctorModel;
        $doctorData = $doctor->getDoctorByUserId($_SESSION['USER']->user_id);
        $appointmentsData = $appointments->getAppointmentsByDoctorIdGroupedByDate($doctorData->id);
        foreach( array_keys($appointmentsData) as $date){
            $appointmentsData[$date] = $appointments->groupByScheduleId($slot, $appointmentsData, $date);
        }
        
        $this->view('Doctor/doctorPendingAppt', $appointmentsData);
        $this->view('footer');
    }

    public function doctorManageSchedule($a = '', $b = '', $c = ''){

        $this->view('header');

        $hospital = new Hospital;

        if( $a == 'create'){
            $data['name'] = $_POST['hospital'];
            // $hospital = $hospital->first($data);


            $date = new DateTime($_POST['date']);
            // show($date);
            // // $date->format('Y-m-d');
            // $date->modify('+0 days');
            // show($date->format('Y-m-d'));
            // $date->modify('+7 days');
            // show($date->format('Y-m-d'));
            // $date->modify('+28 days');
            // show($date->format('Y-m-d'));


            $data['start_time'] = $_POST['time'];
            $data['duration'] = $_POST['duration'];
            // $data['hospital_id'] = $hospital->id;
            $data['hospital_id'] = $_POST['hospital'];
            $data['total_slots'] = $_POST['count'];
            $repeat = $_POST['repeat'];
            // show($repeat);

            $doctor = new DoctorModel;
            $doctor = $doctor->getDoctorByUserId($_SESSION['USER']->user_id);
            $data['doctor_id'] = $doctor->id;

            $apptSlot = new Availabletime;
            // $apptSlot->insert($data);
            switch($repeat){
                case "0":
                    //No repeat
                    // show("no repeat");
                    $data['date'] = $date->format('Y-m-d');
                    $apptSlot->insert($data);
                    $data['slotSuccess'] = "New appointment slot added successfully";
                    break;
                case "1":
                    //Repeat for 4 weeks
                    // show("weekly repeat");
                    $data['date'] = $date->format('Y-m-d');
                    $apptSlot->insert($data);
                    for($i=0;$i<3;$i++){
                        // $r = 7 * $i;
                        $date->modify("+7 days");
                        $data['date'] = $date->format('Y-m-d');
                        $apptSlot->insert($data);
                    }
                    $data['slotSuccess'] = "New appointment slots added successfully";
                    break;
                case "2":
                    //Repeat for 4 months
                    // show("monthly repeat");
                    $data['date'] = $date->format('Y-m-d');
                    $apptSlot->insert($data);
                    for($i=0;$i<3;$i++){
                        // $r = 28 * $i;
                        $date->modify("+28 days");
                        $data['date'] = $date->format('Y-m-d');
                        $apptSlot->insert($data);
                    }
                    $data['slotSuccess'] = "New appointment slots added successfully";
                    break;
            }

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