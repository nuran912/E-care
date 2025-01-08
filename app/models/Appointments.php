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
    // public function getAppointmentsByDoctorIdGroupedByDate($doctorId){
    //     $query = "SELECT session_date, COUNT(*) AS total_appointments 
    //               FROM $this->table 
    //               WHERE doctor_id = :doctor_id 
    //               GROUP BY session_date";
    //     $result = $this->query($query, ['doctor_id' => $doctorId]);
    //     return $result ? $result : null;
    // }
    public function getAppointmentsByDoctorIdGroupedByDate($doctorId){
        $query = "SELECT * FROM $this->table WHERE doctor_id = :doctor_id";
        $result = $this->query($query, ['doctor_id' => $doctorId]);
    
        if (!$result) {
            return null;
        }
        // Group by date
        $grouped = [];
        foreach ($result as $row) {
            // show($row->session_date);
            $date = $row->session_date;
            $grouped[$date][] = $row;
        }
    
        return $grouped;
    }
    public function groupByScheduleId($slot, $array, $dateKey) {
        // Check if the specified date key exists in the array
        if (!isset($array[$dateKey])) {
            return []; // Return an empty array if the date key doesn't exist
        }
    
        $grouped = []; // Initialize an empty array for grouping
    
        // Loop through the appointments for the given date
        foreach ($array[$dateKey] as $appointment) {
            $scheduleId = $appointment->schedule_id; // Get the schedule_id
            // Group appointments by schedule_id
            $grouped[$slot->getByScheduleId($scheduleId)->id][] = $appointment;
        }
    
        return $grouped; // Return the grouped array
    }
    
    
}



