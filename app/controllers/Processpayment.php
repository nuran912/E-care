<?php

class Processpayment extends Controller
{
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
            $doctorId = $_POST['doctor_id'] ?? '';
            $totalFee = $_POST['total_fee'] ?? '';
            $userId = $_SESSION['USER']->user_id ?? 'NULL';

            // Data array for insertion
            $data = [

                'patient_name' => $patientName,
                'patient_Email' => $patientEmail,
                'phone_number' => $patientPhone,
                'nic_passport' => $NicOrPassport,
                'patient_address' => $patientAddress,
                'hospital_name' => $hospitalName,
                'session_date' => $sessionDate,
                'session_time' => $sessionTime,
                'appointment_number' => $appointmentNumber,
                'doctor_id' => $doctorId,
                'user_id' => $userId,
                'total_fee' => $totalFee,
                'paymentstatus' => 'pending'
            ];

            // Insert data into the database
            $createappointment->insert($data);

            // Redirect to PayHere for payment
            $merchantId = '1228671'; 
            $returnUrl = ROOT . '/Paymentsuccessfulpage';  
            $cancelUrl = ROOT . '/paymenterrorpage';   
            $notifyUrl = ROOT . '/Paymentnotify';   
            $redirectUrl = "https://sandbox.payhere.lk/pay/checkout?" . http_build_query([
                'merchant_id' => $merchantId,
                'return_url' => $returnUrl,
                'cancel_url' => $cancelUrl,
                'notify_url' => $notifyUrl,
                'order_id' => $appointmentNumber,
                'items' => 'Appointment Payment',
                'currency' => 'LKR',
                'amount' => $totalFee,
                'first_name' => $patientName,
                'email' => $patientEmail,
                'phone' => $patientPhone,
                'address' => $patientAddress
            ]);

            header("Location: $redirectUrl");
            exit();
        }

        $this->view('appointment/processpayment', []);
    }
}
