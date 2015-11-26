<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MesPropAide extends CI_Controller
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
        if ($this->logged_in())
        {

            $this->load->view('header');
            $data['Personneaide'] = $this->Demande_model->getInfoTuteur($slug);
            $this->load->view('mesPropAide', $data);
            $this->load->view('footer');
            if (!empty($this->input->post('deletePropAide'))) {
                $this->session->set_flashdata('deletePA', '<p><b>La proposition a bien été supprimée</b></p>');
                $this->Demande_model->DeletePA($slug);
                $this->load->view('home');
                redirect(base_url('profil'));
                return;
            }

        } else
        {
            redirect('profil');
        }
        return;
    }

    public function viewSI($idInteret = null) {
        if ($idInteret != null) {
            $this->index($idInteret);
            return;
        }

    }

    public function logged_in() {
        return !empty($this->session->userdata('user_id'));
    }
}