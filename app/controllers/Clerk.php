<?php

if (($_SESSION['USER']->role != 'lab_clerk') && ($_SESSION['USER']->role != 'record_clerk') ) {
    redirect('Home');
}

class Clerk extends Controller{

    public function index($a = '', $b = '', $c = ''){
        $this->profile();
    }

    public function profile($a = '', $b = '', $c = ''){
        //   show($_SESSION['USER']);
        $clerk = new User;
        $data = array($clerk->getById($_SESSION['USER']->user_id));
        // show($data);
        //   $data['error'] = "";
        //   $data['success'] = "";
    
          $this->view('header');
          
          if( $a == 'update'){
              if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $clerk = new User;
                $clerkData = $clerk->getById($_SESSION['USER']->user_id);
    
                $dataToUpdate = $_POST;
                unset($dataToUpdate['empId']);
                show($dataToUpdate);
                if(empty($dataToUpdate['password']) || empty($dataToUpdate['newpassword'])){
                    unset($dataToUpdate['password']);
                    unset($dataToUpdate['newpassword']);
                    $clerk->update($clerkData->user_id, $dataToUpdate, 'user_id');
                    $_SESSION['success'] = "Profile updated successfully";
                  }else if(!empty($dataToUpdate['password']) && !empty($dataToUpdate['newpassword'])){
                    if($dataToUpdate['password'] == $_SESSION['USER']->password){
                        $dataToUpdate['password'] = $dataToUpdate['newpassword'];
                        unset($dataToUpdate['newpassword']);
                        $clerk->update($clerkData->user_id, $dataToUpdate, 'user_id');
                        $_SESSION['success'] = "Profile updated successfully";
                    }
                  }
                  else if(!empty($dataToUpdate['password']) || !empty($dataToUpdate['newpassword'])){
                    $_SESSION['error'] = "Enter current and new passwords to update your password";
                  } else{
                    $_SESSION['error'] == "update failed";
                  }
                  redirect('Clerk/profile');
                }
            }
            // $data['success'] = $_SESSION['success'];
            // $data['error'] = $_SESSION['error'];
        $this->view('Clerk/clerkProfile', $data);
        $this->view('footer');
        }

        public function clerkUploadDoc(){
            $this->view('header');
            $this->view('Clerk/clerkUploadDoc');
            $this->view('footer');
        }

        public function clerkWorkLog(){
            $this->view('header');
            $this->view('Clerk/clerkWorkLog');
            $this->view('footer');
        }

}