<?php

require_once dirname(__DIR__) . '/core/EmailHelper.php';


/*
How the forgot password functionality works:
    - first user enters the email in the forgot password page
    - then this email is verified and the recovery link is sent by email
    - once the user clicks this recovery link, they're redirected to the password recover page]
    - here the token is verified and then the new and confirm passwords are verified
    - finally the new password is set
*/
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
            $_SESSION['emailToBeRecovered'] = $email;
            $emailExist = $user->emailExists($_POST['email']);

            if($emailExist){

                //generate token if the email exists
                $token = bin2hex(random_bytes(32)); // 64-character token
                $expiry = date('Y-m-d H:i:s', strtotime('+10 minutes')); // token expires in 10 min
                $user->setTokenAndExpiry($email, $token, $expiry); 

                $recoveryLink = ROOT."/ForgotPassword/validateToken?token=$token";
                $subject = "Reset Your Password";
                $body = "
                    We received a request to reset your password.<br><br>
                    Click the link below to choose a new password:<br>
                    <a href='$recoveryLink'>$recoveryLink</a><br><br>
                    This link will expire in 10 minutes.<br><br>
                ";

                EmailHelper::sendEmail($email, "", $subject, $body);
                // show($email);
            }else{
                $data['errors'][] = "Email does not exist";
                // show($data['error']);
            }

        }

        $this->view('forgotPassword', $data);

        $this->view('footer');
    }

    //token validation is done here but the new password update is done in the recover function
    public function validateToken($a = '', $b = '', $c = ''){
        $this->view('header');

        $token = $_GET['token'] ?? "";
        // if the token is unavailable, it throws an error
        if (!$token) {
            die('Invalid token.');
        }

        $user = new User;
        $emailToBeRecovered = $_SESSION['emailToBeRecovered'];
        // show($emailToBeRecovered);
        //token verification is checked against the token and the token_expiry stored in the db upon token creation
        $result = $user->verifyToken($emailToBeRecovered);  
        // show($result);
        $dbToken = $result->token;
        $dbTokenExpiry = $result->token_expiry;

        $data['tokenValid'] = false;
        if($token == $dbToken && $dbTokenExpiry > date('Y-m-d H:i:s')){
            $data['tokenValid'] = true;
        }
        
        $this->view('recoverPassword', $data);
        $this->view('footer');
    }
    public function recover($a = '', $b = '', $c = ''){
        $this->view('header');

        $data = [];

        if($_POST['newPassword'] == $_POST['confirmPassword']){

            $newPassword = $_POST['newPassword'];
            
            $user = new User;
            $emailToBeRecovered = $_SESSION['emailToBeRecovered'];
            $user->updatePass($emailToBeRecovered, $newPassword);
            $data['success'] = "Password has been reset successfully";

            redirect('signin');
        }

        $this->view('passwordResetSuccess', $data);
        $this->view('footer');
    }
}
