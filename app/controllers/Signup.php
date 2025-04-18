<?php

require_once dirname(__DIR__) . '/core/EmailHelper.php';

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
                    
                    $patientemail = $_POST['email'];
                    $patientname = $_POST['name'];
                    $subject = 'Ecare Account Creation Success';
                    $body = "
                        <p>Dear {$patientname},</p>
                        <p>Thank you for registering with Ecare. Your account has been created successfully.</p>
                        <p>You can now log in and start managing your healthcare services with ease.</p>
                        <p>If you have any questions or need assistance, feel free to contact our support team.</p>
                        <br>
                        <p>Best regards,<br>
                        The Ecare Team<br></p>
                    ";
                    EmailHelper::sendEmail($patientemail, $patientname, $subject, $body);
                    
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
