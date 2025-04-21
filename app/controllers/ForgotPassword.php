<?php

require_once dirname(__DIR__) . '/core/EmailHelper.php';

class ForgotPassword extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $this->view('header');

        $user = new User;
        $data['errors'] = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'];
            $subject = "Ecare user password recovery";
            $body = "";
            EmailHelper::sendEmail($email, "", $subject, $body);
        }

        $this->view('forgotPassword', $data);

        $this->view('footer');
    }

    public function recover($a = '', $b = '', $c = ''){
        $this->view('header');
        $data = [];
        $this->view('recoverPassword', $data);
        $this->view('footer');
    }
}
