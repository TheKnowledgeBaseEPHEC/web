<?php

class Inscription extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url_helper');
        $this->load->model('Inscription_model', 'inscription');
    }

    public function index()
    {
        $data['user_data'] = $this->inscription->get_data($slug);

        if (empty($data['user_data']))
        {
            $this->user_not_found();
            return;
        }

        $this->load->view('templates/header');
        $this->load->view('inscription', $data);
        $this->load->view('templates/footer');
    }

    public function user_not_found() {
        $this->load->view('templates/header');
        $this->load->view('errors/user_not_found');
        $this->load->view('templates/footer');
    }
}
