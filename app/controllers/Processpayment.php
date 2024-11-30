<?php

class Processpayment extends Controller
{
    // Add your methods and properties here
    use Model;
    public function index($a = '', $b = '', $c = '')
    {

        $createappointment = new Appointments;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {



            $patientName = $_POST['patientName'] ?? '';
            $patientEmail = $_POST['patientEmail'] ?? '';
            $patientPhone = $_POST['patientPhone'] ?? '';

            $NicOrPassport = $_POST['NicOrPassport'] ?? '';
            $patientAddress = $_POST['patientAddress'] ?? '';
            $hospitalName = $_POST['hospital_name'] ?? '';
            $sessionDate = $_POST['session_date'] ?? '';
            $sessionTime = $_POST['session_time'] ?? '';
            $appointmentNumber = $_POST['appointment_number'] ?? '';
            $doctorid = $_POST['doctor_id'] ?? '';
            $total_fee = $_POST['total_fee'] ?? '';

            $data = [
                // 'title' => $title,
                'patient_name' => $patientName,
                'patient_Email' => $patientEmail,
                'phone_number' => $patientPhone,
                'nic_passport' => $NicOrPassport,
                'patient_address' => $patientAddress,
                'hospital_name' => $hospitalName,
                'session_date' => $sessionDate,
                'session_time' => $sessionTime,
                'appointment_number' => $appointmentNumber,
                'doctor_id' => $doctorid,
                'user_id' => isset($_SESSION['USER']) ? $_SESSION['USER']->user_id : 'NULL',
                'total_fee' => $total_fee
            ];
        }

        $createappointment->insert($data);
        $this->view('appointment/processpayment', $data);
    }
}
