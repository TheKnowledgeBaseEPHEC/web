<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('not_found'))
{
    function not_found($info) {
        $data['message'] = $info;

        $ci =& get_instance();

        $ci->load->view('templates/header');
        $ci->load->view('errors/not_found', $data);
        $ci->load->view('templates/footer');
    }
}
