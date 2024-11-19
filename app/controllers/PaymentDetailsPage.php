<?php

class PaymentDetailsPage extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $this->view('header');
        
        $availableTimes = (new Availabletime())->findAll();
        $doctors = (new Doctor())->findAll();
        $hospitals = (new Hospital())->getAll();

        $availableTimeId = isset($_GET['availableTimeId']) ? (int)$_GET['availableTimeId'] : null;
        $appointmentDetails = null;
   
        if ($availableTimeId) {
            foreach ($availableTimes as $appointment) {
                if ($appointment['id'] === $availableTimeId) {
                    $doctorDetails = $this->findObjectById($doctors, 'id', $appointment['doctor_id']);
                    $hospitalDetails = $this->findObjectById($hospitals, 'id', $appointment['hospital_id']);
                    
                    if ($doctorDetails && $hospitalDetails) {
                        $appointmentDetails = [
                            'hospital_name' => $hospitalDetails['name'],
                            'session_date' => $appointment['date'],
                            'session_time' => $appointment['start_time']->format('h:i A'),
                            'doctor_fee' => $doctorDetails['Doctor_fee'],
                            'hospital_fee' => $hospitalDetails['hospital_fee'],
                            'appointment_number' => ($appointment['total_slots'] - $appointment['filled_slots'] + 1),
                        ];

                        $appointmentDurationMinutes = $appointment['duration'] * 60;

                        if ($appointment['total_slots'] > 0) {
                            $appointmentDetails['appointment_number'] = ($appointment['total_slots'] - $appointment['filled_slots'] + 1);
                            $sessionStartTime = new DateTime($appointmentDetails['session_time']);
                            $patientAppointmentOffsetMinutes = ($appointmentDurationMinutes / $appointment['total_slots']) * ($appointmentDetails['appointment_number'] - 1);
                            $sessionStartTime->add(new DateInterval("PT{$patientAppointmentOffsetMinutes}M"));
                            $appointmentDetails['patient_appointment_time'] = $sessionStartTime->format('h:i A');
                        } else {
                            $appointmentDetails['patient_appointment_time'] = '0:00 AM';
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
            echo "Invalid or missing appointment ID.";
            exit;
        }

        $service_charge = 285.00;
        $Total_fee = (float)($appointmentDetails['doctor_fee'] +  $appointmentDetails['hospital_fee'] + $service_charge);

        $doctor_fee = (float) $appointmentDetails['doctor_fee'] ?? 0;
        $formatted_doctor_fee = number_format($doctor_fee, 2);

        $hospital_fee = (float) $appointmentDetails['hospital_fee'] ?? 0;
        $formatted_hospital_fee = number_format($hospital_fee, 2);

        $formatted_Total_fee = number_format($Total_fee, 2);
        $formatted_service_charge = number_format($service_charge, 2);

        $this->view('PaymentDetailsPage', [
            'appointmentDetails' => $appointmentDetails,
            'formatted_doctor_fee' => $formatted_doctor_fee,
            'formatted_hospital_fee' => $formatted_hospital_fee,
            'formatted_service_charge' => $formatted_service_charge,
            'formatted_Total_fee' => $formatted_Total_fee
        ]);
        $this->view('footer');
    }

    private function findObjectById($array, $key, $value)
    {
        foreach ($array as $element) {
            if (isset($element[$key]) && $element[$key] == $value) {
                return $element;
            }
        }
        return null;
    }
}

