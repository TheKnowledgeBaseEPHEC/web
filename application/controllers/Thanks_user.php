<?php

class Thanks_user extends CI_Controller
{

    /*
     * Index thanks_user
     */
    public function index()
    {
        $this->load->view('header');
        $this->load->view('thanks_user');
        $this->load->view('footer');
    }
}