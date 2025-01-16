<?php
class Appointment_successful_page extends Controller
{
    public function index()
    {
        $this->view('header');


         
        $appointmentData = $_SESSION['appointment_data'] ?? [];

        $patientName = $appointmentData['patient_name'] ?? '';
        $patientEmail = $appointmentData['patient_Email'] ?? '';
        $patientPhone = $appointmentData['phone_number'] ?? '';
        $nicOrPassport = $appointmentData['nic_passport'] ?? '';
        $patientAddress = $appointmentData['patient_address'] ?? 'Not Entered';
        $hospitalName = $appointmentData['hospital_name'] ?? '';
        $sessionDate = $appointmentData['session_date'] ?? '';
        $sessionTime = $appointmentData['session_time'] ?? '';
        $appointmentNumber = $appointmentData['appointment_number'] ?? '';
        $doctorId = $appointmentData['doctor_id'] ?? '';
        $userId = $appointmentData['user_id'] ?? '';
        $totalFee = $appointmentData['total_fee'] ?? '';
        $availableTimeId = $appointmentData['schedule_id'] ?? '';
// Use and display the data as needed
// unset($_SESSION['appointment_data']);





$appointmentData = [
    'patient_name' => $patientName,
    'patient_Email' => $patientEmail,
    'phone_number' => $patientPhone,
    'nic_passport' => $nicOrPassport,
    'patient_address' => $patientAddress,
    'hospital_name' => $hospitalName,
    'session_date' => $sessionDate,
    'session_time' => $sessionTime,
    'appointment_number' => $appointmentNumber,
    'doctor_id' => $doctorId,
    'user_id' => $userId,
    'total_fee' => $totalFee,
    'payment_status' => 'pending',
    'schedule_id' => $availableTimeId
];

        
        
        $this->view('Clerk/appointment_successful_page', ['Data' => $appointmentData]);
       


        $this->view('footer');
    }
}