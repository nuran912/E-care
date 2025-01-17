<?php

class Paymentsuccessfulpage extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {



        
        $appointment_id = $_GET['order_id'] ?? null;
if ($appointment_id && $_SESSION['USER']->role != 'reception_clerk') {
    $appointments = new Appointments();
    $status = 'completed';
    $appointments->updatePaymentStatus($appointment_id, $status);
}
   
        




        $this->view('appointment/paymentsuccessfulpage');
    }
}
