<?php

/**
 * Created by PhpStorm.
 * User: youri
 * Date: 11/10/15
 * Time: 11:38
 * @property  mod
 */

class ListeCours extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('ListeCours_model', 'mod');
    }

    public function index()
    {
        $data['uni_data'] = $this->mod->get_data();

        $this->load->view('templates/header');
        $this->load->view('listecours', $data);
        $this->load->view('templates/footer');
    }

    public function get()
    {
        header('Content-Type: application/json');
        print json_encode($this->mod->get_data(), JSON_PRETTY_PRINT);
    }
}
