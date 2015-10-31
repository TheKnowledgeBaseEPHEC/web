<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper('url');
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
            $this->load->view("user.php", $data);
            $this->load->view('templates/footer');
        }
    }
    public function welcome()
    {
        $data['title']= 'Welcome';
        $this->load->view('templates/header');
        $this->load->view('thanks_user.php', $data);
        $this->load->view('templates/footer');
    }
    public function login()
    {
        $email=$this->input->post('email');
        $password=md5($this->input->post('pass'));

        $result=$this->User_model->login($email,$password);
        if($result) $this->welcome();
        else        $this->index();
    }
    public function thank()
    {
        $data['title']= 'Thank';
        $this->load->view('templates/header');
        $this->load->view('thanks_user', $data);
        $this->load->view('templates/footer');
    }
    public function registration()
    {
       /* $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean');
        $this->form_validation->set_rules('email_address', 'Your Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');
            */
       /* if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {*/
           // $username = $this->input->post('user_name');
            //$email    = $this->input->post('email_address');
            //$password = $this->input->post('password');
        $this->load->view('templates/header');
            print $this->input->post('username');
            print $this->input->post('email');
        $this->load->view('templates/header');
            //$this->User_model->add_user($username, $email, $password);
          //  $this->thank();
        /*}*/
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