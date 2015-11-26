<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seances_rating extends CI_Controller {

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
        $this->load->model('Seances_model', 'rate');
    }

    public function index($slug = null)
    {
        $slug = intval($slug);
        $data['idSeance'] = $slug;
        if($slug = null){
            $this->load->view('404');
        } /*else {
            if ($this->rate->check_seances_rating_exists($slug) === FALSE){
                $this->load->view('header');
                $this->load->view('404');
                $this->load->view('footer');
            } else {
                $this->load->view('header');
                $this->load->view('rating_do', $data);
                $this->load->view('footer');
            }
        }*/
        else {
            $this->load->view('header');
            $this->load->view('rating_do', $data);
            $this->load->view('footer');
        }
    }


    public function view($slug = null)
    {
        if ($slug != null) {
            $this->index($slug);
        }
    }

    public function check_if_rating_exits($slug)
    {
        $this->rate->check_seances_rating_exists($slug);
    }

    public function submit_rating()
    {
        $idSeance = $this->input->post('idSeance');
        $data = array(
            'comment' => $this->input->post('comment'),
            'rating' => $this->input->post('rating'),
        );
        $this->rate->add_seances_rating($idSeance, $data);
        $this->load->view('header');
        $this->load->view('rating_added');
        $this->load->view('footer');
        $this->output->set_header('refresh:3; /profil/seancesterminees');
    }
}
