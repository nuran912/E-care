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


        $appointment_id = isset($_POST['appointment_id']) ? $_POST['appointment_id'] : null;
        $appointmentsModel = new Appointments;
        $updateFilledSlots=new  Availabletime;

        //get details of the appointments of a patient
        $doctorModel = new DoctorModel;
        $data = $doctorModel->getUserDoctorAppointments($_SESSION['USER']->user_id);
        // Ensure user role validation happens first
        if ($_SESSION['USER']->role !== 'patient') {
            header('location: ' . ROOT . '/Home');
            exit;
           
        }



        foreach ($data as $item) {
            if (!empty($item->selected_files)) {
            $selectedFiles = explode(',', $item->selected_files);
           
        }
    }
  
        if (isset($_POST['appointment_id'])) {

            $appoitmentDetails = $appointmentsModel->getByAppointmentId($appointment_id);
            foreach ($appoitmentDetails as $appoitment) {
                $schedule_id = $appoitment->schedule_id;
                $session_time = $appoitment->session_time;
                $session_date = $appoitment->session_date;
            }
             
            


            // $appointmentsModel->delete($appointment_id, 'appointment_id');
            // $updateData=['is_deleted' => 1];
            date_default_timezone_set('Asia/Colombo');

            $current_date = date("Y-m-d ");

            if ($current_date < $session_date && (strtotime($session_date) - strtotime($current_date)) > 2 * 24 * 60 * 60) {
                $appointmentsModel->update_is_deleted($appointment_id);
                $appointmentsModel->updateStatus($appointment_id, 'canceled');

                $_SESSION['success'] = 'Appointment canceled successfully.';
            } else {
                $_SESSION['error'] = "You can't cancel the appointment because there are less than 48 hours remaining until your appointment.";
            }
            // $updateFilledSlots->update_filled_slots($schedule_id);
            
            header('location: ' . ROOT . '/Patient/appointments');
           
            exit; 


        }


        // Error handling if no appointment_id is set
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['appointment_id'])) {
            $_SESSION['error'] = 'Failed to cancel the appointment.';
        }


        $this->view('header');
        if (!is_array($data)) {
            $data = [];
        }


        $this->view('patient/appointments', $data);
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
                    redirect('patient/private_files');
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

            redirect('patient/private_files');
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

            redirect('patient/private_files');
        }

        //retrieve the documents from the database
        $document->setLimit(50);
        $document->setOrder('desc');
        $documents = $document->getDocuments($_SESSION['USER']->user_id);

        $data = [
            'documents' => $documents
        ];

        $this->view('patient/private_files', $data);

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