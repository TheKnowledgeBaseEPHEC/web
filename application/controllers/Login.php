<?php

/**
 * Created by PhpStorm.
 * User: youri
 * Date: 02/11/15
 * Time: 13:50
 */
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model', 'logging');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helpers('common');
        $this->load->database();
    }

    public function index()
    {
        if ($this->is_logged_in()) {
            redirect(base_url() . 'profil');
        } else {
            if (!empty($this->input->post('email'))) {
                $this->login();
            } else {
                $this->load->view('templates/header');
                $this->load->view('login');
                $this->load->view('templates/footer');
            }
        }
    }

    public function welcome()
    {
        $data = $this;
        $this->load->view('templates/header');
        $this->load->view('profil', $data);
        //echo 'bonjour';
        //echo $this->session->userdata('id');
        $this->load->view('templates/footer');
    }

    public function login_error() {
        $this->load->view('templates/header');
        print 'login error';
        $this->load->view('templates/footer');
    }

    public function login()
    {
        $email = $this->input->post('email');
        $password = hash('sha512', $this->input->post('password'));
        $login_ok = $this->logging->login($email, $password);

        if ($login_ok) {
            redirect(base_url() . 'profil');
        } else {
            $this->login_error();
        }
    }

    public function logout() {
        logout();
    }

    public function is_logged_in()
    {
        return (!empty($this->session->userdata('user_data')));
    }
}