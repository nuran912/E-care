<?php
class Doctor
{
    use Model;

    protected $table = 'doctors';

    protected $allowedColumns = [
        'id',
        'name',
        'specialization',
        'hospital',
        'gender',
        'registration_number',
        'other_qualifications',
        'special_note',
        'practicing_government_hospitals',
        'Doctor_fee',
        'created_at',
        'updated_at'
    ];

    public $order_column = 'name';

    //search for doctors
    public function search($nameQuery = null, $hospitalQuery = null, $specializationQuery = null, $dateQuery = null)
    {
        $query = "SELECT * FROM doctors WHERE 1=1";
        $data = [];
        if (!empty($nameQuery)) {
            $query .= " AND name LIKE :name";
            $data['name'] = "%$nameQuery%";
        }
        if (!empty($hospitalQuery)) {
            $query .= " AND hospital = :hospital";
            $data['hospital'] = $hospitalQuery;
        }
        if (!empty($specializationQuery)) {
            $query .= " AND specialization = :specialization";
            $data['specialization'] = $specializationQuery;
        }
        if (!empty($dateQuery)) {
            $query .= " AND id IN (SELECT doctor_id FROM availabletimes WHERE date = :date)";
            $data['date'] = $dateQuery;
        }
        return $this->query($query, $data);
    }
     


    
    //get all specializations
    public function getSpecializations()
    {
        $query = "SELECT DISTINCT specialization FROM doctors";
        $result = $this->query($query);
        $specializations = [];
        foreach ($result as $row) {
            $specializations[] =  $row->specialization;
        }
        return $specializations;
    }

    public function getDoctorById($doctorId)
    {
        $query = "SELECT * FROM $this->table WHERE id = :id ";
        $result = $this->query($query, ['id' => $doctorId]);
        return $result ? $result[0] : null;
    }

    //get doctor details from doctors table using user_id from users table
    public function getDoctorByUserId($user_id)
    {
        $query = "SELECT * FROM $this->table WHERE user_id = :user_id ";
        $result = $this->query($query, ['user_id' => $user_id]);
        return $result ? $result[0] : null;
    }

    
  //thie function is used to get the doctor details in pending appointments and past appointments in appointments controller
    public function getDoctorDetails($doctor_id)
    {
        return $this->query(
            "SELECT name, specialization FROM doctors WHERE id = :doctor_id",
            ['doctor_id' => $doctor_id]
        );
    }
// this  function use to get the doctor specialization in appointments controller
    public function getDoctorspecilaization($doctor_id, $user_id){
        return $this->query(
            "SELECT 
                d.name AS doctor_name,
                d.specialization, 
                a.user_id,
                a.status
            FROM 
                doctors d
            JOIN 
                appointments a
            ON 
                d.id = a.doctor_id
            WHERE 
                a.doctor_id = :doctor_id AND a.user_id = :user_id",
            ['doctor_id' => $doctor_id, 'user_id' => $user_id]
        );
    }
    public function getUserDoctorAppointments( $user_id)
    {
        return $this->query(
            "SELECT 
                a.appointment_id,
                a.user_id,
                a.status,
                a.appointment_number,
                a.hospital_name,
                a.phone_number,
                a.session_time,
                a.session_date,
                a.total_fee,
                d.name AS doctor_name,
                d.specialization
            FROM 
              appointments a 
            JOIN 
                  doctors d 
            ON 
                d.id = a.doctor_id
            WHERE 
               a.user_id = :user_id",
            [ 'user_id' => $user_id]
        );
    }
}


  
