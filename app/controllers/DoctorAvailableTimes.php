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


        // Fetch available times from the database
        $availableTimesResults = $availableTimes->getByDoctorId($doctorId, $dateQuery, $hospitalQuery);


        // Check if there are no available times
        $noAppointmentsMessage = empty($availableTimesResults) ? "No appointments available for this doctor at the moment." : null;



        // Get hospital information
        $hospital_name = '';
        $Total_fee = 0;
        if (is_array($availableTimesResults) || is_object($availableTimesResults)) {
            foreach ($availableTimesResults as $at) {
                $hospital = findObjectById($hospitals->getAll(), 'id', $at->hospital_id);
                $hospital_fee = $hospital ? $hospital->hospital_fee : 0;
                $Doctor_fee = is_object($doctor) ? $doctor->Doctor_fee : 0;
                // Calculate total fee only if there are available appointments
                $Total_fee = $Doctor_fee + $hospital_fee;
                $hospital_name = $hospital ? $hospital->name : 'Hospital not found';
            }
        }


        $data = [
            'doctor_name' => $doctor_name,
            'doctor_specialization' => $doctor_specialization,
            'availableTimesResults' => $availableTimesResults,
            'Total_fee' => $Total_fee,
            'noAppointmentsMessage' => $noAppointmentsMessage,
            'hospitals' => $hospitals,
            'hospital_name' => $hospital_name,
            'doctorId' => $doctorId

        ];
        $this->view('DoctorAvailableTimes', $data);
        $this->view('footer');
    }

    
}
