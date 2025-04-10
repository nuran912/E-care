<?php
class Hospital
{

    use Model;

    protected $table = 'hospitals';

    protected $allowedColumns = [
        'id',
        'name',
        'hospital_fee',
        // 'created_at',
        // 'updated_at',
        'description',
        'services',
        'address',
        'contact',
        'location',
        'working_hours'
    ];

    public $order_column = 'name';

    // public function getHospitalById($hospitalId)
    // {
    //     $query = "SELECT * FROM $this->table WHERE id = :id";
    //     $params = ['id' => $hospitalId];
    //     return $this->query($query, $params, true);
    // }
    public function getHospitalById($id)
    {
      $query = "SELECT * FROM $this->table WHERE id = :id ";
      $result = $this->query($query, ['id' => $id]);
      return $result ? $result[0] : null;
    }
    public function getAll()
    {
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }
    public function getAllHospitals()
    {
        $query = "SELECT * FROM $this->table";
        $result = $this->query($query);
        return json_decode(json_encode($result), true);
    }
}
