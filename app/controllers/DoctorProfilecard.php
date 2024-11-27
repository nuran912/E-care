
<?php

class DoctorProfile extends Controller {
    public function index($a = '', $b = '', $c = '') {
        $this->view('header');
<<<<<<< HEAD:app/controllers/DoctorProfilecard.php
        $doctorModel = new Doctor();

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




        $data = [
            'name' => $name,
            'doctor' => $doctor,
            'gender' => $gender,
            'registration_number' => $registration_number,
            'other_qualifications' => $other_qualifications,
            'practicing_government_hospitals' => $practicing_government_hospitals,
            'special_note' => $special_note,
            'specialization' => $specialization,
            'doctorId' => $id

        ];

        $this->view('doctorProfilecard', $data);
=======
        $this->view('doctorProfile');
>>>>>>> a4c0796abf574093a111e8f9522e48a34019663a:app/controllers/DoctorProfile.php
        $this->view('footer');
    }
}
