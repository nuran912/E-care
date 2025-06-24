<?php
if ($_SESSION['USER']->role != 'patient') {
    header('location: ' . ROOT . '/Home');
}
class Patient extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $this->view('header');
        $this->view('footer');
    }

    public function profile($a = '', $b = '', $c = '')
    {
        $this->view('header');

        $user = new User;
        $data = array($user->getById($_SESSION['USER']->user_id));
        // $data['error'] = [];
        // $data['success'] = "";
        // $data['status'] = [];
        // $data['passUpdateSuccess'] = "";
        // $data['passUpdateError'] = "";

        $profilePic = $user->getProfilePic($_SESSION['USER']->user_id);

        if(!empty($profilePic) && !empty($profilePic[0]['profile_pic'])) {
            $data['profilePic'] = ROOT . "/assets/profile_pictures/" . htmlspecialchars($_SESSION['USER']->user_id) . "/" . $profilePic[0]['profile_pic'];
        }
        else {
            $data['profilePic'] = ROOT . "/assets/img/user.svg";
        }
        
        $userData = $user->getById($_SESSION['USER']->user_id);
        if ($a == 'update') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                // $userData = $user->getById($_SESSION['USER']->user_id);

                $originalProfileInfo = [
                    'name' => $userData->name,
                    'NIC' => $userData->NIC,
                    'phone_number' => $userData->phone_number,
                    'email' => $userData->email,
                ];

                $dataToUpdate = $_POST;
                // show($dataToUpdate);
                // show(gettype($dataToUpdate['password']));

                $passswordToUpdate = array("password" => $dataToUpdate['password'], "newpassword" => $dataToUpdate['newpassword']);

                $data['status'] = $user->profileValidation($dataToUpdate, $originalProfileInfo);

                if (empty($dataToUpdate['password']) && empty($dataToUpdate['newpassword'])) {
                    unset($dataToUpdate['password']);
                    unset($dataToUpdate['newpassword']);
                    if ($data['status'] === true) {
                        $user->update($userData->user_id, $dataToUpdate, 'user_id');
                        $data['success'] = "Profile information updated successfully";
                        
                    } else {
                        $data['error'] = $data['status'];
                    }
                } else {
                    $passswordToUpdate = $user->passwordValidation($passswordToUpdate, $userData->password);
                    unset($dataToUpdate['password']);
                    unset($dataToUpdate['newpassword']);
                    if ($data['status'] === true) {
                        $user->update($userData->user_id, $dataToUpdate, 'user_id');
                        $data['success'] = "Profile information updated successfully";
                    } else {
                        $data['error'] = $data['status'];
                    }
                    if ($passswordToUpdate['passUpdateStatus'] === true) {
                        $user->update($userData->user_id, $passswordToUpdate, 'user_id');
                        $_SESSION['USER']->password = $passswordToUpdate['password'];
                        $data['passUpdateSuccess'] = "Password updated successfully";
                    } else {
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
                redirect('Patient/profile');
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
                    
                    redirect('Patient/profile');
                }
            }
        }

        $this->view('Patient/profile', $data);
        $this->view('footer');
    }

    public function appointments()
    {
        require_once dirname(__DIR__) . '/core/EmailHelper.php';
    
        $appointmentsModel = new Appointments;
        $availableslotts = new Availabletime;
        $doctorModel = new DoctorModel;
    
        // Ensure user role validation happens first
        if ($_SESSION['USER']->role !== 'patient') {
            header('location: ' . ROOT . '/Home');
            exit;
        }
        if (!isset($_GET['section'])) {
            header('location: ' . ROOT . '/Patient/appointments?section=pending&page_pending=1');}
            
    
        // Fetch all appointments for the logged-in patient
        $data = $doctorModel->getUserDoctorAppointments($_SESSION['USER']->user_id);
    
        // Attach document names to each appointment
        if (is_array($data)) {
            $Document = new Document;
    
            foreach ($data as $appointment) {
                $documentNames = [];
    
                if (!empty($appointment->selected_files)) {
                    $documentIds = explode(',', $appointment->selected_files);
    
                    foreach ($documentIds as $document_id) {
                        $document_id = trim($document_id);
                        $name = $Document->getDocumentNamebyId($document_id);
                        if (!empty($name)) {
                            $documentNames[] = isset($name->document_name) ? $name->document_name : 'Unknown Document';
                        }
                    }
                }
    
                
                $appointment->documentNames = implode(', ', $documentNames);
            }
        } else {
            $data = [];
        }
    
        // Cancel Appointment Logic
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appointment_id'])) {
            $appointment_id = $_POST['appointment_id'];
            $appoitmentDetails = $appointmentsModel->getByAppointmentId($appointment_id);
    
            foreach ($appoitmentDetails as $appoitment) {
                $schedule_id = $appoitment->schedule_id;
                
                $session_time = $appoitment->session_time;
                $session_date = $appoitment->session_date;
                $document_ids_csv = $appoitment->selected_files;
            }
             
            $currentPagePending = isset($_GET['page_pending']) ? (int)$_GET['page_pending'] : 1;

            date_default_timezone_set('Asia/Colombo');
            $current_date = date("Y-m-d");

            

    
            if ($current_date < $session_date && (strtotime($session_date) - strtotime($current_date)) > 2 * 24 * 60 * 60) {
                $appointmentsModel->update_is_deleted($appointment_id);
                $appointmentsModel->updateStatus($appointment_id, 'cancelled');
                
                
    
                foreach ($appoitmentDetails as $appoitment) {
                    $patientname = $appoitment->patient_name;
                    $doctor_id = $appoitment->doctor_id;
                    $appointmentnumber = $appoitment->appointment_number;
                    $appointmentdate = $appoitment->session_date;
                    $appointmenttime = $appoitment->session_time;
                    $hospitalname = $appoitment->hospital_name;
                    $patientemail = $appoitment->patient_Email;
                }
    
                $doctorDetails = $doctorModel->getDoctorDetails($doctor_id);
                $doctorname = $doctorDetails[0]->name;

                $subject = "Appointment Cancellation Confirmation $hospitalname";
                $body = "
                    <div style='font-family: Arial, sans-serif; color: #333; line-height: 1.6;'>
                        <p>Dear <b>$patientname</b>,</p>
                        <p>Your appointment at <b>$hospitalname</b> has been successfully cancelled as per your request.</p>
                        <p><b>Appointment Details:</b></p>
                        <ul>
                            <li><b>Patient Name:</b> $patientname</li>
                            <li><b>Doctor:</b> $doctorname</li>
                            <li><b>Appointment Number:</b> $appointmentnumber</li>
                            <li><b>Scheduled Date:</b> " . date('Y F d l', strtotime($appointmentdate)) . "</li>
                            <li><b>Scheduled Time:</b> " . date('h:i A', strtotime($appointmenttime)) . "</li>
                            <li><b>Hospital:</b> $hospitalname</li>
                        </ul>
                        <p>If you require a new appointment, please visit our website or contact us.</p>
                        <p>Best regards,</p>
                        <p><b>$hospitalname</b><br>Your trusted healthcare provider</p>
                        <div style='margin-top: 20px; font-size: 12px; color: #777;'>
                            <p>&copy; " . date('Y') . " $hospitalname. All rights reserved.</p>
                        </div>
                    </div>
                ";
    
                EmailHelper::sendEmail($patientemail, $patientname, $subject, $body);
                $_SESSION['success'] = 'Appointment cancelled successfully.';
                header('location: ' . ROOT . '/Patient/appointments?section=pending&page_pending=' . $currentPagePending);  
                exit;


            } else {
                $_SESSION['error'] = "You can't cancel the appointment because there are less than 48 hours remaining until your appointment.";
            }
    
            header('location: ' . ROOT . '/Patient/appointments?section=pending&page_pending=' . $currentPagePending);
            exit;
        }
        $pendingAppointments =[];
        $pastAppointments =[];
        $currentDate = date("Y-m-d");
        

        date_default_timezone_set('Asia/Colombo');
        $currentTime = date("g:i A");
        foreach ($data as $appointment) {
            $schedule_id=$appointment->schedule_id;
            // show($schedule_id);
            $availabletimedata=$availableslotts->getByScheduleId($schedule_id);
            $durations=$availabletimedata->duration;
            $start_time=$availabletimedata->start_time;
            $end_time = date('g:i A', strtotime($start_time) + $durations * 60 * 60);
            

           
        
          

            

            $appointmentDate = $appointment->session_date;
            $appointmentTime = date("g:i A", strtotime($appointment->session_time));
            // show('appointment start time: '.$appointmentTime);
           
            // show('current date: '.$currentDate . ', current time: '.$currentTime);
            // show('appointment date: '.$appointmentDate . ', appointment time: '.$end_time);
        
            if ($appointment->is_deleted == 0) {
                if (
                    ($appointmentDate > $currentDate) ||
                    ($appointmentDate == $currentDate && strtotime($end_time) > strtotime($currentTime))
                ) {
                    $pendingAppointments[] = $appointment;
                } else {
                    $pastAppointments[] = $appointment;
                }
            }
        }
        usort($pendingAppointments, function ($a, $b) {
            return strtotime($a->session_date) - strtotime($b->session_date);
        });
        usort($pastAppointments, function ($a, $b) {
            return strtotime($b->session_date) - strtotime($a->session_date);
        });

         // Handle search by date
    if (isset($_GET['search_date'])) {
        $searchDate = $_GET['search_date'];
        $pendingAppointments = array_filter($pendingAppointments, function ($appointment) use ($searchDate) {
            return $appointment->session_date === $searchDate;
        });
        $pastAppointments = array_filter($pastAppointments, function ($appointment) use ($searchDate) {
            return $appointment->session_date === $searchDate;
        });
    }
    // show($pendingAppointments);
         // Pagination Logic for Pending Appointments
    $limit = 4;
    $currentPagePending = isset($_GET['page_pending']) ? (int)$_GET['page_pending'] : 1;
    $offsetPending = ($currentPagePending - 1) * $limit;
    $pendingAppointmentsPaginated = array_slice($pendingAppointments, $offsetPending, $limit);
    $totalPagesPending = ceil(count($pendingAppointments) / $limit);

       // Pagination Logic for Past Appointments
       $currentPagePast = isset($_GET['page_past']) ? (int)$_GET['page_past'] : 1;
       $offsetPast = ($currentPagePast - 1) * $limit;
       $pastAppointmentsPaginated = array_slice($pastAppointments, $offsetPast, $limit);
       $totalPagesPast = ceil(count($pastAppointments) / $limit);

           
    
    
        // Error handling if POST with no appointment_id
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['appointment_id'])) {
            $_SESSION['error'] = 'Failed to cancel the appointment.';
        }
    
        $this->view('header');
        $this->view('patient/appointments', [
        'pendingAppointments' => $pendingAppointmentsPaginated,
        'pastAppointments' => $pastAppointmentsPaginated,
        'currentPagePending' => $currentPagePending,
        'totalPagesPending' => $totalPagesPending,
        'currentPagePast' => $currentPagePast,
        'totalPagesPast' => $totalPagesPast,
        'data' => $data,
        
        
        ]);
        $this->view('footer');
    }
    



    public function medical_records($a = '') {
        $this->view('header');

        $document = new Document;

        //retrieve the documents from the database
        $documents = $document->getDocuments($_SESSION['USER']->user_id);
        
        //filter and sort medical records by uploaded_at descending
        $medicalRecords = is_array($documents) ? array_filter($documents, function($doc) {
            return $doc['document_type'] === 'medical_record';
        }) : [];

        usort($medicalRecords, function($a,$b) {
            return strtotime($b['uploaded_at']) <=> strtotime($a['uploaded_at']);
        });
        
        //pagination
        $documentsPerPage = 6;
        $totalDocuments = count($medicalRecords);
        $totalPages = ceil($totalDocuments / $documentsPerPage);
        $currentPage = isset($_GET['page']) ? max(1, min((int)$_GET['page'], $totalPages)) : 1;

        $startIndex = ($currentPage - 1) * $documentsPerPage;
        $pagedDocuments = array_slice($medicalRecords,$startIndex,$documentsPerPage);

        $data = [
            'documents' => $pagedDocuments,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages
        ];

        $this->view('Patient/medical_records', $data);

        $this->view('footer');
    }

    public function lab_reports($a = '') {
        $this->view('header');

        $document = new Document;

        //retrieve the documents from the database
        $documents = $document->getDocuments($_SESSION['USER']->user_id);

        //filter and sort lab reports by uploaded_at descending
        $labReports = is_array($documents) ? array_filter($documents, function($doc) {
            return $doc['document_type'] === 'lab_report';
        }) : [];

        usort($labReports, function($a,$b) {
            return strtotime($b['uploaded_at']) <=> strtotime($a['uploaded_at']);
        });

        //pagination
        $documentsPerPage = 6;
        $totalDocuments = count($labReports);
        $totalPages = ceil($totalDocuments / $documentsPerPage);
        $currentPage = isset($_GET['page']) ? max(1, min((int)$_GET['page'], $totalPages)) : 1;

        $startIndex = ($currentPage - 1) * $documentsPerPage;
        $pagedDocuments = array_slice($labReports,$startIndex,$documentsPerPage);

        $data = [
            'documents' => $pagedDocuments,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages
        ];

        $this->view('Patient/lab_reports', $data);

        $this->view('footer');
    }

    public function private_files($a = '')
    {
        $document = new Document;

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {
            $user_id = $_POST['user_id'];
            $uploaded_by = $_POST['uploaded_by'];
            $document_type = $_POST['document_type'];
            $private_category = $_POST['private_category'];

            $targetDir = "assets/documents/$user_id/private_files/";

            if (isset($_FILES['real-file']) && $_FILES['real-file']['error'] == 0) {
                $filename = basename($_FILES['real-file']['name']);
                $targetPath = $targetDir . $filename;

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                if(file_exists($targetPath)) {
                    $error = "File already exists.";
                }

                else {
                    
                    if (move_uploaded_file($_FILES['real-file']['tmp_name'], $targetPath)) {
                    
                        $data = [
                            'user_id' => $user_id,
                            'uploaded_by' => $uploaded_by,
                            'document_type' => $document_type,
                            'document_name' => $filename,
                            'private_category' => $private_category
                        ];

                        $document->insert($data);
                        redirect('Patient/private_files?page=1');
                    }
                }
            }
        }

        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {

            $user_id = $_POST['user_id'];
            $document_id = htmlspecialchars($_POST['document_id']);
            $new_document_name = htmlspecialchars($_POST['document_name']);
            $extension = htmlspecialchars($_POST['extension']);

            $new_file_name = $new_document_name . '.' . $extension;

            
            $current_document = $document->getDocumentById($document_id);

            $current_document_name = $current_document->document_name;

            $targetDir = "assets/documents/$user_id/private_files/";

            $old_path = $targetDir . $current_document_name;
            $new_path = $targetDir . $new_file_name;

            
            if (file_exists($old_path)) {
                
                if(file_exists($new_path)) {
                    $error = "File already exists.";
                }
                else {
                    
                    if (rename($old_path, $new_path)) {
                        $data = [
                            'document_name' => $new_file_name
                        ];
                        $document->update($document_id, $data, 'document_id');
                        redirect('Patient/private_files?page=1');
                    }
                } 
            }
        }

        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {

            $user_id = $_POST['user_id'];
            $document_id = htmlspecialchars($_POST['document_id']);
            $document_name = htmlspecialchars($_POST['document_name']);

            $document_path = "assets/documents/$user_id/private_files/" . $document_name;

            if (file_exists($document_path)) {
                if (unlink($document_path)) {
                    $document->delete($document_id, 'document_id');
                    unset($_POST);
                }
            }

            redirect('Patient/private_files?page=1');
        }

        $this->view('header');

        
        $documents = $document->getDocuments($_SESSION['USER']->user_id);

        
        $privateFiles = is_array($documents) ? array_filter($documents, function($doc) {
            return $doc['document_type'] === 'private';
        }) : [];

        
        usort($privateFiles, function($a,$b) {
            return strtotime($b['uploaded_at']) <=> strtotime($a['uploaded_at']);
        });
        
        
        // $documentsPerPage = 6;
        // $totalDocuments = count($privateFiles);
        // $totalPages = ceil($totalDocuments / $documentsPerPage);
        // $currentPage = isset($_GET['page']) ? max(1,min((int)$_GET['page'], $totalPages)) : 1;

        // $startIndex = ($currentPage - 1) * $documentsPerPage;
        // $pagedDocuments = array_slice($privateFiles, $startIndex, $documentsPerPage);

        $categories = [
            'medical' => [],
            'lab' => [],
            'other' => []
        ];

        foreach($privateFiles as $doc) {
            $category = $doc['private_category'];

            if(isset($categories[$category])) {
                $categories[$category][] = $doc;
            }
        }

        $data = [
            'categories' => $categories
            // 'currentPage' => $currentPage,
            // 'totalPages' => $totalPages
        ];

        if(isset($error)) {
            $data['same_name_error'] = $error;
        }

        $this->view('Patient/private_files', $data);

        $this->view('footer');
    }
}