<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Seances extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Profil_model');
        $this->load->library('form_validation');
        $this->load->helpers('common');
        $this->load->database();
        $this->load->model('Demande_model');
        $this->load->model('Profil_seances_model','seance');
    }
    public function index(){

        if (!empty($this->session->userdata('logged_in'))) {
            $this->load->view("header");
            $idUserRated = $this->session->userdata('user_id');
            $data['seances'] = $this->Demande_model->show_seances($idUserRated);
            $this->load->view("list_my_seances", $data);
            $this->load->view("footer");
        } else {
            $this->session->set_flashdata('login_error', $this->lang->line('access_not_authorized_please_login'));
            $this->login();
        }
    }

    public function login()
    {
        $this->load->view('header');
        $this->load->view("login");
        $this->load->view('footer');
    }

    public function mes_ratings()
    {
        $this->load->model('rating_model');
        $this->load->view("header");
        $idUserRated = $this->session->userdata('user_id');
        $data['ratings'] = $this->rating_model->show_ratings($idUserRated);
        //$data['average'] = $this->rating_model->get_avg_rating($idUserRated);
        $this->load->view("list_my_ratings", $data);
        $this->load->view("footer");
    }

}