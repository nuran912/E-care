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

            $user = new User;
            $email = $_POST['email'];
            $emailExist = $user->emailExists($_POST['email']);

            if($emailExist){

                //generate token if the email exists
                $token = bin2hex(random_bytes(32)); // 64-character token
                $expiry = date('Y-m-d H:i:s', strtotime('+10 minutes')); // token expires in 10 min
                show($email);
                show($token);
                show($expiry);
                $result = $user->setTokenAndExpiry($email, $token, $expiry); 
                if($result){
                    show("done");
                }

                $subject = "Ecare user password recovery";
                $body = "";
                // EmailHelper::sendEmail($email, "", $subject, $body);
                // show($email);
            }else{
                $data['errors'][] = "Email does not exist";
                // show($data['error']);
            }

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
