<?php

class Authentication extends CI_Controller {

    public function index() {
        //User display test
        $this->load->model('UserModel');

        //Page content configuration
        $this->load->helper('date');
        $this->load->library('form_validation');
        $this->lang->load('authentication');

        $this->form_validation->set_rules('fldUsername', 'Username', 'required');
        $this->form_validation->set_rules('fldPassword', 'Password', 'trim|required|md5');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('authentication/loginForm');
            $session = $this->session->all_userdata();
            if (isset($session['logged_in']) && $session['logged_in'] == TRUE) {
                redirect('dashboard', 'location');
            }
        } else {
            if ($_POST) {
                $exists = $this->UserModel->check_user();
                $result = $exists->result();
                $count = count($result);
                $user = null;
                $user->fldLevel = null;
                if (!empty($result)) {
                    $user = $result[0];
                }

                if ($count == 1 && $user->fldLevel == 1) {
                    $user = $this->UserModel->user_login();
                    $data['username'] = $user->firstname;
                    $data['success'] = true;
                    $data['message'] = "you've successfully logged in";


                    $newdata = array(
                        'username' => $user->username,
                        'firstname' => $user->firstname,
                        'email' => $user->email,
                        'logged_in' => TRUE
                    );

                    $this->session->set_userdata($newdata);
                    redirect('dashboard', 'location');
                } else if ($count == 1 && $user->fldLevel == 0) {

                    $this->load->helper('security');
                    $authKey = do_hash(time(), 'md5'); // MD5 resetKey

                    $this->UserModel->preResetPassword($user->pkUsername, $authKey);

                    $this->load->library('email');

                    $config['mailtype'] = 'html';

                    $this->email->initialize($config);

                    $this->email->from('Admin@Tasker.AtomicFlowTech.com', 'Tasker - AtomicFlowTech');
                    $this->email->to($user->fldEmail);

                    $this->email->subject(lang('email_new_user_subject'));

                    $message = lang('user_inactive_email_link', array($user->pkUsername / $authKey));

                    $this->email->message($message);

                    $this->email->send();
                    $data['message'] = lang('user_inactive_message');
                    $this->load->view('authentication/loginForm', $data);
                } else {
                    $data['message'] = lang('invalid_user_login');
                    $this->load->view('authentication/loginForm', $data);
                }
            } else {
                $this->load->view('authentication/loginForm');
                $session = $this->session->all_userdata();
                if (isset($session['logged_in']) && $session['logged_in'] == TRUE) {
                    redirect('dashboard', 'location');
                }
            }
        }
    }

//    public function checkLogin() {
//        $this->load->library('encrypt');
//        $this->load->helper('date');
//        $this->load->model('UserModel');
//        $this->lang->load('authentication');
//        //DO encryption and stop tags and such in user model
//        if ($_POST) {
//            $exists = $this->UserModel->check_user();
//            $objArray = get_object_vars($exists);
//            $resultItem = $objArray['num_rows'];
//            if ($resultItem == 1) {
//                $user = $this->UserModel->user_login();
//                $data['username'] = $user->firstname;
//                $data['success'] = true;
//                $data['message'] = "you've successfully logged in";
//
//                $newdata = array(
//                    'username' => $user->username,
//                    'firstname' => $user->firstname,
//                    'email' => $user->email,
//                    'logged_in' => TRUE
//                );
//
//                $this->session->set_userdata($newdata);
//            } else {
//                $data['success'] = false;
//                $data['error'] = "Invalid attempt, please try again";
//            }
//
//            $json = json_encode($data);
//            $result['json'] = $json;
//            $this->load->view('authentication/checkLogin', $result);
//        }
//    }

    public function checkLogout() {
        $newdata = array(
            'logged_in' => FALSE
        );
        $this->session->set_userdata($newdata);
        redirect('/', 'location');
    }

    public function forgot() {
        $this->load->helper('date');
        $this->load->library('form_validation');
        $this->lang->load('authentication');

        $this->form_validation->set_rules('fldEmail', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('authentication/forgot');
        } else {
            $this->load->library('email');
            $this->load->helper('security');
            $this->load->model('UserModel');

            $userExists = $this->UserModel->UserExistsFromEmail(set_value('fldEmail'));

            if (!empty($userExists)) {
                $userExists = $userExists[0];
            }

            if ($userExists) {

                $config['mailtype'] = 'html';

                $this->email->initialize($config);

                //TODO: Update to a Tasker contact email account
                $this->email->from("lucasmp@atomicflowtech.com", "lucasmp");
                $this->email->to(set_value('fldEmail'));


                $resetKey = do_hash(time(), 'md5'); // MD5 resetKey

                $this->UserModel->preResetPassword($userExists->pkUsername, $resetKey);

                $this->email->subject("Tasker - AtomicFlowTech: Forgot Password Confirmation");

                $emailMessage = "Hello $userExists->fldFirstname, It seems you have requested a password change. Your last login date was $userExists->fldLastLoggedIn. If this request is correct please click this link: " . anchor("authentication/resetPassword/$userExists->pkUsername/$resetKey", "Reset Password", "");

                $this->email->message($emailMessage);

                $this->email->send();
                $data['message'] = "Email Sent!";
            } else {
                $data['message'] = "Sorry, No user found with that email. " . anchor("authentication/forgot", "Please Try Again", "");
            }

            $this->load->view('authentication/emailSent', $data);
        }
    }

    public function resetPassword($username = null, $resetKey = null) {
        $this->load->model('UserModel');
        $this->load->library('form_validation');
        $this->lang->load('authentication');

        $this->form_validation->set_rules('fldUsername', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('fldPassword1', 'Password', 'trim|required|matches[fldPassword2]|md5');
        $this->form_validation->set_rules('fldPassword2', 'Password Confirmation', 'trim|required');

        $validResetRequest = 0;

        if ($username != null && $resetKey != null) {
            $validResetRequest = $this->UserModel->confirmAuthKey($username, $resetKey);
        }

        if ($validResetRequest) {
            if ($this->form_validation->run() == FALSE) {
                $data['username'] = $username;
                $data['resetKey'] = $resetKey;
                $this->load->view('authentication/resetPassword', $data);
            } else {
                $this->UserModel->resetPassword();
                $data['message'] = "Your password has been reset. How about " . anchor(base_url(), "logging in?", "");
                $this->load->view('authentication/passwordChanged', $data);
            }
        } else {
            $data['message'] = "Sorry - User and request key don't match up. Try again";
            $this->load->view('authentication/forgot', $data);
        }
    }

    public function signUp() {
        $this->load->model('UserModel');
        $this->load->library('form_validation');
        $this->lang->load('authentication');

        $this->form_validation->set_rules('fldFirstname', 'First Name', 'trim|required|alpha|xss_clean');
        $this->form_validation->set_rules('fldLastname', 'Last Name', 'trim|required|alpha|xss_clean');
        $this->form_validation->set_rules('fldEmail', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('fldUsername', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('fldPassword1', 'Password', 'trim|required|matches[fldPassword2]|md5');
        $this->form_validation->set_rules('fldPassword2', 'Password Confirmation', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('authentication/signUp');
        } else {
            $exists = $this->UserModel->check_user_registration();
            if ($exists->num_rows() == 0) {
                $user = $this->UserModel->insert_user();

                $this->load->library('email');

                $config['mailtype'] = 'html';

                $this->email->initialize($config);

                $this->email->from('Admin@Tasker.AtomicFlowTech.com', 'Tasker - AtomicFlowTech');
                $this->email->to(set_value('fldEmail'));

                $this->email->subject("Tasker - AtomicFlowTech: Confirm New User");

                $message = "Your account has been created! All you have to do is click on the link below to activate your account!</br>" . anchor("authentication/activateUser/$user->username/$user->authKey", "Click here to activate your account", "");

                $this->email->message($message);

                $this->email->send();
                $data['message'] = "You Have successfully created your account! Check your email for the activation link -> then log in!";
            } else {
                $data['message'] = "Username or Email already in use.";
            }
            $this->load->view('authentication/accountCreated', $data);
        }
    }

    public function activateUser($username=null, $authkey=null) {

        $this->load->model('UserModel');
        $this->lang->load('authentication');

        $validActivateRequest = 0;

        if ($username != null && $authkey != null) {
            $validActivateRequest = $this->UserModel->confirmAuthKey($username, $authkey);
        }

        if ($validActivateRequest) {
            $this->UserModel->setAccountActive($username);
            $data['message'] = "Congratulations, your account has been activated. " . anchor("authentication", "Please Login.", '');
        } else {
            $data['message'] = "Sorry, The link you used doesnt seem to be right, " . anchor('authentication', 'please try again', '');
        }
        $this->load->view('authentication/accountCreated', $data);
    }

}

?>