<?php

/**
 * Created by PhpStorm.
 * User: youri
 * Date: 11/10/15
 * Time: 11:38
 * @property  mod
 */

class Fac extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Fac_model', 'mod');
    }

    public function index()
    {
        $data['ecoles_data'] = $this->mod->get_data();

        $this->load->view('templates/header');
        $this->load->view('fac', $data);
        $this->load->view('templates/footer');
    }

    public function get()
    {
        header('Content-Type: application/json');
        print json_encode($this->mod->get_data(), JSON_PRETTY_PRINT);
    }

    public function view($slug = null)
    {
        $data['fac_data'] = $this->mod->get_data($slug);

        if (empty($data['fac_data'])) {
            $this->ecole_not_found();
            return;
        }

        $this->load->view('templates/header');
        $this->load->view('cours', $data);
        $this->load->view('templates/footer');
    }

    // XXX
    public function ecole_not_found() {
        $this->load->view('templates/header');
        $this->load->view('errors/user_not_found');
        $this->load->view('templates/footer');
    }
}
