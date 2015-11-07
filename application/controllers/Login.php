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
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helpers('common');
    }

    public function index()
    {
        if ($this->is_logged_in()) {
            $this->session->set_flashdata('login_error', $this->lang->line('already_logged_in'));
        } else {
            if (!empty($this->input->post('email'))) {
                $this->login();
            }
        }
        $data = $this;
        $this->load->view('header');
        $this->load->view('login', $data);
        $this->load->view('footer');
    }

    public function welcome()
    {
        $data = $this;
        $this->load->view('header');
        $this->load->view('profil', $data);
        $this->load->view('footer');
    }

    public function login()
    {
        $this->load->model('Login_model', 'logging');
        $email = $this->input->post('email');
        $password = hash('sha512', $this->input->post('password'));
        $login_ok = $this->logging->login($email, $password);

        if ($login_ok) {
            redirect(base_url() . 'profil');
        } else {
            //go_back();
        }
    }

    public function logout()
    {
        logout();
    }

    public function is_logged_in()
    {
        return (!empty($this->session->userdata('user_data')));
    }
}