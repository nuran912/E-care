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
        'session_date',
        'session_time',
        'appointment_number',
    ];

    public $order_column = 'id';
}
