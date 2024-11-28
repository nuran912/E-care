<?php

class ClerkWorkLog extends Controller{
    public function index(){
        $this->view('header');
        $this->view('clerkWorkLog');
        $this->view('footer');
    }
}