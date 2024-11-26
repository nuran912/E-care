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




        $doctorModel = new Doctor;


        $data = $doctorModel->getUserDoctorAppointments($_SESSION['USER']->user_id);

        $this->view('patient/appointments', $data);

        $this->view('footer');
    }

    public function cancelAppointment()
    {
        // Ensure only patients can delete their own appointments
        if ($_SESSION['USER']->role !== 'patient') {
            header('location: ' . ROOT . '/Home');
            exit;
        }

        if (isset($_POST['appointment_id'])) {
            $appointment_id = $_POST['appointment_id'];
            $appointmentsModel = new Appointments;
            // Call the delete method from the model
            $appointmentsModel->delete($appointment_id, 'appointment_id');

            // Redirect back to the appointments page with success message
            $_SESSION['success'] = 'Appointment canceled successfully.';
            header('location: ' . ROOT . '/Patient/appointments');
            exit;
        } else {
            // Handle the case where appointment_id is not set
            $_SESSION['error'] = 'Failed to cancel the appointment.';
            header('location: ' . ROOT . '/Patient/appointments');
            exit;
        }
    }
}
