<?php

class Signup extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $this->view('header');

        $user = new User;
        $data['errors'] = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if ($user->validate($_POST)) {
                    $user->insert($_POST);
                    redirect('signin');
                } else {
                    $data['errors'] = $user->errors;
                }
            } catch (Exception $e) {
                if ($e->getCode() == 23000) { // Duplicate entry error code
                    $data['errors'][] = "User details already exist";
                } else {
                    $data['errors'][] = $e->getMessage();
                }
            }
        }

        $this->view('signup', $data);

        // $this->view('footer');
    }
}
