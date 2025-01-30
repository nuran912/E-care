<?php

if (($_SESSION['USER']->role != 'lab_clerk') && ($_SESSION['USER']->role != 'record_clerk') ) {
    redirect('Home');
}

class Clerk extends Controller{

    public function index($a = '', $b = '', $c = ''){
        $this->profile();
    }

    public function profile($a = '', $b = '', $c = ''){
        
        $user = new User;
        $userData = array($user->getById($_SESSION['USER']->user_id));
        $clerk = new ClerkModel;
        $clerkData = array($clerk->getClerkByUserId($_SESSION['USER']->user_id));
        $data = array_merge($userData, $clerkData);
        $data['error'] = [];
        $data['success'] = "";
        $data['status'] = [];
        $data['passUpdateSuccess'] = "";
        $data['passUpdateError'] = "";
        // $_SESSION['updateData'] = [];
        
        $this->view('header');

          if( $a == 'update'){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              
              $clerkData = $clerk->getclerkByUserId($_SESSION['USER']->user_id);
              $userData = $user->getById($_SESSION['USER']->user_id);
  
              $originalProfileInfo = [
                  'name' => $userData->name,
                  'empId' => $clerkData->emp_id,
                  'NIC' => $userData->NIC,
                  'phone_number' => $userData->phone_number,
                  'email' => $userData->email,
              ];
  
              $dataToUpdate = $_POST;
              $passswordToUpdate = array("password"=>$dataToUpdate['password'] , "newpassword"=>$dataToUpdate['newpassword']);
              
              $data['status'] = $clerk->profileValidation($dataToUpdate, $originalProfileInfo);
              
              if(empty($dataToUpdate['password']) && empty($dataToUpdate['newpassword'])){
                  if($data['status'] === true){
                      $clerk->update($clerkData->id, $dataToUpdate, 'emp_id');
                      $user->updateclerkDetails($userData->user_id, $dataToUpdate, 'user_id');
                      $data['success'] = "Profile information updated successfully";
                  }else{
                      $data['error'] = $data['status'];
                  }
              }else{
                  $passswordToUpdate = $clerk->passwordValidation($passswordToUpdate, $userData->password);
                  unset($dataToUpdate['password']);
                  unset($dataToUpdate['newpassword']);
                  if($data['status'] === true){
                      $clerk->update($clerkData->id, $dataToUpdate, 'emp_id');
                      $user->updateclerkDetails($userData->user_id, $dataToUpdate, 'user_id');
                      $data['success'] = "Profile information updated successfully";
                  }else{
                      $data['error'] = $data['status'];
                  }
                  if($passswordToUpdate['passUpdateStatus'] === true){
                      $user->updateclerkDetails($userData->user_id, $passswordToUpdate, 'user_id');
                      $_SESSION['USER']->password = $passswordToUpdate['password'];
                      $data['passUpdateSuccess'] = "Password updated successfully";
                  }else{
                      $data['passUpdateError'] = $passswordToUpdate['passUpdateStatus'];
                  }
              }
              // show($data);
              // redirect('clerk/profile');
              
              }
          }

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