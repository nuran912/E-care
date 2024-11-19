use Model;

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
        'filled_slots'
    ];

    public $order_column = 'date';


    public function getByDoctorId($doctorId,$date=null,$hospitalId=null)
    {
        $query = "SELECT * FROM $this->table WHERE doctor_id = :doctor_id";
        $params = ['doctor_id' => $doctorId];

        if($date){
            $query .= " AND date = :date";
            $params['date'] = $date;
        }
        if($hospitalId){
            $query .= " AND hospital_id = :hospital_id";
            $params['hospital_id'] = $hospitalId;
        }
        return $this->query($query, $params);
    }
    
}
?>