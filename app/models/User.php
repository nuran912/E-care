<?php

class User {
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
      'updated_at'
   ];

   public $order_column = 'user_id';

   public function validate($data) {
      $this->errors = [];

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

      if(empty($data['terms'])) {
         $this->errors['terms'] = "You must agree to the terms and conditions";
      }

      if($data['password'] !== $data['confirmPassword']) {
         $this->errors['confirmPassword'] = "Passwords do not match";
      }


      if(empty($this->errors)) {
         return true;
      }
      return false;
      
   }
}