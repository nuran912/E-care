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

        // $data['errors'] = [];
        // $data['success'] = [];
        // $user = new User;
        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     if ($user->validateUpdate($_POST)) {
        //         $user->update($_SESSION['USER']->user_id, $_POST, 'user_id');
        //         $_SESSION['USER'] = $user->first(['user_id' => $_SESSION['USER']->user_id]);
        //     }
        //     $data['errors'] = $user->errors;
        //     if (empty($data['errors']))
        //         $data['success'] = 'Profile updated successfully';
        // }
        $user = new User;
        $data = array($user->getById($_SESSION['USER']->user_id));
        $data['error'] = [];
        $data['success'] = "";
        $data['status'] = [];
        $data['passUpdateSuccess'] = "";
        $data['passUpdateError'] = "";

        if ($a == 'update') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $userData = $user->getById($_SESSION['USER']->user_id);

                $originalProfileInfo = [
                    'name' => $userData->name,
                    'NIC' => $userData->NIC,
                    'phone_number' => $userData->phone_number,
                    'email' => $userData->email,
                ];

                $dataToUpdate = $_POST;

                $passswordToUpdate = array("password" => $dataToUpdate['password'], "newpassword" => $dataToUpdate['newpassword']);

                $data['status'] = $user->profileValidation($dataToUpdate, $originalProfileInfo);

                if (empty($dataToUpdate['password']) && empty($dataToUpdate['newpassword'])) {
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
        }

        $this->view('patient/profile', $data);
        $this->view('footer');
    }

    public function appointments()
    {
        require_once dirname(__DIR__) . '/core/EmailHelper.php';
    
        $appointmentsModel = new Appointments;
        $updateFilledSlots = new Availabletime;
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
    
                // Attach document names to the appointment object
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
                $appointmentsModel->updateStatus($appointment_id, 'canceled');
                
                
    
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
                        <p>Your appointment at <b>$hospitalname</b> has been successfully canceled as per your request.</p>
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
                $_SESSION['success'] = 'Appointment canceled successfully.';
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
        $currentTime = date("g:i A");
        foreach ($data as $appointment) {
            $appointmentDate = $appointment->session_date;
            $appointmentTime = date("g:i A", strtotime($appointment->session_time));
        
            if ($appointment->is_deleted == 0) {
                if (
                    ($appointmentDate > $currentDate) ||
                    ($appointmentDate == $currentDate && strtotime($appointmentTime) > strtotime($currentTime))
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

           // Default section to 'pending' if not specified
    
    
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
    









    // public function cancelAppointment()
    // {
    //     $appointmentsModel = new Appointments;


    //     // Ensure only patients can delete their own appointments
    //     if ($_SESSION['USER']->role !== 'patient') {
    //         header('location: ' . ROOT . '/Home');
    //         exit;
    //     }

    //     if (isset($_POST['appointment_id'])) {
    //         $appointment_id = $_POST['appointment_id'];
    //         $getDetails=$appointmentsModel->getByAppointmentId($appointment_id);

    //         // Call the delete method from the model
    //         $appointmentsModel->delete($appointment_id, 'appointment_id');

    //         // Redirect back to the appointments page with success message
    //         $_SESSION['success'] = 'Appointment canceled successfully.';
    //         header('location: ' . ROOT . '/Patient/appointments');
    //         exit;
    //     } else {
    //         // Handle the case where appointment_id is not set
    //         $_SESSION['error'] = 'Failed to cancel the appointment.';
    //         header('location: ' . ROOT . '/Patient/appointments');
    //         exit;
    //     }
    // }


    public function documents($a = '')
    {

        $this->view('header');

        $document = new Document;

        //insert a private file
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {
            $user_id = $_POST['user_id'];
            $uploaded_by = $_POST['uploaded_by'];
            $document_type = $_POST['document_type'];

            //target directory
            $targetDir = "assets/documents/";

            //check if the file was uploaded
            if (isset($_FILES['real-file']) && $_FILES['real-file']['error'] == 0) {
                $filename = basename($_FILES['real-file']['name']);
                $targetPath = $targetDir . $filename;

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                //moving the file to the target path
                if (move_uploaded_file($_FILES['real-file']['tmp_name'], $targetPath)) {
                    //moved successfully
                    $data = [
                        'user_id' => $user_id,
                        'uploaded_by' => $uploaded_by,
                        'document_type' => $document_type,
                        'document_name' => $filename
                    ];

                    $document->insert($data);
                    redirect('patient/documents');
                }
            }
        }

        //update the name of a private file
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

            $document_id = htmlspecialchars($_POST['document_id']);
            $new_document_name = htmlspecialchars($_POST['document_name']);

            //fetch the current document details
            $query = "SELECT * FROM documents WHERE document_id = $document_id LIMIT 1";
            $current_document = $document->get_row($query);

            $current_document_name = $current_document->document_name;

            $targetDir = "assets/documents/";

            $old_path = $targetDir . $current_document_name;
            $new_path = $targetDir . $new_document_name;

            //rename the file in the directory
            if (file_exists($old_path)) {
                if (rename($old_path, $new_path)) {
                    $data = [
                        'document_name' => $new_document_name
                    ];
                    $document->update($document_id, $data, 'document_id');
                }
            }

            redirect('Patient/documents');
        }

        //delete a private file
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {

            $document_id = htmlspecialchars($_POST['document_id']);
            $document_name = htmlspecialchars($_POST['document_name']);

            $document_path = "assets/documents/" . $document_name;

            if (file_exists($document_path)) {
                if (unlink($document_path)) {
                    $document->delete($document_id, 'document_id');
                    unset($_POST);
                }
            }

            redirect('patient/documents');
        }

        //retrieve the documents from the database
        $document->setLimit(50);
        $document->setOrder('desc');
        $documents = $document->findAll();

        $data = [
            'documents' => $documents
        ];

        $this->view('Patient/documents', $data);

        $this->view('footer');
    }

    public function insuranceclaims($a = '', $b = '', $c = '')
    {
        $this->view('header');

        if($a == "submit"){
            
        }

        $this->view('Patient/insurance_claim');
        $this->view('footer');
    }
}