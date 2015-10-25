<?php

/**
 * Created by PhpStorm.
 * User: youri
 * Date: 11/10/15
 * Time: 11:38
 * @property  mod
 */

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url_helper');
        $this->load->helpers('common_helper');
        $this->load->model('profile_model', 'profile');
    }

    public function index()
    {
        $data['user_data'] = $this->profile->get_data();

        $this->load->view('templates/header');
        $this->load->view('profile', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL) {
        $data['user_data'] = $this->profile->get_data($slug);

        if (empty($data['user_data']))
        {
            not_found('Utilisateur');
            return;
        }

        $this->load->view('templates/header');
        $this->load->view('profile', $data);
        $this->load->view('templates/footer');
    }

    public function user_not_found() {
        $this->load->view('templates/header');
        $this->load->view('errors/user_not_found');
        $this->load->view('templates/footer');
    }
}
