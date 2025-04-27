<?php

if (($_SESSION['USER']->role != 'lab_clerk') && ($_SESSION['USER']->role != 'record_clerk') && ($_SESSION['USER']->role != 'reception_clerk')) {
    redirect('Home');
}

require_once dirname(__DIR__) . '/core/EmailHelper.php';

class Clerk extends Controller {

    public function index($a = '', $b = '', $c = ''){
        $this->profile();
    }

    public function profile($a = '', $b = '', $c = ''){
              
        $user = new User;
        $userData = array($user->getById($_SESSION['USER']->user_id));
        $clerk = new ClerkModel;
        $clerkData = array($clerk->getClerkByUserId($_SESSION['USER']->user_id));
        $data = array_merge($userData, $clerkData);
        // $data['error'] = [];
        // $data['success'] = "";
        // $data['status'] = [];
        // $data['passUpdateSuccess'] = "";
        // $data['passUpdateError'] = "";
        // $_SESSION['updateData'] = [];

        $profilePic = $user->getProfilePic($_SESSION['USER']->user_id);

        if(!empty($profilePic) && !empty($profilePic[0]['profile_pic'])) {
            $data['profilePic'] = ROOT . "/assets/profile_pictures/" . htmlspecialchars($_SESSION['USER']->user_id) . "/" . $profilePic[0]['profile_pic'];
        }
        else {
            $data['profilePic'] = ROOT . "/assets/img/user.svg";
        }
        
        $this->view('header');

        $userData = $user->getById($_SESSION['USER']->user_id);
        $clerkData = $clerk->getclerkByUserId($_SESSION['USER']->user_id);
        if( $a == 'update'){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              
                // $clerkData = $clerk->getclerkByUserId($_SESSION['USER']->user_id);
                // show($clerkData);
                // $userData = $user->getById($_SESSION['USER']->user_id);
  
                $originalProfileInfo = [
                    'name' => $userData->name,
                    'empId' => $clerkData->emp_id,
                    'NIC' => $userData->NIC,
                    'phone_number' => $userData->phone_number,
                    'email' => $userData->email,
                ];
  
                $dataToUpdate = $_POST;
                $passswordToUpdate = array("password"=>$dataToUpdate['password'] , "newpassword"=>$dataToUpdate['newpassword']);
                
                $data['status'] = $clerk->profileValidation($dataToUpdate, $originalProfileInfo);
              
                if(empty($dataToUpdate['password']) && empty($dataToUpdate['newpassword'])){
                    unset($dataToUpdate['password']);
                    unset($dataToUpdate['newpassword']);
                    if($data['status'] === true){
                        $clerk->update($clerkData->emp_id, $dataToUpdate, 'emp_id');
                        $user->updateclerkDetails($userData->user_id, $dataToUpdate, 'user_id');
                        $data['success'] = "Profile information updated successfully";
                    }else{
                        $data['error'] = $data['status'];
                    }
                }
                
                else{
                    $passswordToUpdate = $clerk->passwordValidation($passswordToUpdate, $userData->password);
                    unset($dataToUpdate['password']);
                    unset($dataToUpdate['newpassword']);
                    if($data['status'] === true){
                        $clerk->update($clerkData->emp_id, $dataToUpdate, 'emp_id');
                        $user->updateclerkDetails($userData->user_id, $dataToUpdate, 'user_id');
                        $data['success'] = "Profile information updated successfully";
                    }else{
                        $data['error'] = $data['status'];
                    }
                    if($passswordToUpdate['passUpdateStatus'] === true){
                        $user->updateclerkDetails($userData->user_id, $passswordToUpdate, 'user_id');
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
                $_SESSION['USER'] = $user->getById($userData->user_id);;
                redirect('Clerk/profile');
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

                    redirect('Clerk/clerkProfile');
                }
            }   
        }

        $this->view('Clerk/clerkProfile', $data);
        $this->view('footer');
    }

    public function recordClerkUploadDoc() {

        $this->view('header');

        $data = [];

        $document = new Document;

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {


            $patient_email = $_POST['patient_email'];
            $uploaded_by = $_POST['uploaded_by'];
            $document_type = 'medical_record';
            $document_category = $_POST['document_category'];
            $ref_no = $_POST['ref_no'];

            $user = new User;

            $user_id = $user->getUserIDByEmail($patient_email); //patient id
            $user_name = $user->getUserNameByEmail($patient_email); //patient name

            $user_id_extracted = $user_id[0]['user_id'];
            $user_name_extracted = $user_name[0]['name'];

            //target directory
            $targetDir = "assets/documents/$user_id_extracted/medical_records/";

            //check if the file was uploaded
            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                $filename = basename($_FILES['file']['name']);
                $targetPath = $targetDir . $filename;

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                if(file_exists($targetPath)) {
                    $data['same_name_error'] = "File with the same name already uploaded to this patient.";
                }

                else {
                    //moving the file to the target path
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {

                        //moved successfully
                        $document_data = [
                            'user_id' => $user_id_extracted,
                            'uploaded_by' => $uploaded_by,
                            'document_type' => $document_type,
                            'document_category' => $document_category,
                            'document_name' => $filename,
                            'ref_no' => $ref_no
                        ];

                        $document->insert($document_data);
                        
                        //uploaded date and time
                        date_default_timezone_set('Asia/Colombo');
                        $uploadDateTime = date('Y-m-d H:i:s'); //YYYY-MM-DD HH:MM:SS

                        //send the email
                        $subject = "New {$document_category} Uploaded to Your E-care Account";
                        $body = "
                        <html>
                        <body>
                            <p>Dear {$user_name_extracted},</p>
                            <p>This is to inform you that a new medical document has been successfully uploaded to your E-care profile.
                            You may now log in to the system to view or download it at your convenience.</p>
                            <p><strong>Document Type:</strong> " . ucfirst(str_replace('_', ' ', $document_type)) . "<br>
                            <strong>Category:</strong> {$document_category}<br>
                            <strong>Reference No:</strong> {$ref_no}<br>
                            <strong>Uploaded On:</strong> {$uploadDateTime}</p>
                            <p>If you have any questions or concerns regarding this document, please do not hesitate to contact our support team or your attending physician.</p>
                            <p>Thank you for using E-care Digital Health Management System.</p>
                            <p>Best regards,<br>
                            E-care Support Team<br>
                            Hotline - 011 245 9989<br>
                            Email - ecare2digital@gmail.com</p>
                        </body>
                        </html>
                        ";

                        $emailSent = EmailHelper::sendEmail($patient_email, $user_name_extracted, $subject, $body);

                        if($emailSent) {
                            $document->update($ref_no,['email_sent' => 1],'ref_no');
                            $data['success'] = "Email sent successfully."; 
                        }
                        else {
                            //if email not sent, delete the document from the database
                            if(file_exists($targetPath)) {
                                if(unlink($targetPath)) {
                                    $document->delete($ref_no,'ref_no');
                                }
                            }
                            $data['error'] = "Failed to send email.";
                        }
                    }
                }   
            }
        }

        $this->view('Clerk/recordClerkUploadDoc',$data);
        $this->view('footer');
    }

    public function recordClerkWorkLog() {

        $this->view('header');

        $document = new Document;

        //retrieve the documents
        $documents = $document->getAllDocuments($_SESSION['USER']->user_id);

        //searching process
        $searchDate = isset($_GET['search_date']) ? $_GET['search_date'] : null;
        
        $filteredDocuments = [];

        //filter documents by search date if provided
        if($searchDate) {
            foreach($documents as $doc) {
                if($doc['document_type'] == 'medical_record' && date('Y-m-d',strtotime($doc['uploaded_at'])) == $searchDate) {
                    $filteredDocuments[] = $doc;
                }
            }

            //sort by time descending
            usort($filteredDocuments, function($a,$b) {
                return strtotime($b['uploaded_at']) <=> strtotime($a['uploaded_at']);
            });

            //pagination
            $documentsPerPage = 5;
            $totalDocuments = count($filteredDocuments);
            $totalPages = ceil($totalDocuments / $documentsPerPage);
            $currentPage = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
            $start = ($currentPage - 1) * $documentsPerPage;
            $pagedDocuments = array_slice($filteredDocuments, $start, $documentsPerPage);

            //group paginated documents by date
            $groupedByDate = [];
            foreach($pagedDocuments as $doc):
                $dateOnly = date('Y-m-d',strtotime($doc['uploaded_at']));
                $groupedByDate[$dateOnly][] = $doc;
            endforeach;

            //sort by date descending
            krsort($groupedByDate);
        }
        else {
            //default: if search date is not provided
            foreach($documents as $doc) {
                if($doc['document_type'] == 'medical_record') {
                    $filteredDocuments[] = $doc;
                }
            }

            //sort by time descending
            usort($filteredDocuments, function($a,$b) {
                return strtotime($b['uploaded_at']) <=> strtotime($a['uploaded_at']);
            });

            //group documents by date
            $groupedByDate = [];
            foreach($filteredDocuments as $doc):
                $dateOnly = date('Y-m-d',strtotime($doc['uploaded_at']));
                $groupedByDate[$dateOnly][] = $doc;
            endforeach;

            //sort by date descending
            krsort($groupedByDate);
        }  

        $data = [
            'documents' => $groupedByDate,
            'totalPages' => isset($totalPages) ? $totalPages : 0,
            'currentPage' => isset($currentPage) ? $currentPage : 1,
            'search_date' => $searchDate
        ];

        $this->view('Clerk/recordClerkWorkLog',$data);
        $this->view('footer');
    }

    public function labClerkUploadDoc() {

        $this->view('header');

        $data = [];

        $document = new Document;

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {

            $patient_email = $_POST['patient_email'];
            $uploaded_by = $_POST['uploaded_by'];
            $document_type = 'lab_report';
            $document_category = $_POST['document_category'];
            $ref_no = $_POST['ref_no'];

            $user = new User;

            $user_id = $user->getUserIDByEmail($patient_email); //patient id
            $user_name = $user->getUserNameByEmail($patient_email); //patient name

            $user_id_extracted = $user_id[0]['user_id'];
            $user_name_extracted = $user_name[0]['name'];

            //target directory
            $targetDir = "assets/documents/$user_id_extracted/lab_reports/";

            //check if the file was uploaded
            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                $filename = basename($_FILES['file']['name']);
                $targetPath = $targetDir . $filename;

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                if(file_exists($targetPath)) {
                    $data['same_name_error'] = "File with the same name already uploaded to this patient.";
                }

                else {
                    //moving the file to the target path
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
                    //moved successfully
                        $document_data = [
                            'user_id' => $user_id_extracted,
                            'uploaded_by' => $uploaded_by,
                            'document_type' => $document_type,
                            'document_category' => $document_category,
                            'document_name' => $filename,
                            'ref_no' => $ref_no
                        ];

                        $document->insert($document_data);

                        //uploaded date and time
                        date_default_timezone_set('Asia/Colombo');
                        $uploadDateTime = date('Y-m-d H:i:s'); //YYYY-MM-DD HH:MM:SS

                        //send the email
                        $subject = "New {$document_category} Uploaded to Your E-care Account";
                        $body = "
                        <html>
                        <body>
                            <p>Dear {$user_name_extracted},</p>
                            <p>This is to inform you that a new medical document has been successfully uploaded to your E-care profile.
                            You may now log in to the system to view or download it at your convenience.</p>
                            <p><strong>Document Type:</strong> " . ucfirst(str_replace('_', ' ', $document_type)) . "<br>
                            <strong>Category:</strong> {$document_category}<br>
                            <strong>Reference No:</strong> {$ref_no}<br>
                            <strong>Uploaded On:</strong> {$uploadDateTime}</p>
                            <p>If you have any questions or concerns regarding this document, please do not hesitate to contact our support team or your attending physician.</p>
                            <p>Thank you for using E-care Digital Health Management System.</p>
                            <p>Best regards,<br>
                            E-care Support Team<br>
                            Hotline - 011 245 9989<br>
                            Email - ecare2digital@gmail.com</p>
                        </body>
                        </html>
                        ";

                        $emailSent = EmailHelper::sendEmail($patient_email, $user_name_extracted, $subject, $body);

                        if($emailSent) {
                            $document->update($ref_no,['email_sent' => 1],'ref_no');
                            $data['success'] = "Email sent successfully."; 
                        }
                        else {
                            //if email not sent, delete the document from the database
                            if(file_exists($targetPath)) {
                                if(unlink($targetPath)) {
                                    $document->delete($ref_no,'ref_no');
                                }
                            }

                            $data['error'] = "Failed to send email.";
                        }
                    }
                }
            }
        }

        $this->view('Clerk/labClerkUploadDoc',$data);
        $this->view('footer');
    }

    public function labClerkWorkLog() {

            $this->view('header');
    
            $document = new Document;
    
            //retrieve the documents
            $documents = $document->getAllDocuments($_SESSION['USER']->user_id);
    
            //searching process
            $searchDate = isset($_GET['search_date']) ? $_GET['search_date'] : null;
            
            $filteredDocuments = [];
    
            //filter documents by search date if provided
            if($searchDate) {
                foreach($documents as $doc) {
                    if($doc['document_type'] == 'lab_report' && date('Y-m-d',strtotime($doc['uploaded_at'])) == $searchDate) {
                        $filteredDocuments[] = $doc;
                    }
                }

                //sort by time descending
                usort($filteredDocuments, function($a,$b) {
                    return strtotime($b['uploaded_at']) <=> strtotime($a['uploaded_at']);
                });
    
                //pagination
                $documentsPerPage = 5;
                $totalDocuments = count($filteredDocuments);
                $totalPages = ceil($totalDocuments / $documentsPerPage);
                $currentPage = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
                $start = ($currentPage - 1) * $documentsPerPage;
                $pagedDocuments = array_slice($filteredDocuments, $start, $documentsPerPage);
    
                //group paginated documents by date
                $groupedByDate = [];
                foreach($pagedDocuments as $doc):
                    $dateOnly = date('Y-m-d',strtotime($doc['uploaded_at']));
                    $groupedByDate[$dateOnly][] = $doc;
                endforeach;
    
                //sort by date descending
                krsort($groupedByDate);
            }
            else {
                //default: if search date is not provided
                foreach($documents as $doc) {
                    if($doc['document_type'] == 'lab_report') {
                        $filteredDocuments[] = $doc;
                    }
                }

                //sort by time descending
                usort($filteredDocuments, function($a,$b) {
                    return strtotime($b['uploaded_at']) <=> strtotime($a['uploaded_at']);
                });
    
                //group documents by date
                $groupedByDate = [];
                foreach($filteredDocuments as $doc):
                    $dateOnly = date('Y-m-d',strtotime($doc['uploaded_at']));
                    $groupedByDate[$dateOnly][] = $doc;
                endforeach;
    
                //sort by date descending
                krsort($groupedByDate);
            }  
    
            $data = [
                'documents' => $groupedByDate,
                'totalPages' => isset($totalPages) ? $totalPages : 0,
                'currentPage' => isset($currentPage) ? $currentPage : 1,
                'search_date' => $searchDate
            ];
    
            $this->view('Clerk/labClerkWorkLog',$data);
            $this->view('footer');
    }
        

    public function receptionClerkViewPendingAppointments() {

        $this->view('header');

        $doctorModel = new DoctorModel;
        $clerkModel = new ClerkModel;

        $phone_number = '';

        $user_id = $_SESSION['USER']->user_id;

        $hospital = $clerkModel->getReceptionClerkHospitalByUserId($user_id);

        //retrieve all the appointments made to all the doctors in the hospital where clerk is working
        $appointments = $doctorModel->getDoctorAppointments($hospital[0]['name']);

        //search an appointment made by a patient
        if(isset($_POST['phone_number'])) {
            $phone_number = $_POST['phone_number'];
            $appointments = $doctorModel->getDoctorAppointmentsSearch($phone_number,$hospital[0]['name']);
        }
        
        if (!is_array($appointments)) {
            $appointments = [];
        }

        $data = [
            'appointments' => $appointments,
            'searched_phone_number' => $phone_number
        ];

        $this->view('Clerk/receptionClerkViewPendingAppointments',$data);
        $this->view('footer');
    }

    public function receptionClerkPendingAppointmentPayNow() {
        
        $appointment_id = $_GET['appointment_id'] ;

        $appointments = new Appointments();

        if(isset($_SESSION['USER']->role) == 'reception_clerk') {
            $status = 'completed';
            $appointments->updatePaymentStatus($appointment_id, $status);
            $appointments->update_is_deletedToZero($appointment_id);  
        }

        $this->view('Clerk/receptionClerkPendingAppointmentPayNow');
    }
}

?>