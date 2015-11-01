<?php

class Form extends CI_Controller {

    function index()
    {
        $this->load->helper('form');
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        echo $this->input->post('username');
        $this->form_validation->set_rules('username', 'Username', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('myform');
        }
        else
        {
            echo "success" ;
            //$this->load->view('formsuccess');
        }
    }
}
?>