<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ConfirmDemande extends CI_Controller
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

    }

    public function index($slug = null)
    {
        $this->load->view('header');
        $data['personneDA'] = $this->Demande_model->getInfoTuteur($slug);
        $this->load->view('confirmDemande', $data);
        if (!empty($this->input->post('submitDemandeAide'))) {
            if ($this->logged_in()) {
                foreach ($data['personneDA'] as $item) {
                }
                $this->Demande_model->insertSceanceDemande($this->session->userdata('user_id'),$this->session->userdata('user_prenom'), $item->Prenom, $item->idUser, $item->idCours);
            }
        }
        $this->load->view('footer');
        return;
    }
    public function view($idProposition = null) {
        if ($idProposition != null) {
            $this->index($idProposition);
            return;
        }

    }

    public function logged_in() {
        return !empty($this->session->userdata('user_id'));
    }
}