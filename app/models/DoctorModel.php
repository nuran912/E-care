<?php
class DoctorModel
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
    public function getUserDoctorAppointments($user_id)
    {
        return $this->query(
            "SELECT 
                a.appointment_id,
                a.user_id,
                a.status,
                a.schedule_id,
                a.patient_name,
                a.patient_Email,
                a.patient_address,
                a.appointment_number,
                a.hospital_name,
                a.phone_number,
                a.session_time,
                a.session_date,
                a.total_fee,
                a.is_deleted,
                a.payment_status,
                a.service_charge,
                a.selected_files,
                d.name AS doctor_name,
                d.specialization
            FROM 
                appointments a 
            JOIN 
                doctors d 
            ON 
                d.id = a.doctor_id
            WHERE 
                a.user_id = :user_id
            ORDER BY 
                a.session_date ASC",
            ['user_id' => $user_id]
        );
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
 
    //    //check password(vaidity)
    //    if (empty($data['password'])) {
    //       $this->errors['password'] = "Password is required";
    //    } else {
    //       $password = $data['password'];
    //       // if (strlen($password) < 8) {
    //       //    $this->errors['password'] = "Password must be at least 8 characters long";
    //       // } elseif (!preg_match('/[A-Z]/', $password)) {
    //       //    $this->errors['password'] = "Password must contain at least one uppercase letter";
    //       // } elseif (!preg_match('/[a-z]/', $password)) {
    //       //    $this->errors['password'] = "Password must contain at least one lowercase letter";
    //       // } elseif (!preg_match('/\d/', $password)) {
    //       //    $this->errors['password'] = "Password must contain at least one numeric digit";
    //       // } elseif (!preg_match('/[\W_]/', $password)) {
    //       //    $this->errors['password'] = "Password must contain at least one special character (e.g., !@#$%^&*)";
    //       // }
    //    }
 
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
 
    //    if (empty($data['terms'])) {
    //       $this->errors['terms'] = "You must agree to the terms and conditions";
    //    }
 
    //    if ($data['password'] !== $data['confirmPassword']) {
    //       $this->errors['confirmPassword'] = "Passwords do not match";
    //    }
 
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

    public function getDoctorNameById($doctor_id)
    {
        return $this->query(
            "SELECT name FROM doctors WHERE id = :doctor_id",
            ['doctor_id' => $doctor_id]
        );
    }
}



  
