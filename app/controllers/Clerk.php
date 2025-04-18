<?php

if (($_SESSION['USER']->role != 'lab_clerk') && ($_SESSION['USER']->role != 'record_clerk') && ($_SESSION['USER']->role != 'reception_clerk')) {
    redirect('Home');
}

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
        $data['error'] = [];
        $data['success'] = "";
        $data['status'] = [];
        $data['passUpdateSuccess'] = "";
        $data['passUpdateError'] = "";
        // $_SESSION['updateData'] = [];
        
        $this->view('header');

        if( $a == 'update'){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              
                $clerkData = $clerk->getclerkByUserId($_SESSION['USER']->user_id);
                $userData = $user->getById($_SESSION['USER']->user_id);
  
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
                    if($data['status'] === true){
                        $clerk->update($clerkData->id, $dataToUpdate, 'emp_id');
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
                        $clerk->update($clerkData->id, $dataToUpdate, 'emp_id');
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
                // show($data);
                // redirect('clerk/profile');
            }
        }

        $this->view('Clerk/clerkProfile', $data);
        $this->view('footer');
    }

    public function recordClerkUploadDoc() {

        $this->view('header');

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

                //moving the file to the target path
                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {

                    //moved successfully
                    $data = [
                        'user_id' => $user_id_extracted,
                        'uploaded_by' => $uploaded_by,
                        'document_type' => $document_type,
                        'document_category' => $document_category,
                        'document_name' => $filename,
                        'ref_no' => $ref_no
                    ];

                    $document->insert($data);

                    // require_once __DIR__ . '\..\core\EmailHelper.php';
                    // require_once dirname(__DIR__) . '\core\EmailHelper.php';
                    // show(dirname(__DIR__));
                    
                    //uploaded date and time
                    $uploadDateTime = date('Y-m-d H:i:s'); //YYYY-MM-DD HH:MM:SS

                    //send the email
                    // $subject = "New {$document_category}" . ucfirst(str_replace('_', ' ', $document_type)) . "Uploaded to Your E-care Account";
                    // $body = "
                    // <html>
                    // <body>
                    //     <p>Dear {$user_name_extracted},</p>
                    //     <p><strong>Document Type:</strong> " . ucfirst(str_replace('_', ' ', $document_type)) . "<br>
                    //     <strong>Catgeory:</strong> {$document_category}<br>
                    //     <strong>Reference No:</strong> {$ref_no}
                    //     <strong>Uploaded On:</strong> {$uploadDateTime}</p>
                    //     <p>You can log in to your account to view and download the document.</p>
                    //     <p>Thank you,<br>The E-care Team</p>
                    // </body>
                    // </html>
                    // ";

                    // $emailSent = EmailHelper::sendEmail($patient_email, $user_name_extracted, $subject, $body);

                    // if($emailSent) {
                    //     redirect('Clerk/recordClerkWorkLog');
                    // }
                    // else {
                    //     echo "There was an issue sending the email";
                    // }
                }
                // else {
                //     echo "There was an issue uploading the file";
                // } 
            }
            // else {
            //     echo "No file was uploaded or there was an error with the file";
            // }
        }

        $this->view('Clerk/recordClerkUploadDoc');
        $this->view('footer');
    }

    public function recordClerkWorkLog() {

        $this->view('header');

        $document = new Document;

        //retrieve the documents
        $documents = $document->getAllDocuments();

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

        $document = new Document;

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {

            $patient_email = $_POST['patient_email'];
            $uploaded_by = $_POST['uploaded_by'];
            $document_type = 'lab_report';
            $document_category = $_POST['document_category'];
            $ref_no = $_POST['ref_no'];

            $user = new User;

            $user_id = $user->getUserIDByEmail($patient_email);

            $user_id_extracted = $user_id[0]['user_id'];

            //target directory
            $targetDir = "assets/documents/$user_id_extracted/lab_reports/";

            //check if the file was uploaded
            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                $filename = basename($_FILES['file']['name']);
                $targetPath = $targetDir . $filename;

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                //moving the file to the target path
                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
                    //moved successfully
                    $data = [
                        'user_id' => $user_id_extracted,
                        'uploaded_by' => $uploaded_by,
                        'document_type' => $document_type,
                        'document_category' => $document_category,
                        'document_name' => $filename,
                        'ref_no' => $ref_no
                    ];

                    $document->insert($data);

                    redirect('Clerk/labClerkWorkLog');
                }
            }
        }

        $this->view('Clerk/labClerkUploadDoc');
        $this->view('footer');
    }

    public function labClerkWorkLog() {

            $this->view('header');
    
            $document = new Document;
    
            //retrieve the documents
            $documents = $document->getAllDocuments();
    
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

        $user_id = $_SESSION['USER']->user_id;

        $hospital = $clerkModel->getReceptionClerkHospitalByUserId($user_id);

        //retrieve all the appointments made to all the doctors in the hospital where clerk is working
        $appointments = $doctorModel->getDoctorAppointments($hospital[0]['name']);

        //search an appointment made by a patient
        if(isset($_POST['find'])) {
            $phone_number = $_POST['find'];
            $appointments = $doctorModel->getDoctorAppointmentsSearch($phone_number,$hospital[0]['name']);
        }
        
        if (!is_array($appointments)) {
            $appointments = [];
        }

        $data = [
            'appointments' => $appointments
        ];

        $this->view('Clerk/receptionClerkViewPendingAppointments',$data);
        $this->view('footer');
    }
}

?>