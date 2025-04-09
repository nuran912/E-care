<?php
class ClerkModel
{
    use Model;

    protected $table = 'clerks';

    protected $allowedColumns = [
        'emp_id',
        'title',
        'name',
        'user_id',
        'type',
         'email',
         'lab',
        'specialization',
        'hospital',
        'gender',
         'phone_number',
         'is_active',
         'created_at',
         'updated_at'
    ];

    public $order_column = 'emp_id';

    public function getClerkById($emp_id)
    {
        $query = "SELECT * FROM $this->table WHERE emp_id = :emp_id ";
        $result = $this->query($query, ['emp_id' => $emp_id]);
        return $result ? $result[0] : null;
    }

    //get clerk details from clerks table using user_id from users table
    public function getClerkByUserId($user_id)
    {
        $query = "SELECT * FROM $this->table WHERE user_id = :user_id ";
        $result = $this->query($query, ['user_id' => $user_id]);
        return $result ? $result[0] : null;
    }

    public function profileValidation($data, $originalData)
    {
        unset($originalData['password']);
        unset($originalData['newpassword']);
        unset($data['password']);
        unset($data['newpassword']);

        if($data === $originalData){
            return ["No changes made"];
        }

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
       if (empty($this->errors)) {
          return true;
       }
       return $this->errors;
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

    public function getAllClerksWithUserDetails($user_id = null)
    {
        $query = "SELECT clerks.*, users.*, hospitals.name AS hospital, laboratories.name AS lab 
                  FROM $this->table 
                  INNER JOIN users ON clerks.user_id = users.user_id
                  LEFT JOIN hospitals ON clerks.hospital = hospitals.id
                  LEFT JOIN laboratories ON clerks.lab = laboratories.id";
        if ($user_id) {
            $query .= " WHERE clerks.user_id = :user_id";
            $result = $this->query($query, ['user_id' => $user_id]);
        } else {
            $result = $this->query($query);
        }
        return json_decode(json_encode($result), true);
    }
   
}



