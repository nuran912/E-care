<?php
trait Model
{
   use Database;

   // protected $table = 'users';
   public $limit = 10;
   protected $offset = 0;
   // public $order_column = 'user_id';
   public $order_type = 'asc';
   public $errors = [];

   public function findAll()
   {
      $query  = "SELECT * FROM $this->table ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
      $result = $this->query($query);
      return json_decode(json_encode($result), true); // Convert object to array
   }

   public function getAll()
   {
      $query  = "SELECT * FROM $this->table ORDER BY $this->order_column $this->order_type";
      $result = $this->query($query);
      return json_decode(json_encode($result), true); // Convert object to array
   }

   public function where($data, $data_not = [])
   {
      $keys = array_keys($data);
      $keys_not = array_keys($data_not);
      $query  = "SELECT * FROM $this->table WHERE ";

      foreach ($keys as $key) {
         $query .= "$key = :$key && ";
      }
      foreach ($keys_not as $key) {
         $query .= "$key != :$key && ";
      }
      $query = rtrim($query, " && ");
      $query .= "ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";

      // echo $query;
      $data = array_merge($data, $data_not);
      $result = $this->query($query, $data);
      return json_decode(json_encode($result), true);
      // Convert object to array
   }

   public function first($data, $data_not = [])
   {
      $keys = array_keys($data);
      $keys_not = array_keys($data_not);
      $query  = "SELECT * FROM $this->table WHERE ";

      foreach ($keys as $key) {
         $query .= "$key = :$key && ";
      }
      foreach ($keys_not as $key) {
         $query .= "$key != :$key && ";
      }
      $query = rtrim($query, " && ");
      $query .= " ORDER BY $this->order_column $this->order_type LIMIT 1";

      $data = array_merge($data, $data_not);

      $result = $this->query($query, $data);
      if ($result) {
         return $result[0];
      }
      return false;
   }

   public function insert($data)
   {

      // remove unvalid columns
      $data = array_intersect_key($data, array_flip($this->allowedColumns));

      $keys = array_keys($data);
      $query = "INSERT INTO $this->table (" . implode(",", $keys) . ") VALUES (:" . implode(",:", $keys) . ")";
      $this->query($query, $data);
      return false;
      // echo $query;
   }

   public function update($id, $data, $id_column = 'id')
   {
      // remove unvalid columns
      $data = array_intersect_key($data, array_flip($this->allowedColumns));

      $keys = array_keys($data);
      $query = "UPDATE $this->table SET ";
      foreach ($keys as $key) {
         $query .= "$key = :$key, ";
      }
      $query = rtrim($query, ", ");
      $query .= " WHERE $id_column = :$id_column";
      $data[$id_column] = $id;
      // echo $query;
      $this->query($query, $data);
      return false;
   }

   public function delete($id, $id_column = 'id')
   {
      $data[$id_column] = $id;
      $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";
      // echo $query;
      $this->query($query, $data);
      return false;
   }

   public function setLimit($limit)
   {
      $this->limit = $limit;
   }

   public function setOrder($order)
   {
      $this->order_type = $order;
   }

   public function getHospitals()
   {
      $query = "SELECT id, name FROM hospitals";
      return $this->query($query);
   }

   public function getSpecializations()
   {
      $query = "SELECT DISTINCT specialization FROM doctors";
      return $this->query($query);
   }

   public function getById($id)
   {
      $query = "SELECT * FROM users WHERE user_id = :user_id ";
      $result = $this->query($query, ['user_id' => $id]);
      return $result ? $result[0] : null;
   }
}
