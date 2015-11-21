<?php

/**
 * Created by PhpStorm.
 * User: youri
 * Date: 07/11/15
 * Time: 14:43
 */
class Errors extends CI_Controller
{
    public function page_404() {
        $this->load->view('header');
        $this->load->view('404');
        $this->load->view('footer');
    }

}