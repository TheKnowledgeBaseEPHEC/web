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
        $this->load->library('Helpers', 'helpers');
        $this->load->model('Fac_model', 'fac');
    }

    public function index()
    {
        $data['ecoles_data'] = $this->fac->get_data();

        $this->load->view('templates/header');
        $this->load->view('fac', $data);
        $this->load->view('templates/footer');
    }

    public function get()
    {
        header('Content-Type: application/json');
        print json_encode($this->fac->get_data(), JSON_PRETTY_PRINT);
    }

    public function view($slug = null)
    {
        $data['fac_data'] = $this->fac->get_data($slug);

        if (empty($data['fac_data'])) {
            $this->helpers->not_found('Fac');
            print 'test...';
            return;
        }

        $this->load->view('templates/header');
        $this->load->view('cours', $data);
        $this->load->view('templates/footer');
    }

    public function cours($slug = null) {
        $data['cours_data'] = $this->fac->get_cours($slug);

        if (empty($data['fac_data'])) {
            $this->helpers->not_found('Cours');
            return;
        }

        $this->load->view('templates/header');
        $this->load->view('cours', data);
        $this->load->view('templates/footer');
    }
}
