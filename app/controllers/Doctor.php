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

        $defaultdate = ((new DateTime(date('Y-m-d')))->modify('-1 day')->format('Y-m-d'));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if($b){
                //when user clicks prev or next button to navigate through dates for appointments
                $date = $b;
            }else{
                //when users uses filter by date to check appointments
                $date = $_POST["filteredDate"];
            }

            if(array_key_exists($date, $appointmentsData)){
                //appointments exist for this date
                $data = [$date, $appointmentsData[$date]];
            }else{
                //no appointments for this date
                $data = [$date, []];
            }

        }else{
            $data = [$defaultdate, $appointmentsData[$date]]; 
        }
        $this->view('Doctor/doctorPastAppt', $data);
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

        $date = date('Y-m-d');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if($b){
                //when user clicks prev or next button to navigate through dates for appointments
                $date = $b;
            }else{
                //when users uses filter by date to check appointments
                $date = $_POST["filteredDate"];
            }

            if(array_key_exists($date, $appointmentsData)){
                //appointments exist for this date
                $data = [$date, $appointmentsData[$date]];
            }else{
                //no appointments for this date
                $data = [$date, []];
            }

        }else{
            $data = [$date, $appointmentsData[$date]]; 
        }
        
        $this->view('Doctor/doctorPendingAppt', $data);
        $this->view('footer');
    }

    public function doctorCreateApptSlot($a = '', $b = '', $c = ''){

        $this->view('header');

        $hospital = new Hospital;
        $apptSlot = new Availabletime;
        $appt = new Appointments;
        $doctor = new DoctorModel;
        $doctorData = $doctor->getDoctorByUserId($_SESSION['USER']->user_id);
        $slotData = $apptSlot->getByDoctorId($doctorData->id);

        $alerts = [
            'cancelSuccess' => "",
            'cancelError' => "",
            'createSuccess' => "",
            'createError' => "",
        ];

        if( $a == 'create'){


            $date = new DateTime($_POST['date']);

            $date = new DateTime($_POST['date']);

            $data['date'] = $_POST['date'];
            $data['start_time'] = $_POST['time'];
            $data['duration'] = $_POST['duration'];
            $data['hospital_id'] = $_POST['hospital'];
            $data['total_slots'] = $_POST['count'];
            $data['repeat'] = $_POST['repeat'];

            // $doctor = $doctor->getDoctorByUserId($_SESSION['USER']->user_id);
            $data['doctor_id'] = $doctorData->id;

            $allFieldsEntered = true;
            if($data['date']=="" || $data['start_time']=="" || $data['duration']=="" || $data['total_slots']==""){
                $alerts['createError'] = "Please fill all fields to create a new slot";
                $allFieldsEntered = false;
            }
            if($data['start_time']){

            }

            if($allFieldsEntered){
                switch($data['repeat']){
                    case "0":
                        //No repeat
                        // show("no repeat");
                        $data['date'] = $date->format('Y-m-d');
                        $apptSlot->insert($data);
                        $alerts['createSuccess'] = "New appointment slot added successfully";
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
                        $alerts['createSuccess'] = "New appointment slots added successfully";
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
                        $alerts['createSuccess'] = "New appointment slots added successfully";
                        break;
                }
            }

            // delayedRedirect('Doctor/doctorManageSchedule');
        }
        

        $this->view('Doctor/doctorCreateApptSlot', $alerts);
        $this->view('footer');
    }

    public function doctorApptSlots($a = '', $b = '', $c = ''){
        $this->view('header');

        $hospital = new Hospital;
        $apptSlot = new Availabletime;
        $appt = new Appointments;
        $doctor = new DoctorModel;
        $doctorData = $doctor->getDoctorByUserId($_SESSION['USER']->user_id);
        $slotData = $apptSlot->getByDoctorId($doctorData->id);

        $alerts = [
            'cancelSuccess' => "",
            'cancelError' => "",
            'createSuccess' => "",
            'createError' => "",
        ];

        if( $a == 'cancelAppointment'){
            
            $apptSlotId = $b;

                $slot = $apptSlot->getByScheduleId($apptSlotId);

                $currentDate = new DateTime('now', new DateTimeZone('Asia/Colombo'));
                $currentDate = $currentDate->format('Y-m-d H:i:s');
                $slotTime = $slot->date . ' ' . $slot->start_time;
                $slotTime = new DateTime($slotTime);

                $timeToCancel = $slotTime->modify('-48 hours');
                $timeToCancel = $timeToCancel->format('Y-m-d H:i:s');

                $apptData = $appt->getAppointmentsByScheduleId($apptSlotId);
                // appointments can only be cancelled 48h before the start time
                if($currentDate < $timeToCancel){
                    $alerts['cancelSuccess'] = "Appointment slot has been cancelled successfully";
                    // update appointment status in the availabletimes table
                    $apptData = $appt->getAppointmentsByScheduleId($apptSlotId);
                    $apptSlot->update_status($apptSlotId, "cancelled");
                    // update corresponding appointment statuses in the appointments table for each relavant patient
                    // patients' appointments process will only happen if there are filled slots
                    if($slot->filled_slots != 0){
                        foreach($apptData as $patientAppt){
                            $appt->update_status($patientAppt->appointment_id, "cancelled");
                        }
                    }
                }else{
                    $alerts['cancelError'] = "You can only cancel an appointment before 48h";
                }
            // redirect('Doctor/doctorManageSchedule');
        }
        
        $filteredSlotData = [];
        $groupedFilteredSlotData = [];
        $slotFilter = 'Week';   //default filter
        
        if($a == 'filter'){
            //if somebody used the filter option, update filter type
            $slotFilter = $_POST['filter'];            
        }
        // $navdate initially has the current date. but when a navigation option is used it is updated accordingly
        $navDate = date('Y-m-d');   //used for prev/next navigation
        if($a == "navs"){
            $navDate = $b;
            //when navigation is used, current filter is also maintained. eg: click next while filter is month => go to next month(28 days)
            $slotFilter = $c;   
        }
        switch ($slotFilter){
            case 'Week':
                $sevenDaysLater = ((new DateTime($navDate))->modify('+7 days'))->format('Y-m-d');
                foreach($slotData as $slot){
                    $slotDate = (new DateTime($slot->date))->format('Y-m-d');
                    if($slotDate >= $navDate && $slotDate < $sevenDaysLater){
                        $filteredSlotData[] = $slot; 
                    }
                }
                break;
            case 'Date':
                foreach($slotData as $slot){
                    $slotDate = (new DateTime($slot->date))->format('Y-m-d');
                    if($slotDate == $navDate){
                        $filteredSlotData[] = $slot; 
                    }
                }
                break;
            case 'Month':
                $oneMonthLater = ((new DateTime($navDate))->modify('+28 days'))->format('Y-m-d');
                foreach($slotData as $slot){
                    $slotDate = (new DateTime($slot->date))->format('Y-m-d');
                    if($slotDate >= $navDate && $slotDate < $oneMonthLater){
                        $filteredSlotData[] = $slot; 
                    }
                }
                break;
        }
        foreach ($filteredSlotData as $entry) {
            $groupedFilteredSlotData[$entry->date][] = $entry;
        }
        // redirect('Doctor/doctorManageSchedule');
        
        $filterAndNavs = [$slotFilter, $navDate];
        
        $passedData = [[$filterAndNavs,$groupedFilteredSlotData], $alerts];

        $this->view('Doctor/doctorApptSlots', $passedData);
        $this->view('footer');
    }

    public function doctorViewAppt($a = '', $b = '', $c = ''){
        $this->view('header');

        $apptId = $a;
        $appt = new Appointments;
        $apptData = $appt->getAppointmentById($apptId);
        $patient = new User;
        $patientData = $patient->getById($apptData->user_id);

        $document = new Document;
        $docs = $apptData->shared_docs;
        $sharedDocs = [];
        if($docs != ""){
            $sharedDocIds = explode(',', $docs);
            foreach($sharedDocIds as $docId){
            $docData = $document->getDocumentById($docId);
            $sharedDocs[] = [$docData->document_id, $docData->document_name, $docData->document_type];
        }
        }

        $data = [$apptData, $patientData, $sharedDocs];


        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $doctorNotes = trim($_POST['noteBox']); //trim used to remove default leading whitespace
            $appt->updateDoctorNotes($apptId, $doctorNotes);

            $updatedStatus = $_POST['status'];
            $appt->update_status($apptId, $updatedStatus);

            redirect('/Doctor/doctorPendingAppt');

        }

        $this->view('Doctor/doctorViewAppt', $data);
        $this->view('footer');
    }
}