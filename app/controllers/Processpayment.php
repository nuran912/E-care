<?php

class ProcessPayment extends Controller
{
    use Model;

    public function index()
    {
        $createAppointment = new Appointments;
        $updateFilledSlots = new AvailableTime;
        
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Collect and sanitize form data
            $patientName = htmlspecialchars($_POST['patientName'] ?? '');
            $patientEmail = htmlspecialchars($_POST['patientEmail'] ?? '');
            $patientPhone = htmlspecialchars($_POST['patientPhone'] ?? '');
            $nicOrPassport = htmlspecialchars($_POST['NicOrPassport'] ?? '');
            $patientAddress = htmlspecialchars($_POST['patientAddress'] ?? '');
            $hospitalName = htmlspecialchars($_POST['hospital_name'] ?? '');
            $sessionDate = htmlspecialchars($_POST['session_date'] ?? '');
            $sessionTime = htmlspecialchars($_POST['session_time'] ?? '');
            $appointmentNumber = htmlspecialchars($_POST['appointment_number'] ?? '');
            $doctorId = htmlspecialchars($_POST['doctor_id'] ?? '');
            $totalFee = floatval($_POST['total_fee'] ?? 0);
            $userId = $_SESSION['USER']->user_id ?? 'NULL';
            $filledSlots = intval($_POST['filled_slots'] ?? 0);
            $availableTimeId = intval($_POST['availableatime_id'] ?? 0);

            // Prepare data for insertion
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

            $updateData = ['filled_slots' => $filledSlots + 1];
            $user_id=$_SESSION['USER']->user_id;

            // Update the database records
            $updateFilledSlots->update($availableTimeId, $updateData, 'id');
            $createAppointment->insert($appointmentData);
            $appointment_id=$createAppointment->getById_LatestRow($user_id);

            // $this->view('appointment/processpayment', ['appointmentData' => $appointmentData]);
            if($_SESSION['USER']->role=='reception_clerk'){
              
                header('Location: ' . ROOT . '/Appointment_successful_page');
                
               
            }
            
           else{    

            // Redirect to PayHere
            $merchantId = '1228671';
            $returnUrl = ROOT . '/Paymentsuccessfulpage';
            $cancelUrl = ROOT . '/PaymentErrorPage';
            $notifyUrl = ROOT . '/PaymentNotify';
            $merchant_secret='MjQwOTcyNzAzMjM0ODk4MTYwNDQ0Mzc1NjQ3OTQ5MTM5ODYx';
            $currency = "LKR";
            // $order_id = random_int(10000,999999);
            $order_id = $appointment_id;

            $hash = strtoupper(
                md5(
                    $merchantId . 
                     $order_id. 
                    number_format($appointmentData['total_fee'], 2, '.', '') . 
                    $currency .  
                    strtoupper(md5($merchant_secret)) 
                ) 
            );


            echo '<form id="paymentForm" method="POST" action="https://sandbox.payhere.lk/pay/checkout">
                <input type="hidden" name="merchant_id" value="' . $merchantId . '">
                <input type="hidden" name="return_url" value="' . $returnUrl . '">
                <input type="hidden" name="cancel_url" value="' . $cancelUrl . '">
                <input type="hidden" name="notify_url" value="' . $notifyUrl . '">
                <input type="hidden" name="first_name" value="' . $patientName . '">
                <input type="hidden" name="last_name" value="">
                <input type="hidden" name="email" value="' . $patientEmail . '">
                <input type="hidden" name="phone" value="' . $patientPhone . '">
                <input type="hidden" name="address" value="' . (!empty($patientAddress) ? $patientAddress : 'Not entered') . '">
                <input type="hidden" name="city" value=" Colombo "> 
                <input type="hidden" name="country" value="LK">
                <input type="hidden" name="order_id" value="' . $order_id . '">
                <input type="hidden" name="items" value="Appointment Payment">
                <input type="hidden" name="currency" value="'.$currency.'">
                <input type="hidden" name="amount" value="' . $totalFee . '">
                <input type="hidden" name="hash" value="' . $hash . '">
                <!-- <button type="submit">Pay now</button> -->
            </form>
            <script>
              
            
    document.getElementById("paymentForm").submit();

            </script>
            ';
           }
        }

        // $this->view('appointment/processpayment', []);
    }
}
