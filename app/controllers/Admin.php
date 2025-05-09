<?php
if ($_SESSION['USER']->role != 'admin') {
   redirect('Home');
}
class Admin extends Controller
{

   public function index($a = '', $b = '', $c = '')
   {
      $this->dashboard();
   }

   public function dashboard($a = '', $b = '', $c = '')
   {
      $this->view('header');

      $userModel = new User;
      $userCount = $userModel->countAllUsers();
      $doctorCount = $userModel->countAllDoctors();
      $clerkCount = $userModel->countAllClerks();

      $appointmentModel = new Appointments;
      $appointmentCount = $appointmentModel->countAllAppointmentsLastMonth();

      $articleModel = new Article;
      $articleCount = $articleModel->countAllArticlesLastMonth();

      $hospitalModel = new Hospital;
      $hospitalCount = $hospitalModel->countAllHospitals();
      $labModel = new Laboratory;
      $labCount = $labModel->countAllLabs();

      $doctorModel = new DoctorModel;
      $doctors = $doctorModel->getRecent4Doctors();

      $clerkModel = new ClerkModel;
      $clerks = $clerkModel->getRecent4Clerks();

      $users = $userModel->getRecent4Patients();
      $hospitals = $hospitalModel->getRecent4Hospitals();

      $data = [
         'userCount' => $userCount,
         'doctorCount' => $doctorCount,
         'clerkCount' => $clerkCount,
         'articleCount' => $articleCount,
         'hospitalCount' => $hospitalCount,
         'labCount' => $labCount,
         'appointmentCount' => $appointmentCount,
         'users' => $users,
         'doctors' => $doctors,
         'clerks' => $clerks,
         'hospitals' => $hospitals,

      ];

      $this->view('admin/dashboard', $data);
      $this->view('footer');
   }

   public function profile($a = '', $b = '', $c = '')
   {
      $this->view('header');

      $userModel = new User;
      $user = $userModel->first(['user_id' => $_SESSION['USER']->user_id]);

      $data = ['user' => $user];
      // show($_POST);

      $profilePic = $userModel->getProfilePic($_SESSION['USER']->user_id);

      if (!empty($profilePic) && !empty($profilePic[0]['profile_pic'])) {
         $data['profilePic'] = ROOT . "/assets/profile_pictures/" . htmlspecialchars($_SESSION['USER']->user_id) . "/" . $profilePic[0]['profile_pic'];
      } else {
         $data['profilePic'] = ROOT . "/assets/img/user.svg";
      }

      if ($a == 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
         $userData = $_POST;
         $validationErrors = $userModel->profileValidation($userData, (array)$user);

         if ($validationErrors === true) {
            $updateResult = $userModel->updateUser($user->user_id, $userData, 'user_id');

            $_SESSION['edit_success'] = 'Profile updated successfully.';

            // Unset and reset session with updated user data
            unset($_SESSION['USER']);
            $_SESSION['USER'] = $userModel->first(['user_id' => $user->user_id]);
         } else {
            $_SESSION['validation_errors'] = $validationErrors; // Pass errors to session
         }
         redirect('Admin/profile');
      }

      if ($a == 'change-password' && $_SERVER['REQUEST_METHOD'] === 'POST') {
         $passwordData = $_POST;
         $updateResult = $userModel->updatePassword($user->user_id, $passwordData);

         if ($updateResult === true) {
            $_SESSION['edit_success'] = 'Password updated successfully.';

            // Unset and reset session with updated user data
            unset($_SESSION['USER']);
            $_SESSION['USER'] = $userModel->first(['user_id' => $user->user_id]);
         } else {
            $_SESSION['edit_error'] = $updateResult; // Error message from the model
         }
         redirect('Admin/profile');
      }

      //upload a profile picture
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile-pic'])) {

         $user_id = $_POST['user_id'];

         //target directory
         $targetDir = "assets/profile_pictures/$user_id/";

         //check if the file(profile picture) was uploaded
         if (isset($_FILES['profile-pic']) && $_FILES['profile-pic']['error'] == 0) {
            $filename = basename($_FILES['profile-pic']['name']);
            $targetPath = $targetDir . $filename;

            //check if the target directory exists, if not, create a one
            if (!is_dir($targetDir)) {
               mkdir($targetDir, 0777, true);
            }

            //before uploading, delete the old profile picture
            //fetch the current profile picture from the database
            $currentProfilePic = $userModel->getProfilePic($user_id);
            if (!empty($currentProfilePic) && !empty($currentProfilePic[0]['profile_pic'])) {
               $oldPicPath = $targetDir . $currentProfilePic[0]['profile_pic'];

               //check if the old pic exists and deletes it
               if (file_exists($oldPicPath)) {
                  unlink($oldPicPath);
               }
            }

            //moving the file to the target path
            if (move_uploaded_file($_FILES['profile-pic']['tmp_name'], $targetPath)) {

               //moved successfully
               $userModel->update($user_id, ['profile_pic' => $filename], 'user_id');

               //unset the session variable to remove the old profile picture
               unset($_SESSION['USER']->profile_pic);
               //adding the new profile picture to the session variable
               $_SESSION['USER']->profile_pic = $filename;

               redirect('Admin/profile');
            }
         }
      }


      if (isset($_SESSION['edit_success'])) {
         $data['edit_success'] = $_SESSION['edit_success'];
         unset($_SESSION['edit_success']);
      }
      if (isset($_SESSION['edit_error'])) {
         $data['edit_error'] = $_SESSION['edit_error'];
         unset($_SESSION['edit_error']);
      }

      if (isset($_SESSION['validation_errors'])) {
         $data['validation_errors'] = $_SESSION['validation_errors'];
         unset($_SESSION['validation_errors']);
      }

      $this->view('admin/profile', $data);
      $this->view('footer');
   }

   public function user($a = '', $b = '', $c = '')
   {
      $this->view('header');

      $userModel = new User;
      // $userModel->setLimit(100);
      $users = $userModel->getAllPatients();
      // show($users);
      $data = [
         'users' => $users,
      ];


      if (isset($_SESSION['edit_success'])) {
         $data['edit_success'] = $_SESSION['edit_success'];
         unset($_SESSION['edit_success']);
      }

      if ($a == 'toggleStatus') {
         if (isset($_SESSION['reset_success'])) {
            $data['reset_success'] = $_SESSION['reset_success'];
            unset($_SESSION['reset_success']);
         }
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $userModel = new User;
            $user = $userModel->first(['user_id' => $userId]);

            if ($user) {
               $newStatus = $user->is_active ? 0 : 1;
               $userModel->update($userId, ['is_active' => $newStatus], 'user_id');
               $_SESSION['reset_success'] = 'User status has been updated successfully.';
            }
         }
         redirect('Admin/user');
      }

      if ($a == 'resetPassword') {
         if (isset($_SESSION['reset_success'])) {
            $data['reset_success'] = $_SESSION['reset_success'];
            unset($_SESSION['reset_success']);
         }
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $nic = $_POST['nic'];
            $hashedNic = password_hash($nic, PASSWORD_DEFAULT);
            $userModel = new User;
            $userModel->update($userId, ['password' => $hashedNic], 'user_id');
            $_SESSION['reset_success'] = 'Password has been reset to the NIC successfully.';
         }
         redirect('Admin/user');
      }

      $this->view('admin/user', $data);
      $this->view('footer');
   }

   public function doctor($a = '', $b = '', $c = '')
   {
      $this->view('header');

      $doctorsModel = new DoctorModel;
      $doctors = $doctorsModel->getDoctorsWithUserDetails();
      // show($doctors);

      $data = [
         'doctors' => $doctors
      ];


      if ($a == 'toggleStatus') {
         if (isset($_SESSION['reset_success'])) {
            $data['reset_success'] = $_SESSION['reset_success'];
            unset($_SESSION['reset_success']);
         }
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $userModel = new User;
            $user = $userModel->first(['user_id' => $userId]);

            if ($user) {
               $newStatus = $user->is_active ? 0 : 1;
               $userModel->update($userId, ['is_active' => $newStatus], 'user_id');
               $_SESSION['reset_success'] = 'User status has been updated successfully.';
            }
         }
         redirect('Admin/doctor');
      }

      if ($a == 'resetPassword') {
         if (isset($_SESSION['reset_success'])) {
            $data['reset_success'] = $_SESSION['reset_success'];
            unset($_SESSION['reset_success']);
         }
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $nic = $_POST['nic'];
            $hashedNic = password_hash($nic, PASSWORD_DEFAULT);
            $userModel = new User;
            $userModel->update($userId, ['password' => $hashedNic], 'user_id');
            $_SESSION['reset_success'] = 'Password has been reset to the NIC successfully.';
         }
         redirect('Admin/doctor');
      }

      if ($a == 'edit') {

         if (isset($_SESSION['edit_success'])) {
            $data['edit_success'] = $_SESSION['edit_success'];
            unset($_SESSION['edit_success']);
         }
         if (isset($_SESSION['create_error'])) {
            $data['create_error'] = $_SESSION['create_error'];
            unset($_SESSION['create_error']);
         }
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $doctorModel = new DoctorModel;
            $doctorData = [
               'name' => $_POST['name'],
               'specialization' => $_POST['specialization'],
               // 'hospital' => $_POST['hospital'],
               // 'registration_number' => $_POST['registration_number'],
               'other_qualifications' => $_POST['other_qualifications'],
               'Doctor_fee' => $_POST['doctor_fee'],
               'special_note' => $_POST['special_note'],
               'id' => $_POST['doctor_id']
            ];
            $userData = [
               'user_id' => $_POST['user_id'],
               'name' => $_POST['name'],
               'email' => $_POST['email'],
               'phone_number' => $_POST['phone_number'],
               'NIC' => $_POST['nic'],
               // 'is_active' => $_POST['is_active'],

            ];

            $updatedDoc = $doctorModel->updateDoctorsWithUserDetails($doctorData, $userData);
            if (!$updatedDoc) {
               $_SESSION['edit_success'] = 'Doctor details updated successfully.';
            } else {
               $_SESSION['create_error'] = 'Failed to update doctor details. Please check updated Email.';
            }

            redirect('Admin/doctor');
         }
      }

      if ($a == 'create') {

         if (isset($_SESSION['create_success'])) {
            $data['create_success'] = $_SESSION['create_success'];
            unset($_SESSION['create_success']);
         }
         if (isset($_SESSION['create_error'])) {
            $data['create_error'] = $_SESSION['create_error'];
            unset($_SESSION['create_error']);
         }

         $doctorModel = new DoctorModel;
         $userModel = new User;
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $doctorData = [
               'name' => $_POST['name'],
               'specialization' => $_POST['specialization'],
               'hospital' => rand(1, 3),
               'registration_number' => $_POST['registration_number'],
               'other_qualifications' => $_POST['other_qualifications'],
               'Doctor_fee' => $_POST['doctor_fee'],
               'special_note' => $_POST['special_note'],
               'gender' => $_POST['gender']
            ];
            $userData = [
               'email' => $_POST['email'],
               'role' => 'doctor',
               'title' => 'Mr.',
               'name' => $_POST['name'],
               'password' => $_POST['nic'],
               'phone_number' => $_POST['phone_number'],
               'NIC' => $_POST['nic'],
               'is_active' => 1,
               'created_at' => date('Y-m-d H:i:s'),
               'updated_at' => date('Y-m-d H:i:s')
            ];
            $userData['password'] = password_hash($_POST['nic'], PASSWORD_DEFAULT);

            // Check if the email already exists
            $existingUser = $userModel->first(['email' => $_POST['email']]);
            if ($existingUser) {
               $_SESSION['create_error'] = 'Email already exists. Please use a different email.';
               redirect('Admin/doctor');
            }


            $insertUser = $userModel->insert($userData);
            // handle the case where the user was not inserted successfully
            if (!$insertUser) {
               $userId = $userModel->getLastInsertedDoctorId();
               $doctorData['user_id'] = $userId;
               $doctorModel->insert($doctorData);
               $_SESSION['create_success'] = 'Doctor created successfully.';
               redirect('Admin/doctor');
            } else {
               $_SESSION['create_error'] = 'Failed to create user. Input Valid Information.';
               redirect('Admin/doctor');
            }
         }
      }

      $this->view('admin/doctor', $data);
      $this->view('footer');
   }

   public function clerk($a = '', $b = '', $c = '')
   {
      $this->view('header');

      $clerkModel = new ClerkModel;
      // $clerkModel->setLimit(100);
      $clerks = $clerkModel->getAllClerksWithUserDetails();
      // show($clerks);
      $hospitalModel = new Hospital;
      $hospitals = $hospitalModel->getAllHospitals();

      $labModel = new Laboratory;
      $labs = $labModel->getAllLabs();
      // show($labs);

      $data = [
         'clerks' => $clerks,
         'hospitals' => $hospitals,
         'labs' => $labs
      ];



      if ($a == 'toggleStatus') {
         if (isset($_SESSION['reset_success'])) {
            $data['reset_success'] = $_SESSION['reset_success'];
            unset($_SESSION['reset_success']);
         }
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $userModel = new User;
            $user = $userModel->first(['user_id' => $userId]);

            if ($user) {
               $newStatus = $user->is_active ? 0 : 1;
               $userModel->update($userId, ['is_active' => $newStatus], 'user_id');
               $_SESSION['reset_success'] = 'User status has been updated successfully.';
            }
         }
         redirect('Admin/clerk');
      }

      if ($a == 'resetPassword') {
         if (isset($_SESSION['reset_success'])) {
            $data['reset_success'] = $_SESSION['reset_success'];
            unset($_SESSION['reset_success']);
         }
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $nic = $_POST['nic'];
            $hashedNic = password_hash($nic, PASSWORD_DEFAULT);
            $userModel = new User;
            $userModel->update($userId, ['password' => $hashedNic], 'user_id');
            $_SESSION['reset_success'] = 'Password has been reset to the NIC successfully.';
         }
         redirect('Admin/clerk');
      }

      if ($a == 'create') {

         if (isset($_SESSION['create_success'])) {
            $data['create_success'] = $_SESSION['create_success'];
            unset($_SESSION['create_success']);
         }
         if (isset($_SESSION['create_error'])) {
            $data['create_error'] = $_SESSION['create_error'];
            unset($_SESSION['create_error']);
         }

         $clerkModel = new ClerkModel;;
         $userModel = new User;
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clerkData = [
               'name' => $_POST['name'],
               'type' => $_POST['type'],
               'hospital' => $_POST['hospital'],
               'lab' => $_POST['lab'],
               'emp_id' => $_POST['emp_id']
               // 'gender' => $_POST['gender']
            ];
            $userData = [
               'email' => $_POST['email'],
               'role' => $_POST['type'] . '_clerk',
               // 'title' => 'Dr.',
               'name' => $_POST['name'],
               'password' => $_POST['nic'],
               'phone_number' => $_POST['phone_number'],
               'NIC' => $_POST['nic'],
               'is_active' => 1,
               'created_at' => date('Y-m-d H:i:s'),
               'updated_at' => date('Y-m-d H:i:s')
            ];

            // Check if the email already exists
            $existingUser = $userModel->first(['email' => $_POST['email']]);
            if ($existingUser) {
               $_SESSION['create_error'] = 'Email already exists. Please use a different email.';
               redirect('Admin/doctor');
            }

            $insertUser = $userModel->insert($userData);
            // handle the case where the user was not inserted successfully
            if (!$insertUser) {
               $userId = $userModel->getLastInsertedClerkId();
               $clerkData['user_id'] = $userId;
               $clerkModel->insert($clerkData);
               $_SESSION['create_success'] = 'Clerk created successfully.';
               redirect('Admin/clerk');
            } else {

               $_SESSION['create_error'] = 'Failed to create user. Input Valid Information.';
               redirect('Admin/clerk');
            }
         }
      }

      if ($a == 'edit') {

         if (isset($_SESSION['edit_success'])) {
            $data['edit_success'] = $_SESSION['edit_success'];
            unset($_SESSION['edit_success']);
         }
         if (isset($_SESSION['create_error'])) {
            $data['create_error'] = $_SESSION['create_error'];
            unset($_SESSION['create_error']);
         }

         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clerkModel = new ClerkModel;

            // Set empty 'lab' or 'hospital' values to NULL
            $lab = empty($_POST['lab']) ? null : $_POST['lab'];
            $hospital = empty($_POST['hospital']) ? null : $_POST['hospital'];

            $clerkData = [
               'name' => $_POST['name'],
               'type' => $_POST['type'],
               'hospital' => $hospital,
               'lab' => $lab,
               'emp_id' => $_POST['emp_id']
            ];
            $userData = [
               'email' => $_POST['email'],
               'name' => $_POST['name'],
               'phone_number' => $_POST['phone_number'],
               'NIC' => $_POST['nic'],
               'role' => $_POST['type'] . '_clerk',
               'user_id' => $_POST['user_id']
            ];

            $updateClerk = $clerkModel->updateClerksWithUserDetails($clerkData, $userData);
            if (!$updateClerk) {
               $_SESSION['edit_success'] = 'Clerk details updated successfully.';
               redirect('Admin/clerk');
            } else {
               $_SESSION['create_error'] = 'Failed to update clerk details. Check for updated email.';
               redirect('Admin/clerk');
            }

            
         }
      }

      $this->view('admin/clerk', $data);
      $this->view('footer');
   }

   public function articles($a = '', $b = '', $c = '')
   {
      $this->view('header');

      $articles = new Article;
      $articles->setLimit(100);
      $articles->setOrder('DESC');
      $articles = $articles->findAll();

      $data = [
         'articles' => $articles
      ];



      if ($a == 'create') {
         if (isset($_SESSION['create_success'])) {
            $data['create_success'] = $_SESSION['create_success'];
            unset($_SESSION['create_success']);
         }
         if (isset($_SESSION['create_error'])) {
            $data['create_error'] = $_SESSION['create_error'];
            unset($_SESSION['create_error']);
         }
         

         $article = new Article;
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['article-image']) && $_FILES['article-image']['error'] === UPLOAD_ERR_OK) {
               $image_name = $_FILES['article-image']['name'];
               $target_dir = 'assets/img/articles/';
               $target_file = $target_dir . basename($image_name);

               // Ensure the target directory exists
               if (!is_dir($target_dir)) {
                  mkdir($target_dir, 0777, true);
               }

               if (move_uploaded_file($_FILES['article-image']['tmp_name'], $target_file)) {
                  $_POST['image_url'] = ROOT . '/assets/img/articles/' . $image_name;
                  $_POST['author_id'] = $_SESSION['USER']->user_id;
                  $_POST['publish_date'] = date('Y-m-d');
                  $_POST['views'] = 0;

                  $article->insert($_POST);
                  $_SESSION['create_success'] = 'Article created successfully.';
                  redirect('Admin/articles');
               } else {
                  $_FILES['article-image']['error'] = 'Cannot move uploaded image.';
               }
            } else {
               $_FILES['article-image']['error'] = 'Please select an image to upload.';
               $_SESSION['create_error'] = 'Please select an image to upload.';
               redirect('Admin/articles');
            }
            
         }

      }

      if ($a == 'delete' && !empty($b)) {
         if (isset($_SESSION['create_success'])) {
            $data['create_success'] = $_SESSION['create_success'];
            unset($_SESSION['create_success']);
         }
         $article = new Article;
         $article->delete($b, 'article_id');
         $_SESSION['create_success'] = 'Article deleted successfully.';
         redirect('Admin/articles');
      }

      if ($a == 'edit') {
         if (isset($_SESSION['edit_success'])) {
            $data['edit_success'] = $_SESSION['edit_success'];
            unset($_SESSION['edit_success']);
         }
         if (isset($_SESSION['create_error'])) {
            $data['create_error'] = $_SESSION['create_error'];
            unset($_SESSION['create_error']);
         }
         $article = new Article;
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $article_data = $_POST;

            $existing_article = $article->first(['article_id' => $article_data['article_id']]);

            // show($existing_article->image_url);
            // show($_POST['image_url']);

            if ($existing_article->image_url == $_POST['image_url']) {
               if (isset($_FILES['article-image']) && $_FILES['article-image']['error'] === UPLOAD_ERR_OK) {
                  $image_name = $_FILES['article-image']['name'];
                  $target_dir = 'assets/img/articles/';
                  $target_file = $target_dir . basename($image_name);

                  // Ensure the target directory exists
                  if (!is_dir($target_dir)) {
                     mkdir($target_dir, 0777, true);
                  }

                  if (move_uploaded_file($_FILES['article-image']['tmp_name'], $target_file)) {
                     $article_data['image_url'] = ROOT . '/assets/img/articles/' . $image_name;
                     show($article_data['image_url']);
                  } else {
                     $_FILES['article-image']['error'] = 'Cannot move uploaded image.';
                  }
               } else {
                  $_FILES['article-image']['error'] = 'Please select an image to upload.';
                  // $_SESSION['create_error'] = 'Please select an image to upload.';
                  // redirect('Admin/articles');
               }
            } else {
               $article_data['image_url'] = $_POST['image_url'];
               // show($article_data['image_url']);
            }

            $article->update($article_data['article_id'], $article_data, 'article_id');
            $_SESSION['edit_success'] = 'Article updated successfully.';
            redirect('Admin/articles');
         } else {
            show("Errr");
         }
      }

      $this->view('admin/articles', $data);
      $this->view('footer');
   }

   public function hospitals($a = '', $b = '', $c = '')
   {
      $this->view('header');
      $hospitalModel = new Hospital;
      $hospitals = $hospitalModel->getAllHospitals();
      // show($hospitals);
      $data = [
         'hospitals' => $hospitals
      ];



      if ($a == 'create') {
         if (isset($_SESSION['create_success'])) {
            $data['create_success'] = $_SESSION['create_success'];
            unset($_SESSION['create_success']);
         }
         if (isset($_SESSION['create_error'])) {
            $data['create_error'] = $_SESSION['create_error'];
            unset($_SESSION['create_error']);
         }
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $services = '';
            if (isset($_POST['services']) && is_array($_POST['services'])) {
               foreach ($_POST['services'] as $service) {
                  $services .= '<li>' . htmlspecialchars($service) . '</li>';
               }
            }

            $hospitalData = [
               'name' => $_POST['name'],
               'address' => $_POST['address'],
               'contact' => $_POST['contact'],
               'location' => $_POST['location'],
               'hospital_fee' => $_POST['hospital_fee'],
               'working_hours' => $_POST['working_hours'],
               'description' => $_POST['description'],
               'services' => $services
            ];
            $createHos = $hospitalModel->insert($hospitalData);
            if (!$createHos) {
               $_SESSION['create_success'] = 'Hospital created successfully.';
               redirect('Admin/hospitals');
            } else {
               $_SESSION['create_error'] = 'Failed to create hospital. Input Valid Information.';
               redirect('Admin/hospitals');
            }
         }
      }

      if ($a == 'edit') {
         if (isset($_SESSION['edit_success'])) {
            $data['edit_success'] = $_SESSION['edit_success'];
            unset($_SESSION['edit_success']);
         }
         if (isset($_SESSION['create_error'])) {
            $data['create_error'] = $_SESSION['create_error'];
            unset($_SESSION['create_error']);
         }
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $services = '';
            if (isset($_POST['services']) && is_array($_POST['services'])) {
               foreach ($_POST['services'] as $service) {
                  $services .= '<li>' . htmlspecialchars($service) . '</li>';
               }
            }

            $hospitalData = [
               'name' => $_POST['name'],
               'address' => $_POST['address'],
               'contact' => $_POST['contact'],
               'location' => $_POST['location'],
               'hospital_fee' => $_POST['hospital_fee'],
               'working_hours' => $_POST['working_hours'],
               'description' => $_POST['description'],
               'services' => $services
            ];
            $updateHos = $hospitalModel->update($_POST['id'], $hospitalData, 'id');
            if (!$updateHos) {
               $_SESSION['edit_success'] = 'Hospital updated successfully.';
               redirect('Admin/hospitals');
            } else {
               $_SESSION['create_error'] = 'Failed to update hospital. Input Valid Information.';
               redirect('Admin/hospitals');
            }
         }
      }

      $this->view('admin/hospitals', $data);
      $this->view('footer');
   }

   public function labs($a = '', $b = '', $c = '')
   {
      $this->view('header');
      $labModel = new Laboratory;
      $labs = $labModel->getAllLabs();
      // show($labs);
      $data = [
         'labs' => $labs
      ];


      if ($a == 'create') {
         if (isset($_SESSION['create_success'])) {
            $data['create_success'] = $_SESSION['create_success'];
            unset($_SESSION['create_success']);
         }
         if (isset($_SESSION['create_error'])) {
            $data['create_error'] = $_SESSION['create_error'];
            unset($_SESSION['create_error']);
         }
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $services = '';
            if (isset($_POST['services']) && is_array($_POST['services'])) {
               foreach ($_POST['services'] as $service) {
                  $services .= '<li>' . htmlspecialchars($service) . '</li>';
               }
            }

            $labData = [
               'name' => $_POST['name'],
               'address' => $_POST['address'],
               'contact' => $_POST['contact'],
               'location' => $_POST['location'],
               'lab_fee' => $_POST['lab_fee'],
               'working_hours' => $_POST['working_hours'],
               'description' => $_POST['description'],
               'services' => $services
            ];
            $createLab = $labModel->insert($labData);
            if (!$createLab) {
               $_SESSION['create_success'] = 'Laboratory created successfully.';
               redirect('Admin/labs');
            } else {
               $_SESSION['create_error'] = 'Failed to create laboratory. Input Valid Information.';
               redirect('Admin/labs');
            }
         }
      }

      if ($a == 'edit') {
         if (isset($_SESSION['edit_success'])) {
            $data['edit_success'] = $_SESSION['edit_success'];
            unset($_SESSION['edit_success']);
         }
         if (isset($_SESSION['create_error'])) {
            $data['create_error'] = $_SESSION['create_error'];
            unset($_SESSION['create_error']);
         }
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $services = '';
            if (isset($_POST['services']) && is_array($_POST['services'])) {
               foreach ($_POST['services'] as $service) {
                  $services .= '<li>' . htmlspecialchars($service) . '</li>';
               }
            }

            $labData = [
               'name' => $_POST['name'],
               'address' => $_POST['address'],
               'contact' => $_POST['contact'],
               'location' => $_POST['location'],
               'lab_fee' => $_POST['lab_fee'],
               'working_hours' => $_POST['working_hours'],
               'description' => $_POST['description'],
               'services' => $services
            ];
            $updateLab = $labModel->update($_POST['id'], $labData, 'id');
            if (!$updateLab) {
               $_SESSION['edit_success'] = 'Laboratory updated successfully.';
               redirect('Admin/labs');
            } else {
               $_SESSION['create_error'] = 'Failed to update laboratory. Input Valid Information.';
               redirect('Admin/labs');
            }
         }
      }

      $this->view('admin/labs', $data);
      $this->view('footer');
   }
}
