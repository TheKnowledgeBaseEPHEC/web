<?php

class Testform extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('form');
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('testform');
        $this->load->view('templates/footer');
    }

    public function submit() {
        $this->load->view('templates/header');
        print $this->input->post('username');
        $this->load->view('templates/footer');
    }
}
