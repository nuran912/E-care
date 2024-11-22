<?php
if($_SESSION['USER']->role != 'admin') {
   header('location: ' . ROOT . '/Home');
}  
class Admin extends Controller
{
   
   public function index($a = '', $b = '', $c = '') {
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
      $this->view('admin/profile');
      $this->view('footer');
   }

   public function user($a = '', $b = '', $c = '') {
      $this->view('admin/user');
   }

   public function doctor($a = '', $b = '', $c = '') {
      $this->view('admin/doctor');
   }

   public function clerk($a = '', $b = '', $c = '') {
      $this->view('admin/clerk');
   }

   public function insurance($a = '', $b = '', $c = '') {
      $this->view('admin/insurance');
   }

   public function articles($a = '', $b = '', $c = '') {
      $this->view('admin/articles');
   }
}
