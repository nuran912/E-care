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

    public function profile()
    {

        $data['errors'] = [];
        $data['success'] = [];
        $user = new User;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($user->validateUpdate($_POST)) {
                $user->update($_SESSION['USER']->user_id, $_POST, 'user_id');
                $_SESSION['USER'] = $user->first(['user_id' => $_SESSION['USER']->user_id]);
            }
            $data['errors'] = $user->errors;
            if (empty($data['errors']))
                $data['success'] = 'Profile updated successfully';
        }
        $this->view('header');
        $this->view('patient/profile', $data);
        $this->view('footer');
    }










    public function appointments()
    {
        $this->view('header');

        $Pastappointments = new Appointments;
        // $data['patient_id'] = $_SESSION['USER'];
        // $data['status'] = 'completed';
        // $Pastappointments = $Pastappointments->where($data);


        $this->view('patient/appointments');
        $this->view('footer');
    }
}
