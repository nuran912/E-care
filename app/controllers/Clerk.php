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

            $user_id = $_POST['patient_email'];
            $uploaded_by = $_POST['uploaded_by'];
            $document_type = 'medical_record';
            $document_category = $_POST['document_category'];
            $ref_no = $_POST['ref_no'];

            //target directory
            $targetDir = "assets/documents/";

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
                        'user_id' => $user_id,
                        'uploaded_by' => $uploaded_by,
                        'document_type' => $document_type,
                        'document_name' => $filename,
                        'ref_no' => $ref_no
                    ];

                    $document->insert($data);

                    redirect('Clerk/recordClerkWorkLog');
                }
            }
        }

        $this->view('Clerk/recordClerkUploadDoc');
        $this->view('footer');
    }

    public function recordClerkWorkLog() {

        $this->view('header');

        $document = new Document;

        $document->setLimit(50);
        $document->setOrder('desc');
        $documents = $document->findAll();

        $data = [
            'documents' => $documents
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

            //target directory
            $targetDir = "assets/documents/";

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
                        'user_id' => $user_id,
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

        $document->setLimit(50);
        $document->setOrder('desc');
        $documents = $document->findAll();

        $data = [
            'documents' => $documents
        ];

        $this->view('Clerk/labClerkWorkLog',$data);
        $this->view('footer');
    }

    public function receptionClerkViewPendingAppointments() {

        $this->view('header');

        $doctorModel = new DoctorModel;

        $data = $doctorModel->getDoctorAppointments();

        if(isset($_GET['find'])) {
            $find = '%' . $_GET['find'] . '%';
            $data = $doctorModel->getDoctorAppointmentsSearch($find,$find);
        }
        
        if (!is_array($data)) {
            $data = [];
        }

        $this->view('Clerk/receptionClerkViewPendingAppointments',$data);
        $this->view('footer');
    }
}

?>