<?php

Trait Database{

   private function connect(){
      $string = "mysql:host=".DBHOST.";dbname=".DBNAME;
      $con = new PDO($string, DBUSER, DBPASS);
      return $con;
   }

   public function query($query, $data = []){
      $con = $this->connect();
      $stmt = $con->prepare($query);
      if (empty($data)) {
         $check = $stmt->execute();
      } else {
         $check = $stmt->execute($data);
      }
      if($check){
         $result = $stmt->fetchAll(PDO::FETCH_OBJ);
         if(is_array($result) && count($result)){
            return $result;
         }
      }
      return false;
   }

   public function get_row($query, $data = []){
      $con = $this->connect();
      $stmt = $con->prepare($query);
      $check = $stmt->execute($data);
      if($check){
         $result = $stmt->fetchAll(PDO::FETCH_OBJ);
         if(is_array($result) && count($result)){
            return $result[0];
         }
      }
      return false;
   }
}


