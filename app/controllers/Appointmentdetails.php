<?php



class Appointmentdetails extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $this->view('header');

        $availableTimes = (new Availabletime())->getAll();
        $doctors = (new DoctorModel())->getAll();
        $hospitals = (new Hospital())->getAll();

        $availableTimeId = isset($_GET['availableTimeId']) ? (int)$_GET['availableTimeId'] : null;
        $appointmentDetails = null;
         
        if ($availableTimeId) {


            foreach ($availableTimes as $appointment) {
                if ($appointment['id'] == $availableTimeId) {

                    $doctorDetails = findObjectById($doctors, 'id', $appointment['doctor_id']);
                    $hospitalDetails = findObjectById($hospitals, 'id', $appointment['hospital_id']);



                    if ($doctorDetails && $hospitalDetails) {
                        $appointmentDetails = [
                            'hospital_name' => $hospitalDetails->name,
                            'session_date' => $appointment['date'],
                            'session_time' => (new DateTime($appointment['start_time']))->format('h:i A'),
                            'doctor_fee' => $doctorDetails['Doctor_fee'],
                            'doctor_name' => $doctorDetails['name'],
                            'doctor_specialization' => $doctorDetails['specialization'],
                            'doctor_id' => $doctorDetails['id'],
                            'hospital_fee' => $hospitalDetails->hospital_fee,
                            'appointment_number' => $appointment['filled_slots'] + 1,
                            'filled_slots' => $appointment['filled_slots'],
                            'availableatime_id' => $appointment['id']
                        ];
                        

                        $appointmentDurationMinutes = $appointment['duration'] * 60;

                        if ($appointment['total_slots'] > 0) {
                            $appointmentDetails['appointment_number'] =  $appointment['filled_slots'] + 1;
                            $sessionStartTime = new DateTime($appointmentDetails['session_time']);
                            $patientAppointmentOffsetMinutes = ($appointmentDurationMinutes / $appointment['total_slots']) * ($appointmentDetails['appointment_number'] - 1);
                            $sessionStartTime->add(new DateInterval("PT{$patientAppointmentOffsetMinutes}M"));
                            $appointmentDetails['patient_appointment_time'] = $sessionStartTime->format('h:i A');
                        } else {
                            $appointmentDetails['patient_appointment_time'] = '12:00 AM';
                        }
                    } else {
                        echo "Invalid doctor or hospital ID in appointment data.";
                        exit;
                    }
                    break;
                }
            }

            if (!$appointmentDetails) {
                echo "Appointment ID not found.";
                exit;
            }
        } else {
            echo "Appointment ID not provided.";
            exit;
        }

        $service_charge = 285;

        $doctor_fee = (float) $appointmentDetails['doctor_fee'] ?? 0;
        $formatted_doctor_fee = number_format($doctor_fee, 2);

        $hospital_fee = (float) $appointmentDetails['hospital_fee'] ?? 0;
        $formatted_hospital_fee = number_format($hospital_fee, 2);

        $formatted_service_charge = number_format($service_charge, 2);

        $totalWithoutServiceCharge = $doctor_fee + $hospital_fee;
        $formatted_totalWithoutServiceCharge = number_format($totalWithoutServiceCharge, 2);

      
           

        $this->view('appointment/appointmentdetails', [
            'appointmentDetails' => $appointmentDetails,
            'formatted_doctor_fee' => $formatted_doctor_fee,
            'formatted_hospital_fee' => $formatted_hospital_fee,
            'formatted_service_charge' => $formatted_service_charge,
            'hospital_fee' => $hospital_fee,
            'doctor_fee' => $doctor_fee,
            'totalWithoutServiceCharge' => $formatted_totalWithoutServiceCharge,
        
        ]);
    
        $this->view('footer');
    }
}
