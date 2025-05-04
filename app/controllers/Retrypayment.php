<?php
class Retrypayment extends Controller {
    public function index($a = '', $b = '', $c = '') {
  
     $appointment=new Appointments();  
     if(!isset($_SESSION['appointment_id'])) {
        header('Location: /appointmentsearchpage');
        exit;
     }
     if(isset($_SESSION['appointment_id'])){
        $appointment_id = $_SESSION['appointment_id'];
        $appointments = new Appointments();
        $appointment = $appointments->getAppointmentById($appointment_id);
        
        
        if($appointment->payment_status != 'pending'){
            header('Location: /appointmentsearchpage');
            exit;
        }


     }
     

  
      // Generate PayHere form again
$merchantId = '1228671';
$merchant_secret = 'MjQwOTcyNzAzMjM0ODk4MTYwNDQ0Mzc1NjQ3OTQ5MTM5ODYx';
$returnUrl = ROOT . '/Paymentsuccessfulpage';
$cancelUrl = ROOT . '/PaymentErrorPage';
$notifyUrl = ROOT . '/PaymentNotify';
$currency = "LKR";
$totalFee = $appointment->total_fee;
$hash = strtoupper(md5(
    $merchantId . 
    $appointment_id . 
    number_format($totalFee, 2, '.', '') . 
    $currency . 
    strtoupper(md5($merchant_secret))
));

echo '<form id="paymentForm" method="POST" action="https://sandbox.payhere.lk/pay/checkout">
    <input type="hidden" name="merchant_id" value="' . $merchantId . '">
    <input type="hidden" name="return_url" value="' . $returnUrl . '">
    <input type="hidden" name="cancel_url" value="' . $cancelUrl . '">
    <input type="hidden" name="notify_url" value="' . $notifyUrl . '">
    <input type="hidden" name="first_name" value="' . $appointment->patient_name . '">
    <input type="hidden" name="last_name" value="">
    <input type="hidden" name="email" value="' . $appointment->patient_Email . '">
    <input type="hidden" name="phone" value="' . $appointment->phone_number . '">
    <input type="hidden" name="address" value="' . (!empty($appointment->patient_address) ? $appointment->patient_address: 'Not entered') . '">
    <input type="hidden" name="city" value="Colombo"> 
    <input type="hidden" name="country" value="LK">
    <input type="hidden" name="order_id" value="' . $appointment_id . '">
    <input type="hidden" name="items" value="Appointment Payment">
    <input type="hidden" name="currency" value="'.$currency.'">
    <input type="hidden" name="amount" value="' . number_format($totalFee, 2, '.', '') . '">
    <input type="hidden" name="hash" value="' . $hash . '">
</form>
<script>document.getElementById("paymentForm").submit();</script>';

 
       
    





        $this->view('appointment/paymenterrorpage');
    }

}