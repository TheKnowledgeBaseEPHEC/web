<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inscription extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inscription_model');
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
            $this->load->view("inscription.php", $data);
            $this->load->view('templates/footer');
        }
    }
    public function welcome()
    {
        $this->load->view('templates/header');
        $this->load->view('profil.php');
        $this->load->view('templates/footer');
    }
    public function login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $result = $this->Inscription_model->login($username, $password);

        if($result){
            $this->welcome();
        }
        else{
            $this->load->view('templates/header');
            $this->load-> view('login.php');
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
        //print $this->input->post('username');
        //print $this->input->post('email');
        $this->load->view('templates/header');
        $username = $this->input->post('username');
        $email    = $this->input->post('email');
        $password = $this->input->post('password');
        $this->Inscription_model->add_user($username, $email, $password);
        $this->load->view('thanks_user.php');
        $this->load->view('templates/footer');

        //  $this->thank();

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