<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ConfirmAide extends CI_Controller
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

    public function sendmail($adMail, $slug)
    {
        date_default_timezone_set('Europe/Brussels');

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'theknowledgebase2015',
            'smtp_pass' => 'aoien2i3n()_AAAarstoien%BX',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $email_msg = "Quelqu'un a répondu à votre demande d'aide! consultez votre profil!";
        $subject = "Nouvelle demande!";

        $this->email->from('theknowledgebase2015@gmail.com', 'theknowledgebase.be');
        $this->email->to($adMail);
        $this->email->subject($subject);
        $this->email->message($email_msg);

        if (!$this->email->send()) {
            $this->email->print_debugger();
        }
        return true;
    }

    public function index($slug = null)
    {
        if ($this->logged_in())
        {
            $this->load->view('header');
            $data['Personneaidee'] = $this->Demande_model->getInfoTutore($slug);
            $this->load->view('confirmAide', $data);
            if (!empty($this->input->post('submitAide'))) {
                if ($this->logged_in()) {
                    foreach ($data['Personneaidee'] as $item) {
                    }
                    $this->Demande_model->insertSceanceAide($this->session->userdata('user_id'),$this->session->userdata('user_prenom'), $item->Prenom, $item->idUser, $item->idCours);
                    $this->sendmail($item->AdresseMail, $item->slug);
                }
                $this->session->set_flashdata('confirmA', '<p><b>Vous avez créé une nouvelle séance avec cette personne! Vous pouvez y accéder via votre profil.</b></p>');
                redirect(base_url('cours'));
            }
            if (!empty($this->input->post('consProfil'))) {
                foreach ($data['Personneaidee'] as $item) {
                }
                redirect('profil/'.$item->slug.'');
            }
            $this->load->view('footer');
            return;
        }
        else
        {
            redirect(base_url('profil'));
        }
    }
    public function view($idInteret = null) {
        if ($idInteret != null) {
            $this->index($idInteret);
            return;
        }

    }

    public function logged_in() {
        return !empty($this->session->userdata('user_id'));
    }
}