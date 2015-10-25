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
        $this->load->helpers('common_helper');
        $this->load->model('Fac_model', 'fac');
    }

    public function index()
    {
        $data['ecoles_data'] = $this->fac->get_fac();

        $this->load->view('templates/header');
        $this->load->view('fac', $data);
        $this->load->view('templates/footer');
    }

    public function get()
    {
        header('Content-Type: application/json');
        print json_encode($this->fac->get_fac(), JSON_PRETTY_PRINT);
    }

    public function view($slug = null)
    {
        $data['fac_data'] = $this->fac->get_fac($slug);

        if (empty($data['fac_data'])) {
            not_found('Faculté');
            return;
        }

        $this->load->view('templates/header');
        $this->load->view('desc_fac', $data);
        $this->load->view('templates/footer');
    }

    public function cours($slug = null) {
        $data['cours_data'] = $this->fac->get_cours($slug);

        $this->load->view('templates/header');

        if ($slug == null) {
            $this->load->view('cours', $data);
        } else {
            if (empty($data['cours_data'])) {
                not_found('Cours');
                return;
            }
            $this->load->view('desc_cours', $data);
        }

        $this->load->view('templates/footer');
    }
}
