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
      $this->view('admin/dashboard');
      $this->view('footer');
   }

   public function profile($a = '', $b = '', $c = '')
   {
      $this->view('header');

      $user = new User;
      $user = $user->first(['user_id' => $_SESSION['USER']->user_id]);
      // show($user);

      $data = [
         'user' => $user
      ];

      if (isset($_SESSION['edit_success'])) {
         $data['edit_success'] = $_SESSION['edit_success'];
         unset($_SESSION['edit_success']);
      }

      if ($a == 'edit') {
         $user = new User;
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_data = $_POST;
            $user_data['user_id'] = $_SESSION['USER']->user_id;
            $user->updateProfile($user_data['user_id'], $user_data, 'user_id');
            if ($user->errors) {
               $data['errors'] = $user->errors;
               // redirect('Admin/profile');
            } else {

               $_SESSION['edit_success'] = 'Profile updated successfully.';
               redirect('Admin/profile');
            }
         }
      }

      if ($a == 'change-password') {
         $user = new User;
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_data = $_POST;
            $user_data['user_id'] = $_SESSION['USER']->user_id;
            $user->updateProfile($user_data['user_id'], $user_data, 'user_id');
            if ($user->errors) {
               $data['errors'] = $user->errors;
               
            } else {
               $_SESSION['edit_success'] = 'Password updated successfully.';
               redirect('Admin/profile');
               // redirect('Admin/profile');
            }
         }
      }
      $this->view('admin/profile', $data);
      $this->view('footer');
   }

   public function user($a = '', $b = '', $c = '')
   {
      $this->view('header');
      $this->view('admin/user');
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

      if($a == 'toggleStatus'){
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $userModel = new User;
            $user = $userModel->first(['user_id' => $userId]);
   
            if ($user) {
               $newStatus = $user->is_active ? 0 : 1;
               $userModel->update($userId, ['is_active' => $newStatus], 'user_id');
            }
         }
         redirect('Admin/doctor');
      }

      if($a == 'resetPassword'){
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $nic = $_POST['nic'];
            $userModel = new User;
            $userModel->update($userId, ['password' => $nic], 'user_id');
            $_SESSION['reset_success'] = 'Password has been reset to the NIC successfully.';
         }
         redirect('Admin/doctor');
      }

      if($a == 'edit'){
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $doctorModel = new DoctorModel;
            $doctorData = [
               'name' => $_POST['name'],
               'specialization' => $_POST['specialization'],
               // 'hospital' => $_POST['hospital'],
               'registration_number' => $_POST['registration_number'],
               'other_qualifications' => $_POST['other_qualifications'],
               'Doctor_fee' => $_POST['doctor_fee'],
               'special_note' => $_POST['special_note'],
               'id' => $_POST['doctor_id']
           ];
           $userData = [
            'email' => $_POST['email'],
            'phone_number' => $_POST['phone_number'],
            'NIC' => $_POST['nic'],
            // 'is_active' => $_POST['is_active'],
            'user_id' => $_POST['user_id']
        ];
            $doctorModel->updateDoctorsWithUserDetails($doctorData, $userData);
            $_SESSION['edit_success'] = 'Doctor details updated successfully.';
            redirect('Admin/doctor');
         }
      }

      $this->view('admin/doctor', $data);
      $this->view('footer');
   }

   public function clerk($a = '', $b = '', $c = '')
   {
      $this->view('header');
      $this->view('admin/clerk');
      $this->view('footer');
   }

   public function insurance($a = '', $b = '', $c = '')
   {
      $this->view('header');
      $this->view('admin/insurance');
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

      if (isset($_SESSION['delete_success'])) {
         $data['delete_success'] = $_SESSION['delete_success'];
         unset($_SESSION['delete_success']);
      }

      if (isset($_SESSION['create_success'])) {
         $data['create_success'] = $_SESSION['create_success'];
         unset($_SESSION['create_success']);
      }

      if (isset($_SESSION['edit_success'])) {
         $data['edit_success'] = $_SESSION['edit_success'];
         unset($_SESSION['edit_success']);
      }

      if ($a == 'create') {
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
            }
         }
      }

      if ($a == 'delete' && !empty($b)) {
         $article = new Article;
         $article->delete($b, 'article_id');
         $_SESSION['delete_success'] = 'Article deleted successfully.';
         redirect('Admin/articles');
      }

      if ($a == 'edit') {
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

}
