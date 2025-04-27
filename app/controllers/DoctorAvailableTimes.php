<?php



class DoctorAvailableTimes extends Controller
{


    public function index($a = '', $b = '', $c = '')
    {

        $this->view('header');

        $availableTimes = new Availabletime();

        $doctorModel = new DoctorModel();      
        $hospitals = new Hospital();
        $user=new User();

        $doctorId = $_GET['doctor_id'] ?? null;
        $dateQuery = $_GET['date'] ?? null;
        $hospitalQuery = $_GET['hospital_id'] ?? null;

        if (!$doctorId) {
            die("Please enter a doctor ID!!!!");
        }
       
        
        $doctor = $doctorModel->getDoctorById($doctorId);
        
        $user_id=$doctor->user_id;
        $profilepicture = $user->getProfilePic($user_id);
        
        $profilepic=isset($profilepicture[0]['profile_pic']) ? $profilepicture[0]['profile_pic'] : null;

        $doctor_name = $doctor ? $doctor->name : 'Doctor not found';

        
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

             if (is_array($getAppointmentdetails)) {
                 usort($getAppointmentdetails, fn($a, $b) => strtotime($a->appointment_date) - strtotime($b->appointment_date));
             }
            
             
          
                    if (is_array($getAppointmentdetails)) {
    
         $getAppointmentdetails = array_filter($getAppointmentdetails, function($appointment) use ($CurrentDate, $CurrentTime) {
       
        if ($appointment->appointment_date > $CurrentDate) {
            return true;
        }
       
        
        
        $endTime  = date('H:i:s', strtotime($appointment->start_time) + $appointment->duration * 60 * 60);
        
       
        if ($appointment->appointment_date == $CurrentDate && $endTime > $CurrentTime) {
            return true;
        }

       
        return false;
    });
} else {
    
    $getAppointmentdetails    = [];
}


if (empty($getAppointmentdetails)) {
    $noAppointmentsMessage    = "No appointments available for this doctor at the moment.";
} else {
    $noAppointmentsMessage    = ''; 
}

$page=isset($_GET['page'])?(int)$_GET['page']:1;
$limit=6;
$offset=($page-1)*$limit;
$totalAppointmentSlots=count($getAppointmentdetails);
$totalPages=ceil($totalAppointmentSlots/$limit);
$getAppointmentdetails=array_slice($getAppointmentdetails,$offset,$limit);


$data = [
    'appointments' => $getAppointmentdetails,
    'totalPages' => $totalPages,
    'currentPage' => $page,
    'doctor_name' => $doctor_name,
    'doctor_specialization' => $doctor_specialization,
    'doctorId' => $doctorId,
    'noAppointmentsMessage' => $noAppointmentsMessage,
    'profilepicture' => $profilepic,
    'user_id' => $user_id,

];


$this->view('appointment/doctorAvailableTimes', $data);
$this->view('footer');
    }
}