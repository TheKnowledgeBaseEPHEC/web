<?php

/**
 * Created by PhpStorm.
 * User: youri
 * Date: 06/11/15
 * Time: 17:49
 */
class User extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function get_data()
    {
        $data = $this->session->get_userdata('user_data');
        if (!empty($data)) {
            header('Content-Type: application/json');
            print json_encode($data, JSON_PRETTY_PRINT);
        }
    }
}