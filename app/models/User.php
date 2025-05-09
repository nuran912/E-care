<?php

class User
{
   use Model;

   protected $table = 'users';

   protected $allowedColumns = [
      'user_id',
      'name',
      'title',
      'email',
      'password',
      'phone_number',
      'NIC',
      'role',
      'is_active',
      'created_at',
      'updated_at',
      'profile_pic'
   ];

   public $order_column = 'user_id';

   public function validate($data)
   {
      $this->errors = [];

      if(empty($data['name'])){
         $this->errors['name'] = "Full Name is required";
      }

      //check email (validity)
      if (empty($data['email'])) {
         $this->errors['email'] = "Email is required";
      } else {
         $email = $data['email'];
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email must be a valid email address';
         }
      }

      //check password(vaidity)
      if (empty($data['password'])) {
         $this->errors['password'] = "Password is required";
      } else {
         $password = $data['password'];
         // if (strlen($password) < 8) {
         //    $this->errors['password'] = "Password must be at least 8 characters long";
         // } elseif (!preg_match('/[A-Z]/', $password)) {
         //    $this->errors['password'] = "Password must contain at least one uppercase letter";
         // } elseif (!preg_match('/[a-z]/', $password)) {
         //    $this->errors['password'] = "Password must contain at least one lowercase letter";
         // } elseif (!preg_match('/\d/', $password)) {
         //    $this->errors['password'] = "Password must contain at least one numeric digit";
         // } elseif (!preg_match('/[\W_]/', $password)) {
         //    $this->errors['password'] = "Password must contain at least one special character (e.g., !@#$%^&*)";
         // }
      }

      if (empty($data['phone_number'])) {
         $this->errors['phone_number'] = "Phone number is required";
      } else {
         $phone_number = $data['phone_number'];
         if (!preg_match('/^\d{10}$/', $phone_number)) {
            $this->errors['phone_number'] = "Phone number must be 10 digits long";
         }
      }

      if (empty($data['NIC'])) {
         $this->errors['NIC'] = "NIC number is required";
      } else {
         $NIC = $data['NIC'];
         if (!preg_match('/^\d{9}[vVxX]$|^\d{12}$/', $NIC)) {
            $this->errors['NIC'] = "NIC must be in the format of 9 digits followed by 'V' or 'X', or 12 digits";
         }
      }

      if (empty($data['terms'])) {
         $this->errors['terms'] = "You must agree to the terms and conditions";
      }

      if ($data['password'] !== $data['confirmPassword']) {
         $this->errors['confirmPassword'] = "Passwords do not match";
      }


      if (empty($this->errors)) {
         return true;
      }
      return false;
   }

   //⬇️used to be updateProfile
   public function updateUser($id, $data, $id_column = 'user_id')
   {
      // $password = $data['password'];
      // $newPassword = $data['newPassword'];
      // // $currentPassword = $this->query("SELECT password FROM users WHERE user_id = :user_id", ['user_id' => $id]);
      // $currentPassword = $this->query("SELECT password FROM users WHERE user_id = :user_id", ['user_id' => $id])[0]->password;
      
      // // implement hash password verify from the DB and store the new hashed password in the DB
      // if (!empty($newPassword)) {
      //    if (password_verify($password, $currentPassword)) {
      //       $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
      //    } else {
      //       $_SESSION['edit_error'] = "Current password is incorrect";
      //       return $_SESSION['edit_error'];
      //    }
      // } else {
      //    unset($data['password']);
      // }

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

   public function updateDoctorDetails($id, $data, $id_column = 'id'){
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
   
   public function updateClerkDetails($id, $data, $id_column = 'id'){
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

   public function validateUpdate($data)
   {
      $this->errors = [];


      $email = $data['email'];
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $this->errors['email'] = 'Email must be a valid email address';
      }


      //check password(vaidity)

      $password = $data['password'];
      // if (strlen($password) < 8) {
      //    $this->errors['password'] = "Password must be at least 8 characters long";
      // } elseif (!preg_match('/[A-Z]/', $password)) {
      //    $this->errors['password'] = "Password must contain at least one uppercase letter";
      // } elseif (!preg_match('/[a-z]/', $password)) {
      //    $this->errors['password'] = "Password must contain at least one lowercase letter";
      // } elseif (!preg_match('/\d/', $password)) {
      //    $this->errors['password'] = "Password must contain at least one numeric digit";
      // } elseif (!preg_match('/[\W_]/', $password)) {
      //    $this->errors['password'] = "Password must contain at least one special character (e.g., !@#$%^&*)";
      // }


      if (isset($data['phone_number'])) {
         $phone_number = $data['phone_number'];
         if (!preg_match('/^\d{10}$/', $phone_number)) {
            $this->errors['phone_number'] = "Phone number must be 10 digits long";
         }
      }

      if (isset($data['NIC'])) {
         $NIC = $data['NIC'];
         if (!preg_match('/^\d{9}[vVxX]$|^\d{12}$/', $NIC)) {
            $this->errors['NIC'] = "NIC must be in the format of 9 digits followed by 'V' or 'X', or 12 digits";
         }
      }


      if (array_key_exists('confirmPassword', $data)) {
         if ($data['password'] !== $data['confirmPassword']) {
            $this->errors['confirmPassword'] = "Passwords do not match";
         }
      }



      if (empty($this->errors)) {
         return true;
      }
      return false;
   }

   // ⬇️Nuran
   public function profileValidation($data, $originalData)
   {
      $this->errors = [];

      if ($data['email'] !== $originalData['email'] && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
         $this->errors['email'] = 'Email must be a valid email address.';
      }

      if (!empty($data['phone_number']) && !preg_match('/^\d{10}$/', $data['phone_number'])) {
         $this->errors['phone_number'] = 'Phone number must be 10 digits long.';
      }

      if (!empty($data['NIC']) && !preg_match('/^\d{9}[vVxX]$|^\d{12}$/', $data['NIC'])) {
         $this->errors['NIC'] = "NIC must be in the format of 9 digits followed by 'V' or 'X', or 12 digits.";
      }

      return empty($this->errors) ? true : $this->errors;
   }

   public function passwordValidation($dataToUpdate, $existingPass){

        $dataToUpdate['passUpdateSuccess'] = "";
        
        if(!empty($dataToUpdate['password']) && !empty($dataToUpdate['newpassword'])){
            if($dataToUpdate['password'] == $existingPass){
                $dataToUpdate['password'] = $dataToUpdate['newpassword'];
                unset($dataToUpdate['newpassword']);
                $dataToUpdate['passUpdateStatus'] = true;
                return $dataToUpdate;
            }else{
                unset($dataToUpdate['password']);
                unset($dataToUpdate['newpassword']);
                $dataToUpdate['passUpdateStatus'] = "Current password doesn't match";
                return $dataToUpdate;
            }
          }else{
                unset($dataToUpdate['password']);
                unset($dataToUpdate['newpassword']);
                $dataToUpdate['passUpdateStatus'] = "Enter both current and new passwords to update password";
                return $dataToUpdate;
            }
    }

   public function updatePassword($userId, $data)
   {
      $currentPassword = $this->query("SELECT password FROM $this->table WHERE user_id = :user_id", ['user_id' => $userId])[0]->password;

      if (!password_verify($data['password'], $currentPassword)) {
         return "Current password is incorrect.";
      }

      // if($data['password'] !== $currentPassword){
      //    return "Current password is incorrect.";
      // }
       

      if (empty($data['newPassword']) || strlen($data['newPassword']) < 8) {
         return "New password must be at least 8 characters long.";
      }

      $newPasswordHash = password_hash($data['newPassword'], PASSWORD_DEFAULT);
      $this->query("UPDATE $this->table SET password = :password WHERE user_id = :user_id", [
         'password' => $newPasswordHash,
         'user_id' => $userId
      ]);

      return true;
   }

   public function getUserIDByEmail($email) {
      if(empty($email)) {
         return null;
      }

      $query = "SELECT user_id from $this->table WHERE email = :email";

      $result = $this->query($query,['email' => $email]);

      return json_decode(json_encode($result), true);
   }

   public function getUserNameByEmail($email) {
      if(empty($email)) {
         return null;
      }

      $query = "SELECT name from $this->table WHERE email = :email";

      $result = $this->query($query,['email' => $email]);

      return json_decode(json_encode($result), true);
   }

   public function getProfilePic($user_id) {
      if(empty($user_id)) {
         return null;
      }

      $query = "SELECT profile_pic from $this->table WHERE user_id = :user_id";

      $result = $this->query($query,['user_id' => $user_id]);

      return json_decode(json_encode($result), true);
   }

   public function getLastInsertedDoctorId()
   {
       $query = "SELECT user_id FROM $this->table WHERE role = :role ORDER BY created_at DESC LIMIT 1";
       $result = $this->query($query, ['role' => 'doctor']);
       return $result ? $result[0]->user_id : null;
   }

   public function getAllPatients()
   {
       $query = "SELECT * FROM $this->table WHERE role = :role";
       $result = $this->query($query, ['role' => 'patient']);
       return json_decode(json_encode($result), true);
   }
   
   public function getLastInsertedClerkId()
   {
       $query = "SELECT user_id FROM $this->table WHERE role LIKE '%clerk%' ORDER BY created_at DESC LIMIT 1";
       $result = $this->query($query);
       return $result ? $result[0]->user_id : null;
   }

   public function countAllUsers()
   {
       $query = "SELECT COUNT(*) as total FROM $this->table";
       $result = $this->query($query);
       return $result ? $result[0]->total : 0;
   }
   public function countAllDoctors()
   {
       $query = "SELECT COUNT(*) as total FROM $this->table WHERE role = :role";
       $result = $this->query($query, ['role' => 'doctor']);
       return $result ? $result[0]->total : 0;
   }
   public function countAllClerks()
   {
       $query = "SELECT COUNT(*) as total FROM $this->table WHERE role LIKE '%clerk%'";
       $result = $this->query($query);
       return $result ? $result[0]->total : 0;
   }
   public function getRecent4Patients()
   {
       $query = "SELECT * FROM $this->table WHERE role = :role ORDER BY created_at DESC LIMIT 4";
       $result = $this->query($query, ['role' => 'patient']);
       return json_decode(json_encode($result), true);
   }
   public function emailExists($email){
      $query = "SELECT * FROM $this->table WHERE email = :email";
      $result = $this->query($query, ['email' => $email]);
      return $result ? true : false;
   }
   public function setTokenAndExpiry($email, $token, $expiry){
      $query = "UPDATE $this->table SET token = :token , token_expiry = :token_expiry WHERE email = :email";
      $result = $this->query($query, ['email' => $email, 'token' => $token, 'token_expiry' => $expiry]);
      return $result;
   }
   public function verifyToken($email){
      $query = "SELECT token , token_expiry FROM $this->table WHERE email = :email";
      $result = $this->query($query, ['email' => $email]);
      return $result[0];
   }
   public function updatePass($email, $pass){
      $query = "Update $this->table SET password = :password WHERE email = :email";
      $result = $this->query($query, ['email' => $email, 'password' => $pass]);
   }
}
