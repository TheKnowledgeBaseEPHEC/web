<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MaSeance extends CI_Controller
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
        $data['maSeance'] = $this->Demande_model->getMyScDP($slug);
        if ($this->logged_in()) {
            foreach ($data['maSeance'] as $item) {
            }
            $this->load->view('maSeance', $data);
            $this->load->view('footer');

            if (!empty($this->input->post('contact')))
            {
                if ($item->idDemander === $this->session->userdata('user_id')) {
                    redirect(base_url('seance/'.$item->idSeance.''));
                }
            }

            if (!empty($this->input->post('priseContact')))
            {
                if ($item->idDemander === $this->session->userdata('user_id')) {
                    redirect(base_url('seance/'.$item->idSeance.''));
                }
            }

            if (!empty($this->input->post('confirmer')))
            {
                $this->Demande_model->confirmDemSc($slug);
                $this->session->set_flashdata('confirmSc', '<p><b>La séance a bien été confirmée</b></p>');
                redirect(base_url('profil'));

            }

            if (!empty($this->input->post('deleteSc')))
            {
                $this->session->set_flashdata('deleteSc', '<p><b>La séance a bien été supprimée</b></p>');
                $this->session->set_flashdata('delete_sc', $this->lang->line('delete_seance'));
                $this->Demande_model->DeleteSc($slug);
                redirect(base_url('profil'));
                return;
            }

            if (!empty($this->input->post('contactMS')))
            {
                if ($item->idDemandeur === $this->session->userdata('user_id')) {
                    redirect(base_url('seance/'.$item->idSeance.''));
                }
            }
            return;
        }
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