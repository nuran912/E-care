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
        'schedule_id',
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

    public function getByAppointmentId($appointment_id){
        $query = 'SELECT schedule_id ,session_time FROM appointments WHERE appointment_id = :appointment_id';
        $result = $this->query($query, ['appointment_id'=> $appointment_id]);
        return $result ? $result : null;
    }
    public function update_is_deleted($appointment_id)
{
    $query = 'UPDATE appointments SET is_deleted = 1 WHERE appointment_id = :appointment_id';
    $result = $this->query($query, ['appointment_id' => $appointment_id]);
    return $result ? $result : null;
}

    
}


