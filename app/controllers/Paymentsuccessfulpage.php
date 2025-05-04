<?php

require_once dirname(__DIR__) . '/core/EmailHelper.php';

class Paymentsuccessfulpage extends Controller
{
    public function index()
    {
        $appointment_id = $_GET['order_id'] ?? null;
        
        
        $appointments = new Appointments();
        if ($appointment_id && (!isset($_SESSION['USER']) || !isset($_SESSION['USER']->role) || $_SESSION['USER']->role != 'reception_clerk')) {
           
            $status = 'completed';
            $appointments->updatePaymentStatus($appointment_id, $status);
            $appointments->update_is_deletedToZero($appointment_id);  
        }
        if (isset($_SESSION['USER']) && isset($_SESSION['USER']->role) && $_SESSION['USER']->role == 'reception_clerk') {
            $appointment_id = $_GET['appointment_id'] ?? null; 
            $appointments->update_is_deletedToZero($appointment_id);  
        }


        $appointments = new Appointments();
        $appointment = $appointments->getAppointmentById($appointment_id);

        $patientname       = $appointment ? $appointment->patient_name       : '';
        $patientemail      = $appointment ? $appointment->patient_Email      : '';
        $doctor_id         = $appointment ? $appointment->doctor_id          : '';
        $hospitalname      = $appointment ? $appointment->hospital_name      : '';
        $appointmentdate   = $appointment ? $appointment->session_date       : '';
        $appointmenttime   = $appointment ? $appointment->session_time       : '';
        $appointmentnumber = $appointment ? $appointment->appointment_number : '';
        $totalfee          = $appointment ? $appointment->total_fee          : '';
        $servicecharge     = $appointment ? $appointment->service_charge     : '';
        $patient_address   = $appointment ? $appointment->patient_address    : '';
        $NIC               = $appointment ? $appointment->nic_passport       : '';
        $contactnumber     = $appointment ? $appointment->phone_number       : '';
        $email_sent        = $appointment ? $appointment->email_sent         : 0;

        
        $Doctor = new DoctorModel();
        $doctor = $Doctor->getDoctorDetails($doctor_id);
        $doctorname = is_array($doctor) ? ($doctor[0]->name ?? '') : '';
        $doctorspecialization = is_array($doctor) ? ($doctor[0]->specialization ?? '') : '';

        
        if ( isset($appointment->email_sent)&& $appointment->email_sent == 0 && isset($patientemail)&& $_SESSION['USER']->role !== 'reception_clerk' ) {
        
            $subject = "Your Appointment Confirmation";
            $body = "
                <div class='container'>
                    <p>Dear <b>$patientname</b>,</p>
                    <p>We are pleased to confirm your appointment at <b>$hospitalname</b>.</p>
                    <p><b>Appointment Details</b></p>
                    <ul>
                        <li><b>Patient Name:</b> $patientname</li>
                        <li><b>Doctor:</b> $doctorname</li>
                        <li><b>Specialization:</b> $doctorspecialization</li>
                        <li><b>Appointment Number:</b> $appointmentnumber</li>
                        <li><b>Appointment Date:</b> " . date('Y F d l', strtotime($appointmentdate)) . "</li>
                        <li><b>Appointment Time:</b> " . date('h:i A', strtotime($appointmenttime)) . "</li>
                        <li><b>Hospital:</b> $hospitalname</li>
                        <li><b>Contact Number:</b> $contactnumber</li>
                        <li><b>NIC/Passport:</b> $NIC</li>
                    </ul>
                    <p><b>Fee Details:</b></p>
                    <ul>
                        <li><b>Total Fee:</b> LKR $totalfee.00</li>
                        <li><b>Service Charge:</b> LKR $servicecharge.00</li>
                    </ul>
                    <p>If you have any questions or need to make any changes, feel free to contact us.</p>
                    <p>Thank you for choosing $hospitalname. We look forward to seeing you on $appointmentdate.</p>
                    <p>Best regards,</p>
                    <p><b>$hospitalname</b><br>Your trusted healthcare provider</p>
                    <div class='footer'>
                        <p>&copy; " . date('Y') . " $hospitalname. All rights reserved.</p>
                    </div>
                </div>
            ";

            
            if (EmailHelper::sendEmail($patientemail, $patientname, $subject, $body)) {
                $appointments->updateEmailSent($appointment_id);
                $emailSent = true;
            } else {
                $emailSent = false;
            }
        } else {
            $emailSent = false;
        }
          $data=[
            'emailSent' => $emailSent,
            'patientEmail'=>$patientemail
          ];
            
        $this->view('appointment/paymentsuccessfulpage', $data);
    }
}
