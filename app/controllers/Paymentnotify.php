<?php

class Paymentnotify extends Controller
{
    use Model;

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request method.";
            return;
        }

       
        $transactionId = $_POST['transaction_id'] ?? '';
        $paymentStatus = $_POST['status'] ?? '';  
        $orderId = $_POST['order_id'] ?? '';
        $amount = $_POST['amount'] ?? '';
        $paymentMethod = $_POST['payment_method'] ?? '';
        $merchantSecret = 'MjQwOTcyNzAzMjM0ODk4MTYwNDQ0Mzc1NjQ3OTQ5MTM5ODYx';  

        $merchantId = $_POST['merchant_id'] ?? '';
        $currency = $_POST['currency'] ?? '';
        $receivedSignature = $_POST['signature'] ?? '';

       
        $signatureString = "$merchantId$orderId$amount$currency$paymentStatus" . strtoupper(hash('sha256', $merchantSecret));
        $generatedSignature = strtoupper(hash('sha256', $signatureString));

        if ($generatedSignature !== $receivedSignature) {
            echo "Invalid payment notification signature.";
            error_log("Invalid signature detected for Order ID: $orderId");  // Log the issue
            return;
        }

       
        $paymentData = [
            'user_id' => $_SESSION['USER']->user_id ?? null,
            'appointment_id' => $orderId,
            'transaction_id' => $transactionId,
            'payment_method' => $paymentMethod,
            'payment_status' => ($paymentStatus === '2') ? 'confirmed' : 'failed',
            'payment_amount' => $amount,
            'payment_date' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];


        // if(isset($_GET['search'])){
        //     $searchQuery = $_GET['search'];
        //     $getAppointmentdetails = array_filter($getAppointmentdetails, function($appointment) use ($searchQuery) {
        //         return stripos($appointment->hospital_name, $searchQuery) !== false;
        // });
        // }

        ?>
                <div class="search">
                    <p>Enter hospital</p>
                    <form action="<?php echo ROOT; ?>/DoctorAvailableTimes" method="GET">
                        <input type="text" name="search" placeholder="Search for hospital" required>
                        <input type="hidden" name="doctor_id" value="<?= $_GET['doctor_id'] ?>">
                        <button type="submit">Search</button>
                </div>
            </form>
        <?php


      
        $paymentModel = new PaymentModel();
        $existingPayment = $paymentModel->getByOrderId($orderId);

        if ($existingPayment) {
            $paymentModel->updatePayment($orderId, $paymentData);
        } else {
            $paymentModel->insert($paymentData);
        }

      
        $appointmentModel = new Appointments();
        $appointmentModel->updateStatus($orderId, $paymentData['payment_status']);

        
        echo "SUCCESS";  
    }
}



  //ascending order sortingby name
if (is_array($doctorResults)) {
    usort($doctorResults, function ($a, $b) {
    return strcmp($a->name, $b->name);
    });
}


$appointments = [
    ['name' => 'John', 'country' => 'Sri Lanka'],
    ['name' => 'Jane', 'country' => 'India'],
];

foreach ($appointments as $at) {
    if ($at['country'] === 'Sri Lanka') {
        echo $at['name'] . " is from Sri Lanka<br>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['patient_name'];
    $date = $_POST['appointment_date'];
    // Only allow weekdays
    $dayOfWeek = date('N', strtotime($date)); // 6=Saturday, 7=Sunday
    if ($dayOfWeek >= 6) {
        echo "Appointments can only be booked on weekdays.";
        exit;
    }
    $appointmentModel = new Appointments();
    $appointmentData = [
        'patient_name' => $name,
        'appointment_date' => $date
    ];
    $appointmentModel->insert($appointmentData);
    echo "Appointment added!";
}


?>
