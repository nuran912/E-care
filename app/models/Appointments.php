<?php
class Appointments
{
    use Model;
    protected $table = 'appointments';

    protected $allowedColumns = [
        'user_id',
        'appointment_id',
        'doctor_id',
        'hospital_name',
        'patient_name',
        'patient_Email',
        'phone_number',
        'shedule_id',
        'status',
        'nic_passport',
         'session_date',
        'session_time',
        'patient_address',
        'total_fee',
        'appointment_number',     
    ];

    public $order_column = 'id';
 
    function updateStatus($appointmentId, $paymentstatus)
    {
        $this->update($appointmentId, $paymentstatus);
    }



    
  
}



