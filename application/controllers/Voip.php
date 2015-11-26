<?php

class Voip extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
    }

    public function view($seanceId = null) {
        if (!$this->logged_in()) {
            redirect(base_url('connexion'));
        }

        $this->load->view('header');

        $this->load->model('Demande_model');
        $sId = $this->Demande_model->getMySeancesFromId($seanceId);
        if ($sId === null || empty($sId)) {
            $data['message'] = 'Séance non trouvée';
            $this->load->view('errors/not_found', $data);
        } else {
            $data['seance'] = $sId->idSeance;
            $data['user'] = $this->session->userdata('user_slug');
            $this->load->view('voip', $data);
        }

        $this->load->view('footer');
    }

    public function logged_in()
    {
        return !empty($this->session->userdata('user_id'));
    }
}
