<?php
class Appointmentdetailsverification extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {

        $this->view('header');




        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $title = $_POST['title'] ?? '';
            $patient_Name = $_POST['patientName'] ?? '';
            $patient_Email = $_POST['patientEmail'] ?? 'Not entered';
            $patient_Phone = $_POST['patientPhone'] ?? '';
            $idType = $_POST['idType'] ?? '';
            $NicOrPassport = $_POST['NicOrPassport'] ?? '';
            $patientAddress = $_POST['patientAddress'] ?? 'Not entered';
            $hospitalName = $_POST['hospital_name'] ?? '';
            $sessionDate = $_POST['session_date'] ?? '';
            $sessionTime = $_POST['session_time'] ?? '';
            $patient_appointment_time = $_POST['patient_appointment_time'] ??'';
            $appointmentNumber = $_POST['appointment_number'] ?? '';
            $doctorid = $_POST['doctor_id'] ?? '';
            $doctorFee = $_POST['doctor_fee'] ?? '';
            $hospitalFee = $_POST['hospital_fee'] ?? '';
            $serviceCharge = isset($_POST['serviceCharge']) && $_POST['serviceCharge'] === "on" ? 285 : 0;

            $totalFee = $hospitalFee + $doctorFee + $serviceCharge;
          


            $data = [
                'title' => $title,
                'patientName' => $patient_Name,
                'patientEmail' => $patient_Email,
                'patientPhone' => $patient_Phone,
                'idType' => $idType,
                'NicOrPassport' => $NicOrPassport,
                'patientAddress' => $patientAddress,
                'hospital_name' => $hospitalName,
                'session_date' => $sessionDate,
                'session_time' => $patient_appointment_time,
                'appointment_number' => $appointmentNumber,
                'doctor_id' => $doctorid,
                'total_fee' => $totalFee,
            ];

 
            $_SESSION['appointment'] = $data;

           
            $this->view('appointment/appointmentdetailsverification', $data);
    
        
        } else {
            echo "Invalid request method.";
        }
        $this->view('footer');
    }
}
