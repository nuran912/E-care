<?php

class Signup extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $this->view('header');

        $user = new User;
        $data['errors'] = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($user->validate($_POST)) {
                $user->insert($_POST);
                redirect('signin');
            }
            $data['errors'] = $user->errors;
        }

        $this->view('signup', $data);

        // $this->view('footer');
    }
}
