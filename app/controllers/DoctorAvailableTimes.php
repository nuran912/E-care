<?php



class DoctorAvailableTimes extends Controller
{


    public function index($a = '', $b = '', $c = '')
    {






        $this->view('header');

        $availableTimes = new Availabletime();

        $doctorModel = new Doctor();
        $hospitals = new Hospital();

        $doctorId = $_GET['doctor_id'] ?? null;
        $dateQuery = $_GET['date'] ?? null;
        $hospitalQuery = $_GET['hospital_id'] ?? null;

        if (!$doctorId) {
            die("Please enter a doctor ID!!!!");
        }

        // Get the doctor's information using findObjectById
        $doctor = $doctorModel->getDoctorById($doctorId);

        $doctor_name = $doctor ? $doctor->name : 'Doctor not found';

        // Get the doctor's specialization
        $doctor_specialization = $doctor
            ? (is_array($doctor->specialization)
                ? implode(", ", $doctor['specialization'])
                : $doctor->specialization)
            : 'Specialization not available';

        $getAppointmentdetails = $availableTimes->getAppointmentDetails($doctorId, $dateQuery, $hospitalQuery);
        $noAppointmentsMessage = empty($getAppointmentdetails) ? "No appointments available for this doctor at the moment." : null;

        $data = [
            'appointments' => $getAppointmentdetails,
            'doctor_name' => $doctor_name,
            'doctor_specialization' => $doctor_specialization,
            'doctorId' => $doctorId,
            'noAppointmentsMessage' => $noAppointmentsMessage
        ];
        $this->view('DoctorAvailableTimes', $data);
        $this->view('footer');
    }
}
