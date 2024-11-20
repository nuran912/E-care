<?php

class Signout extends Controller {
    public function index($a = '', $b = '', $c = '') {
        
      if(!empty($_SESSION['USER'])){
        unset($_SESSION['USER']);
      }
      redirect('home');
    }
}