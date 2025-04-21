<?php
class Laboratory
{

    use Model;

    protected $table = 'laboratories';

    protected $allowedColumns = [
        'id',
        'name',
        'hlab_fee',
        'description',
        'services',
        'address',
        'contact',
        'location',
        'working_hours',
        'lab_fee'
    ];

    public $order_column = 'name';

    public function getLaboratoryById($laboratoryId)
    {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $params = ['id' => $laboratoryId];
        return $this->query($query, $params, true);
    }
    public function getAll()
    {
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }
    public function getAllLabs()
    {
        $query = "SELECT * FROM $this->table";
        $result = $this->query($query);
        return json_decode(json_encode($result), true);
    }

    public function countAllLabs()
    {
        $sql = "SELECT COUNT(*) as total FROM $this->table";
        $result = $this->query($sql);
        return $result ? $result[0]->total : 0;
    }
}
