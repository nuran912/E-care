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
        $query = "SELECT * FROM $this->table WHERE id = :id LIMIT 1";
        $result = $this->query($query, ['id' => $doctorId]);
        return $result ? $result[0] : null;
    }
}
