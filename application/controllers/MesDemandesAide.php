<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MesDemandesAide extends CI_Controller
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

    /*
     * Index demande aides
     */
    public function index($slug = null)
    {
        if ($this->logged_in())
        {
            $this->load->view('header');
            $data['Personneaidee'] = $this->Demande_model->getInfoTutore($slug);
            $this->load->view('mesDemandesAide', $data);
            $this->load->view('footer');
            if (!empty($this->input->post('deleteDemAide'))) {
                $this->session->set_flashdata('deleteDA', '<p><b>La demandande a bien été supprimée</b></p>');
                $this->Demande_model->DeleteDA($slug);
                $this->load->view('home');
                redirect(base_url('profil'));
                return;
            }
        } else {
            redirect('profil');
        }
        return;
    }

    /*
     * Affiche un interet
     */
    public function viewSI($idInteret = null) {
        if ($idInteret != null) {
            $this->index($idInteret);
            return;
        }

    }

    /*
     * return : utilisateur identifie
     */
    public function logged_in() {
        return !empty($this->session->userdata('user_id'));
    }
}