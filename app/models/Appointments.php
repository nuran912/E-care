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
        'payment_status', 
        'service_charge', 
        'selected_files' , 
        'payment_status',
        'doctor_notes',    
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
        $query = 'SELECT * FROM appointments WHERE appointment_id = :appointment_id';
        $result = $this->query($query, ['appointment_id'=> $appointment_id]);
        return $result ? $result : null;
    }
    public function update_is_deleted($appointment_id)
{
    $query = 'UPDATE appointments SET is_deleted = 1 WHERE appointment_id = :appointment_id';
    $result = $this->query($query, ['appointment_id' => $appointment_id]);
    return $result ? $result : null;
}
public function update_is_deletedToZero($appointment_id)
{
    $query = 'UPDATE appointments SET is_deleted = 0 WHERE appointment_id = :appointment_id';
    $result = $this->query($query, ['appointment_id' => $appointment_id]);
    return $result ? $result : null;
}

public function getByNIC_LatestRow($nic_passport) {
    $query = "SELECT appointment_id FROM appointments 
              WHERE nic_passport = :nic_passport 
              ORDER BY appointment_id DESC 
              LIMIT 1";
    
    $result = $this->query($query, ['nic_passport' => $nic_passport]);

    // Access result as an object
    return $result ? $result[0]->appointment_id : null;
}

public function updatePaymentStatus($appointment_id, $status) {
    
    $allowedStatuses = ['completed', 'unsuccessful', 'pending'];
    if (!in_array($status, $allowedStatuses)) {
        throw new InvalidArgumentException("Invalid payment status: $status");
    }


    // Prepare and execute the query
    $query = 'UPDATE appointments SET payment_status = :status WHERE appointment_id = :appointment_id';
    $params = [
        'status' => $status,
        'appointment_id' => $appointment_id
    ];

    $result = $this->query($query, $params);
    return $result ? $result : null;
}
public function updateStatus($appointment_id, $status) {
    
    $allowedStatuses = ['completed', 'canceled', 'pending','scheduled'];
    if (!in_array($status, $allowedStatuses)) {
        throw new InvalidArgumentException("Invalid payment status: $status");
    }

    // Prepare and execute the query
    $query = 'UPDATE appointments SET status = :status WHERE appointment_id = :appointment_id';
    $params = [
        'status' => $status,
        'appointment_id' => $appointment_id
    ];

    $result = $this->query($query, $params);
    return $result ? $result : null;}

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
    public function getAppointmentsByScheduleId($scheduleId){
        $query = "SELECT * FROM $this->table WHERE schedule_id = :schedule_id ";
        $result = $this->query($query, ['schedule_id' => $scheduleId]);
        return $result ? $result : null;
    }

    public function update_status($apptId, $newStatus){
        
        $query = "UPDATE $this->table SET status = :status WHERE appointment_id = :appointment_id";
        $params = [
            'status' => $newStatus,
            'appointment_id' => $apptId
        ];
        $result = $this->query($query, $params);
        return $result ? $result : null;
    }
    public function updateDoctorNotes($apptId, $newNotes){
        
        $query = "UPDATE $this->table SET doctor_notes = :doctor_notes WHERE appointment_id = :appointment_id";
        $params = [
            'doctor_notes' => $newNotes,
            'appointment_id' => $apptId
        ];
        $result = $this->query($query, $params);
        return $result ? $result : null;
    }

    public function getAppointmentById($appointment_id){
        $query = 'SELECT * FROM appointments WHERE appointment_id = :appointment_id';
        $result = $this->query($query, ['appointment_id'=> $appointment_id]);
        return $result ? $result[0] : null;
    }

    public function countAllAppointmentsLastMonth(){
        // $sql = "SELECT COUNT(*) as total FROM $this->table WHERE MONTH(session_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND YEAR(session_date) = YEAR(CURRENT_DATE)";
        $sql = "SELECT COUNT(*) as total FROM $this->table";
        $result = $this->query($sql);
        return $result ? $result[0]->total : 0;
    }
        
}