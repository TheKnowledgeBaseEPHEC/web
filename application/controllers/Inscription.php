<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inscription extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inscription_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();

    }
    public function index()
    {
        if(($this->session->userdata('user_name')!=""))
        {
            $this->welcome();
        }
        else{
            $data['title']= 'Home';
            $this->load->view('templates/header');
            $this->load->view("inscription", $data);
            $this->load->view('templates/footer');
        }
    }
    public function welcome()
    {
        $this->load->view('templates/header');
        $this->load->view('profil');
        //echo 'bonjour';
        //echo $this->session->userdata('id');
        $this->load->view('templates/footer');
    }
    public function login()
    {
        $username = $this->input->post('username');
        $password = hash('sha512', $this->input->post('password'));
        $result = $this->Inscription_model->login($username, $password);

        if($result){
            $this->welcome();
        }
        else{
            $this->load->view('templates/header');
            $this->load-> view('login');
            $this->load->view('templates/footer');
        }

    }
    /*public function thank()
    {
        $data['title']= 'Thank';
        $this->load->view('templates/header');
        $this->load->view('thanks_user', $data);
        $this->load->view('templates/footer');
    }*/
    public function registration()
    {
        $this->load->helper('form');
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('confirmPassword', 'Password Confirmation', 'trim|required|matches[password]');

        $username = $this->input->post('username');
        $prenom = $this->input->post('prenom');
        $email    = $this->input->post('email');
        $confirmEmail = $this->input->post('confirmEmail');
        $password = $this->input->post('password');
        $confirmPassword = $this->input->post('confirmPassword');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('inscription');
            $this->load->view('templates/footer');
        }
        else
        {

            $this->Inscription_model->add_user($username, $prenom, $email, $password, $confirmEmail, $confirmPassword);
            $this->load->view('templates/header');
            $this->load->view("thanks_user");
            $this->load->view('templates/footer');
        }
    }

    public function sendmail(){
        $verificationCode = random_string('alnum', 20);

        if ( ! isset($_SESSION['email']))
        {
            $email = $this->session->userdata('email');
        }

        $email_msg = "Cher utilisateur,<p-->veuillez cliquer sur le lien ci-dessous pour confirmer votre inscription<p></p>";
        $email_msg .= "http://yourdomain/user/verify/" . $verificationCode;
        $email_msg .= "<p>Thanks,Support Team</p>";
        $subject = "Email Verification";
        $this->load->library('email');
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('simonsabbatini@hotmail.com', 'Support Team');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($email_msg);
        $this->email->send();

        // Insert user record

    }

    function verify($verificationText=NULL) {
        $this->load->model('user_model');
        $noOfRecords = $this->user_model->verifyEmailAddress($verificationText);
        if ($noOfRecords > 0) {
            $this->session->set_flashdata('success', "Email Verified Successfully! Please login below.");
            redirect('user/login');
        } else {
            $this->session->set_flashdata('success', "Sorry! Unable to verify your email. Please try again.");
            redirect('user/login');
        }
}

    public function logout()
    {
        $newdata = array(
            'user_id'   =>'',
            'user_name'  =>'',
            'user_email'     => '',
            'logged_in' => FALSE,
        );
        $this->session->unset_userdata($newdata );
        $this->session->sess_destroy();
        $this->index();
    }
}
?>