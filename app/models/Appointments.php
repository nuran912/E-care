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

    public function getAppointmentsByUserId($id){
        $query = "SELECT * FROM $this->table WHERE user_id = :user_id ";
        $result = $this->query($query, ['user_id' => $id]);
        return $result ? $result : null;
    }
    public function getAppointmentsByDoctorId($doctorId){
        $query = "SELECT * FROM $this->table WHERE doctor_id = :doctor_id ";
        $result = $this->query($query, ['doctor_id' => $doctorId]);
        return $result ? $result : null;
    }
}



