<?php

class Paymenterrorpage extends Controller {
    public function index($a = '', $b = '', $c = '') {

       
    //     $appointment_id = $_GET['order_id'] ?? null;
    //     if ($appointment_id) {
    //         $appointments = new Appointments();
    //         $status='unsucessful';
    //          $appointments->updatePaymentStatus($appointment_id, $status);
    // }





    $this->view('appointment/paymenterrorpage');
    }
}
