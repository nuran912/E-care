<?php

class ClerkUploadDoc extends Controller{
    public function index(){
        $this->view('header');
        $this->view('clerkUploadDoc');
        $this->view('footer');
    }
}