<?php

class Signin extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $this->view('header');
        // show($_SESSION);

        $user = new User;
        $data['errors'] = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $arr['email'] = $_POST['email'];

            $row = $user->first($arr);

            if($_POST['email'] == null || $_POST['password'] == null){
                $data['errors'] = "Please enter email and password"; 
            }else{
                if ($row) {
                    if($row->password === $_POST['password'] && $row->is_active == 1) {
                        $_SESSION['USER'] = $row;
                        redirect('home');
                    }
                    // if (password_verify($_POST['password'], $row->password) && $row->is_active == 1) {
                    //     $_SESSION['USER'] = $row;
                    //     redirect('home');
                    // }
                else{
                    //when user enters a valid email but password doesn't match
                    $data['errors'] = "Wrong Email or Password";
                }
            }else{
                //when user enters an invalid email
                $data['errors'] = "Please enter email and password"; 
            }
            }
            if(isset($data['errors'])){
                $_SESSION['error'] = $data['errors'];
            }
        }
        // show($data);
        $this->view('signin', $data);

        $this->view('footer');
    }
}
