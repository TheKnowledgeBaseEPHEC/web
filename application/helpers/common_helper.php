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


if (!function_exists('go_back'))
{
    function go_back() {
        print '<script type="text/javascript">'
            . 'history.go(-1);'
            . '</script>';
    }
}

if (!function_exists('logout'))
{
    /* Délogue et renvoie sur la page d'acceuil */
    function logout() {
        $CI =& get_instance();

        $CI->session->unset_userdata('user_data');
        $CI->session->sess_destroy();

        redirect(base_url());
    }
}