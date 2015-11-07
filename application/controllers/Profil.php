<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('common');
    }

    // TODO : Si le user est pas logué, montrer msg erreur
    // TODO: voir le profil d'un autre
    public function index() {
        $this->load->view('header');
        $this->load->view("profil");
        $this->load->view('footer');
    }

    public function login() {
        $this->load->view('header');
        $this->load->view("login.php");
        $this->load->view('footer');
    }
}