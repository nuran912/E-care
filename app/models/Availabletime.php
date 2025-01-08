

<?php
class Availabletime
{

    use Model;

    protected $table = 'availabletimes';

    protected $allowedColumns = [
        'id',
        'doctor_id',
        'date',
        'hospital_id',
        'start_time',
        'duration',
        'total_slots',
        'filled_slots',
        'status',
        // 'doctor_fee'
    ];

    public $order_column = 'date';


    public function getByDoctorId($doctorId, $date = null, $hospitalId = null)
    {
        $query = "SELECT * FROM $this->table WHERE doctor_id = :doctor_id";
        $params = ['doctor_id' => $doctorId];

        if ($date) {
            $query .= " AND date = :date";
            $params['date'] = $date;
        }
        if ($hospitalId) {
            $query .= " AND hospital_id = :hospital_id";
            $params['hospital_id'] = $hospitalId;
        }
        return $this->query($query, $params);
    }
    public function getAppointmentDetails($doctorId, $date = null, $hospitalId = null)
    {

        $query = "SELECT 
        at.id AS appointment_id,
        d.id AS doctor_id,
        d.name AS doctor_name,
        d.specialization,
        d.Doctor_fee,
        h.id AS hospital_id,
        h.name AS hospital_name,
        h.hospital_fee,
        at.date AS appointment_date,
        at.start_time,
        at.duration,
        at.total_slots,
        at.filled_slots
    FROM 
        availabletimes at
    JOIN 
        doctors d ON at.doctor_id = d.id
    JOIN 
        hospitals h ON at.hospital_id = h.id
    WHERE 
        d.id = :doctor_id 
        AND (:date IS NULL OR at.date = :date)
        AND (:hospital_id IS NULL OR h.id = :hospital_id);";

        $params = ['doctor_id' => $doctorId, 'date' => $date, 'hospital_id' => $hospitalId];
        return $this->query($query, $params);
    }

    public function getByScheduleId($id)
   {
      $query = "SELECT * FROM $this->table WHERE id = :id ";
      $result = $this->query($query, ['id' => $id]);
      return $result ? $result[0] : null;
   }

    public function update_filled_slots($id)
{
    $query = 'UPDATE availabletimes SET filled_slots =filled_slots - 1 WHERE id = :id';
    $result = $this->query($query, ['id' => $id]);
    return $result ? $result : null;
}

}
?>

