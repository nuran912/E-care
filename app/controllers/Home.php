<?php

class Home extends Controller{
   public function index() {

      // $model = new Model;
      
      // $arr['user_id'] = 1;
      // $arr['name'] = 'John Doe';
      // $arr2['is_active'] = 0;
      // $result = $model->where($arr,$arr2);

   //    $arr = [
   //       // 'user_id' => 5,
   //       'name' => 'Michael Johnson',
   //       'email' => 'michael.johnson@example.com',
   //       'password' => 'hashedpassword5',
   //       'phone_number' => '321-654-0987',
   //       'NIC' => '556677889V',
   //       'role' => 'reception_clerk',
   //       'is_active' => true,
   //       // 'created_at' => '2024-11-04 14:45:00',
   //       // 'updated_at' => '2024-11-04 14:45:00'
   //   ];
   //    $result = $model->insert($arr);

      
      // $result = $model->delete(5, 'user_id');

      // $arr = [
      //    'name' => 'Michael John',
      //    'password' => 'hashpass7'
      // ];
      // $result = $model->update(7, $arr, 'user_id');

      $user = new User;
      $result = $user->where(['user_id' => 1]);
      show($result);

      // echo "Home Controller";

      $this->view('home');
   }
}

