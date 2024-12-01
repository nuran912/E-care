<?php
    class PaymentModel
    {
        use Model;

        protected $table = 'payments';

        protected $allowedColumns = [
            'payment_id',
            'appointment_id',
            'user_id',
            'transaction_id',
            'payment_method',
            'payment_status',
            'payment_amount',
            'payment_date',
            'created_at',
            'updated_at'
        ];

        public $order_column = 'payment_id';

        public function updatePayment($orderId, $data)
        {
            $fields = array_map(fn($key) => "$key = :$key", array_keys($data));
            $query = "UPDATE payments SET " . implode(", ", $fields) . " WHERE appointment_id = :order_id";
            $data['order_id'] = $orderId;
            $this->query($query, $data);
        }

        public function getByOrderId($orderId)
        {
            return $this->query("SELECT * FROM payments WHERE appointment_id = :order_id", ['order_id' => $orderId]);
        }
    }
?>