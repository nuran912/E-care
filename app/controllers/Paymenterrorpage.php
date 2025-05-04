<?php

class Paymenterrorpage extends Controller {
    public function index($a = '', $b = '', $c = '') {

       
       
        
        // Uncomment the following lines if you want to handle the appointment ID and update payment status

       
    //     $appointment_id = $_GET['order_id'] ?? null;
    //     if ($appointment_id) {
    //         $appointments = new Appointments();
    //         $status='unsucessful';
    //          $appointments->updatePaymentStatus($appointment_id, $status);
    // }





    $this->view('appointment/paymenterrorpage');
    
    }
}
