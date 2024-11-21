
<?php
class Appointments
{
    use Model;
    protected $table = 'appointments';

    protected $allowedColumns = [
        'id',
        'title',
        'patient_name',
        'patient_Email',
        'phone_number',
        'id_type',
        'nic_passport',
        'patient_address',
        'hospital_name',
        'session_date',
        'session_time',
        'appointment_number',
        'doctor_id',
        'total_fee'
    ];

    public $order_column = 'id';

}
