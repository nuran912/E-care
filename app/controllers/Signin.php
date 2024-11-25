<?php

class Signin extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $this->view('header');

        $user = new User;
        $data['errors'] = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $arr['email'] = $_POST['email'];

            $row = $user->first($arr);

            if ($row) {
                if($row->password === $_POST['password']){
                    $_SESSION['USER'] = $row;
                    redirect('home');
                }
                // if (password_verify($_POST['password'], $row->password)) {
                //     $_SESSION['USER'] = $row;
                //     redirect('home');
                // }
            }
            $user->errors['email'] = "Wrong Email or Password";
            $data['errors'] = $user->errors;
        }

        $this->view('signin', $data);

        // $this->view('footer');
    }
}
