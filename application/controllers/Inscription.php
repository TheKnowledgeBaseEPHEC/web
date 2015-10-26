<?php

class Inscription extends CI_Controller {

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('inscription');
        $this->load->view('templates/footer');


    }
    public function view (){
        $this->load->view('templates/header');
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required',
            array('required' => 'You must provide a %s.')
        );
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('successInscription');
        }
        else {
            $this->load->view('formsuccess');
        }
        $this->load->view('templates/footer');

    }
}
