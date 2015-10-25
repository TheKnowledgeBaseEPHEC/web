<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: youri
 * Date: 25/10/15
 * Time: 21:54
 */
class Helpers
{
    private $ci;

    public function __construct() {
        $this->ci =& get_instance();
    }

    public function not_found($info) {
//        $data['message'] = $info;
//
//
          //return $this->ci->view('templates/header');
//        $CI->view('error/not_found', $data);
//        $CI->view('templates/footer');
    }

}