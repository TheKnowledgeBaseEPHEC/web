<?php

/**
 * Created by PhpStorm.
 * User: youri
 * Date: 11/10/15
 * Time: 11:38
 * @property  mod
 */

class Fac extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url_helper');
        $this->load->helpers('common_helper');
        $this->load->model('Fac_model', 'fac');
        $this->load->helper('form');
        $this->load->helper('array');
        $this->load->model('Demande_model');
        $this->load->library('session');
    }

    public function index()
    {
        $data['ecoles_data'] = $this->fac->get_fac();

        $this->load->view('header');
        $this->load->view('fac', $data);
        $this->load->view('footer');
    }

    public function get()
    {
        $q = $this->input->get('q', TRUE);
        header('Content-Type: application/json');
        if (isset($q) && strlen($q)) {
            print json_encode($this->fac->search_fac($q), JSON_PRETTY_PRINT);
        } else {
            print json_encode($this->fac->get_fac(), JSON_PRETTY_PRINT);
        }
    }

    public function view($slug = null)
    {
        $data['fac_data'] = $this->fac->get_fac($slug);

        if (empty($data['fac_data'])) {
            not_found($this->lang->line('fac_not_found'));
            return;
        }

        $this->load->view('header');
        $this->load->view('desc_fac', $data);
        $this->load->view('footer');
    }

    public function logged_in() {
        return !empty($this->session->userdata('user_id'));
    }

    public function cours($slug = null)
    {
        $descriptionP = $this->input->post('descriptionP');
        $remuneration = $this->input->post('remuneration');
        $disponibilitesP = $this->input->post('disponibilitesP');

        $descriptionI = $this->input->post('descriptionI');
        $disponibilitesI = $this->input->post('disponibilitesI');

        $userid = $this->session->userdata('user_id');
        $prenom = $this->session->userdata('user_prenom');
        $nom = $this->session->userdata('user_nom');
        $slugUser =  $this->session->userdata('user_slug');

        $data['cours_data'] = $this->fac->get_cours($slug);

        $this->load->view('header');

        if (!empty($this->input->post('submitP'))) {
            $coursId = $this->Demande_model->recupIdCours($slug);
            if ($this->logged_in()) {
                $this->Demande_model->insertInfoP($descriptionP, $remuneration, $disponibilitesP, $userid, $coursId, $prenom, $nom, $slugUser);
                $this->load->view('home');
                return;
            }else{
                echo "veuillez vous connecter";
            }
        }
        if (!empty($this->input->post('submitProposition'))) {
            $this->load->view('proposition', $data);
            return;
        }

        if (!empty($this->input->post('submitI'))) {
            $coursId = $this->Demande_model->recupIdCours($slug);
            if ($this->logged_in()) {
                $this->Demande_model->insertInfoI($descriptionI, $disponibilitesI, $userid, $coursId, $prenom, $nom, $slugUser);
                $this->load->view('home');
                return;
            } else {
                echo "veuillez vous connecter";
            }
        }

        if (!empty($this->input->post('submitInteret'))) {
            $this->load->view('interet', $data);
            return;
        }

        if (empty($data['cours_data'])) {
            if ($slug == null) {
                not_found($this->lang->line('no_cours'));
            } else {
                not_found($this->lang->line('cours_not_found'));
            }
            return;

        }
        if ($slug == null) {
            $this->load->view('cours', $data);
            return;
        } else {
            $coursId = $this->Demande_model->recupIdCours($slug);
            $data['tutore'] = $this->Demande_model->getTutore($coursId);
            $data['tuteur'] = $this->Demande_model->getTuteur($coursId);

            }
            $this->load->view('desc_cours', $data);
            $this->load->view('footer');
        return;

        }

}
