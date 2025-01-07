<?php



class DoctorAvailableTimes extends Controller
{


    public function index($a = '', $b = '', $c = '')
    {

        $this->view('header');

        $availableTimes = new Availabletime();

        $doctorModel = new DoctorModel();
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

       
        date_default_timezone_set(timezoneId: 'Asia/Colombo');
             $CurrentDate = date('Y-m-d');
             $CurrentTime = date('H:i:s');
            /**
             * There is a problem when two or more appointment dates are equal to the current date.
             * If the end time of these appointments is higher than the current time, 
             * the appointments are not displaying in the view page.
             */
             
           // Ensure $getAppointmentdetails is an array and not a boolean (e.g., false from a failed query)
if (is_array($getAppointmentdetails)) {
    // Filter appointments based on the current date and time
    $getAppointmentdetails = array_filter($getAppointmentdetails, function($appointment) use ($CurrentDate, $CurrentTime) {
        // Check if the appointment date is after the current date
        if ($appointment->appointment_date > $CurrentDate) {
            return true;
        }

        // Calculate the end time of the appointment
        $endTime = date('H:i:s', strtotime($appointment->start_time) + $appointment->duration * 60 * 60);
        
        // If the appointment is today and the end time is greater than the current time
        if ($appointment->appointment_date == $CurrentDate && $endTime > $CurrentTime) {
            return true;
        }

        // Otherwise, hide the slot
        return false;
    });
} else {
    // Handle the case where $getAppointmentdetails is not an array or is empty
    $getAppointmentdetails = [];
}

if (empty($getAppointmentdetails)) {
    $noAppointmentsMessage = "No appointments available for this doctor at the moment.";
} else {
    $noAppointmentsMessage = ''; // Clear the message if there are appointments
}

// Prepare the data for the view
$data = [
    'appointments' => $getAppointmentdetails,
    'doctor_name' => $doctor_name,
    'doctor_specialization' => $doctor_specialization,
    'doctorId' => $doctorId,
    'noAppointmentsMessage' => $noAppointmentsMessage
];

// Load the views
$this->view('appointment/doctorAvailableTimes', $data);
$this->view('footer');
    }
}