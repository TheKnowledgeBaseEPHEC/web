<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('header');

        if (!$this->logged_in()) {
            $data['message'] = "Le chat non accessible aux utilisateurs non identifiés.";
            $this->load->view('errors/not_found', $data);
        } else {
            $data['user'] = $this->session->userdata('user_slug');
            $this->load->view('chat', $data);
        }
        $this->load->view('footer');
    }

    public function logged_in() {
        return !empty($this->session->userdata('user_id'));
    }
}