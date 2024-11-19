<?php
class Hospital
{

    use Model;

    protected $table = 'hospitals';

    protected $allowedColumns = [
        'id',
        'name',
        'hospital_fee',
        'created_at',
        'updated_at'
    ];

    public $order_column = 'name';

    public function getHospitalById($hospitalId)
    {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $params = ['id' => $hospitalId];
        return $this->query($query, $params, true);
    }
public function getAll()
{
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }
}
