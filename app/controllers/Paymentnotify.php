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

        // Retrieve POST data
        $transactionId = $_POST['transaction_id'] ?? '';
        $paymentStatus = $_POST['status'] ?? '';  // PayHere status (2 = Completed)
        $orderId = $_POST['order_id'] ?? '';
        $amount = $_POST['amount'] ?? '';
        $paymentMethod = $_POST['payment_method'] ?? '';
        $merchantSecret = 'MjQwOTcyNzAzMjM0ODk4MTYwNDQ0Mzc1NjQ3OTQ5MTM5ODYx';  // Replace with your actual merchant secret

        $merchantId = $_POST['merchant_id'] ?? '';
        $currency = $_POST['currency'] ?? '';
        $receivedSignature = $_POST['signature'] ?? '';

        // Correct Signature Generation Logic (SHA256)
        $signatureString = "$merchantId$orderId$amount$currency$paymentStatus" . strtoupper(hash('sha256', $merchantSecret));
        $generatedSignature = strtoupper(hash('sha256', $signatureString));

        if ($generatedSignature !== $receivedSignature) {
            echo "Invalid payment notification signature.";
            error_log("Invalid signature detected for Order ID: $orderId");  // Log the issue
            return;
        }

        // Prepare payment data for the database
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

        // Update or insert payment
        $paymentModel = new PaymentModel();
        $existingPayment = $paymentModel->getByOrderId($orderId);

        if ($existingPayment) {
            $paymentModel->updatePayment($orderId, $paymentData);
        } else {
            $paymentModel->insert($paymentData);
        }

        // Update appointment status
        $appointmentModel = new Appointments();
        $appointmentModel->updateStatus($orderId, $paymentData['payment_status']);

        // Respond to PayHere
        echo "SUCCESS";  // Stops further notification attempts
    }
}
?>
