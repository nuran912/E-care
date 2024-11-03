<?php

class Home extends Controller{
   public function index() {
      // echo "Home Controller";

      $this->view('home');
   }
}

