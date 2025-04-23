
<?php

class DoctorProfilecard extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $this->view('header');
        $doctorModel = new DoctorModel();

        $id = $_GET["id"];
        $doctor = $doctorModel->getDoctorById($id);
        
        $name = $doctor->name;
        $gender = $doctor->gender;
        $registration_number = $doctor->registration_number;
        $other_qualifications = $doctor->other_qualifications;
        $practicing_government_hospitals = $doctor->practicing_government_hospitals;
        $special_note = $doctor->special_note;
        $specialization = $doctor->specialization;
        if (!$doctor) {
            header('Location: /_404.php');
            exit();
        }
        $user=new user();
        $user_id=$doctor->user_id;
        $profilepic=$user->getProfilePic($user_id);
        $checkprofilepicture = isset($profilepic[0]['profile_pic']) ? $profilepic[0]['profile_pic'] : null;
        
            
            
           
            

         



        $data = [
            'name' => $name,
            'doctor' => $doctor,
            'gender' => $gender,
            'registration_number' => $registration_number,
            'other_qualifications' => $other_qualifications,
            'practicing_government_hospitals' => $practicing_government_hospitals,
            'special_note' => $special_note,
            'specialization' => $specialization,
            'doctorId' => $id,
            'profilepicture' => $checkprofilepicture,
            'user_id' => $user_id,


        ];

        $this->view('appointment/doctorProfilecard', $data);
        $this->view('footer');
    }
}
