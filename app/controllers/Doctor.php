<?php

if ($_SESSION['USER']->role != 'doctor') {
    redirect('Home');
}
require_once dirname(__DIR__) . '/core/EmailHelper.php';

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
        // $data['error'] = [];
        // $data['success'] = "";
        // $data['status'] = [];
        // $data['passUpdateSuccess'] = "";
        // $data['passUpdateError'] = "";
        $_SESSION['updateData'] = [];

        $profilePic = $user->getProfilePic($_SESSION['USER']->user_id);

        if(!empty($profilePic) && !empty($profilePic[0]['profile_pic'])) {
            $data['profilePic'] = ROOT . "/assets/profile_pictures/" . htmlspecialchars($_SESSION['USER']->user_id) . "/" . $profilePic[0]['profile_pic'];
        }
        else {
            $data['profilePic'] = ROOT . "/assets/img/user.svg";
        }
      
        $this->view('header');
      
        $doctorData = $doctor->getDoctorByUserId($_SESSION['USER']->user_id);
        $userData = $user->getById($_SESSION['USER']->user_id);
        if( $a == 'update'){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // $doctor = new DoctorModel;
                // $user = new User;
                // $doctorData = $doctor->getDoctorByUserId($_SESSION['USER']->user_id);
                // $userData = $user->getById($_SESSION['USER']->user_id);

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
                    unset($dataToUpdate['password']);
                    unset($dataToUpdate['newpassword']);
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
            }
            if(isset($data['error']) || isset($data['passUpdateError'])){
                unset($data['success']);
            }
            if(isset($data['error'])){
                $_SESSION['error'] = $data['error'];
            }
            if(isset($data['passUpdateSuccess'])){
                $_SESSION['passUpdateSuccess'] = $data['passUpdateSuccess'];
            }
            if(isset($data['passUpdateError'])){
                $_SESSION['passUpdateError'] = $data['passUpdateError'];
            }
            if(isset($data['success'])){
                $_SESSION['success'] = $data['success'];
                unset($_SESSION['USER']);
                $_SESSION['USER'] = $user->getById($userData->user_id);
                redirect('Doctor/profile');
            }
        }

        //upload a profile picture
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile-pic'])) {

            $user_id = $_POST['user_id'];

            //target directory
            $targetDir = "assets/profile_pictures/$user_id/";

            //check if the file(profile picture) was uploaded
            if (isset($_FILES['profile-pic']) && $_FILES['profile-pic']['error'] == 0) {
                $filename = basename($_FILES['profile-pic']['name']);
                $targetPath = $targetDir . $filename;

                //check if the target directory exists, if not, create a one
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                //before uploading, delete the old profile picture
                //fetch the current profile picture from the database
                $currentProfilePic = $user->getProfilePic($user_id);
                if(!empty($currentProfilePic) && !empty($currentProfilePic[0]['profile_pic'])) {
                    $oldPicPath = $targetDir . $currentProfilePic[0]['profile_pic'];

                    //check if the old pic exists and deletes it
                    if(file_exists($oldPicPath)) {
                        unlink($oldPicPath);
                    }
                }

                //moving the file to the target path
                if (move_uploaded_file($_FILES['profile-pic']['tmp_name'], $targetPath)) {

                    //moved successfully
                    $user->update($user_id,['profile_pic' => $filename],'user_id');

                    //unset the session variable to remove the old profile picture
                    unset($_SESSION['USER']->profile_pic);
                    //adding the new profile picture to the session variable
                    $_SESSION['USER']->profile_pic = $filename;

                    redirect('Doctor/doctorProfile');
                }
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

        $date = $_SESSION['filteredPastDate'] ?? ((new DateTime(date('Y-m-d')))->modify('-1 day')->format('Y-m-d'));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if($b){
                //when user clicks prev or next button to navigate through dates for appointments
                $date = $b;
            }else{
                //when users uses filter by date to check appointments
                $date = $_POST["filteredPastDate"];
            }

            $_SESSION['filteredPastDate'] = $date;

            if(array_key_exists($date, $appointmentsData)){
                //appointments exist for this date
                $data = [$date, $appointmentsData[$date]];
            }else{
                //no appointments for this date
                $data = [$date, []];
            }

        }else{
            // $data = [$date, $appointmentsData[$date]]; 
            $data = [$date, isset($appointmentsData[$date]) ? $appointmentsData[$date] : []]; 
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

        $date = $_SESSION['filteredDate'] ?? date('Y-m-d');
        // $date = date('Y-m-d');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if($b){
                //when user clicks prev or next button to navigate through dates for appointments
                $date = $b;
                $_SESSION['filteredDate'] = $date;
            }else{
                //when users uses filter by date to check appointments
                $date = $_POST["filteredDate"];
                $_SESSION['filteredDate'] = $date;
            }
            
            if(array_key_exists($date, $appointmentsData)){
                //appointments exist for this date
                $data = [$date, $appointmentsData[$date]];
            }else{
                //no appointments for this date
                $data = [$date, []];
            }

        }else{
            $data = [$date, isset($appointmentsData[$date]) ? $appointmentsData[$date] : [] ];
        }
        // show($data);
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
            // 'cancelSuccess' => "",
            // 'cancelError' => "",
            // 'createSuccess' => "",
            // 'createError' => "",
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
            // if($data['start_time']){
            // }

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
        if(isset($alerts['createError'])){
            unset($alerts['createSuccess']);
        }
        if(isset($alerts['createError'])){
            $_SESSION['createError'] = $alerts['createError'];
        }
        if(isset($alerts['createSuccess'])){
            $_SESSION['createSuccess'] = $alerts['createSuccess'];
            redirect('Doctor/doctorCreateApptSlot');
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
            // 'cancelSuccess' => "",
            // 'cancelError' => "",
            // 'createSuccess' => "",
            // 'createError' => "",
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

                //Email info
                $subject = "Appointment Cancellation";   
                $doctorInfo = $doctor->getDoctorById($slot->doctor_id); 
                $hospitalInfo = $hospital->getHospitalById($slot->hospital_id);   
                $slotDate = (new DateTime($slot->date))->format('F d, Y');
                $slotSessionTime = (new DateTime($slot->start_time))->format("g:i A");

                $apptData = $appt->getAppointmentsByScheduleId($apptSlotId);
                // appointments can only be cancelled 48h before the start time
                if($currentDate < $timeToCancel){
                    $alerts['cancelSuccess'] = "Appointment slot has been cancelled successfully";
                    // update appointment status in the availabletimes table
                    $apptData = $appt->getAppointmentsByScheduleId($apptSlotId);
                    // show($apptData);
                    $apptSlot->update_status($apptSlotId, "cancelled");
                    // update corresponding appointment statuses in the appointments table for each relavant patient
                    // patients' appointments process will only happen if there are filled slots
                    if($slot->filled_slots != 0){
                        foreach($apptData as $patientAppt){
                            $appt->update_status($patientAppt->appointment_id, "cancelled");
                            
                            EmailHelper::sendEmail($patientAppt->patient_Email, $patientAppt->patient_name, $subject,
                            "<p>Dear {$patientAppt->patient_name},</p>
                
                            <p>We are writing to inform you that your appointment has been canceled. Below are the details of the canceled appointment:</p>
                        
                            <ul>
                                <li><strong>Date:</strong> {$slotDate}</li>
                                <li><strong>Time:</strong> {$slotSessionTime}</li>
                                <li><strong>Doctor:</strong> Dr. {$doctorInfo->name}</li>
                                <li><strong>Hospital:</strong> {$hospitalInfo->name}</li>
                            </ul>
                        
                            <p>Your payment has been refunded to your original method of payment. Refunds are typically processed within 3–5 business days depending on your bank or card issuer.</p>
                        
                            <p>If you have any questions or need further assistance, please don’t hesitate to contact our support team at 011 245 9989.</p>
                        
                            <p>We’re here to support your healthcare needs whenever you need us.</p>
                        
                            <br>
                            <p>Best regards,<br>
                            The Ecare Team<br></p>"
            
                        );
                        }
                    }
                }else{
                    $alerts['cancelError'] = "You can only cancel an appointment before 48h";
                }
            if(isset($alerts['cancelError'])){
                unset($alerts['cancelSuccess']);
            }
            if(isset($alerts['cancelError'])){
                $_SESSION['cancelError'] = $alerts['cancelError'];
            }
            if(isset($alerts['cancelSuccess'])){
                $_SESSION['cancelSuccess'] = $alerts['cancelSuccess'];
                redirect('Doctor/doctorApptSlots');
            }
        }
        
        $filteredSlotData = [];
        $groupedFilteredSlotData = [];

        // $slotFilter = 'Week';   //default filter
        // $_SESSION['filter'] = $_POST['filter'];
        $slotFilter = $_SESSION['filter'] ?? 'Week';    //filter should be by deafult week unless a filter is already saved in the session
        
        
        if($a == 'filter'){
            //if somebody used the filter option, update filter type with the type sent in the form. else use filter value saved in the session
            $_SESSION['filter'] =  $_POST['filter'] ?? $_SESSION['filter'];
            $slotFilter = $_SESSION['filter'];            
        }

        // $navDate initially has the current date. but when a navigation option is used it is updated accordingly
        // $_POST['selectedDate'] is set when the filter is date and then the date input is used.       
        //navDate is used for prev/next navigation 
        (isset($_POST['selectedDate'])) ? $navDate = $_POST['selectedDate'] : $navDate = date('Y-m-d');  
        // $navDate = date('Y-m-d');   
        if($a == "navs"){
            $navDate = $b;  //navigation start date
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
        ksort($groupedFilteredSlotData);    // Sort by keys (dates) in ascending order
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
        $docs = $apptData->selected_files;
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