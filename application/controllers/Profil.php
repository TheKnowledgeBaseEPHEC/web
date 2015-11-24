<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller
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
        if ($slug != null && strlen($slug)) {
            $udata = $this->Profil_model->getUserData($slug);
            if ($udata != null) {
                $userinfo = (object)array(
                    'nom' => $udata->Nom,
                    'prenom' => $udata->Prenom,
                    'email' => $udata->AdresseMail,
                    'avatar' => $udata->ImagePath,
                    'SQuestion' => null,
                    'id' => $udata->idUser
                );
            } else {
                $this->load->view('header');
                $this->load->view('404');
                $this->load->view('footer');
                return;
            }
        } else {
            $userinfo = (object)array(
                'nom' => $this->session->userdata('user_nom'),
                'prenom' => $this->session->userdata('user_prenom'),
                'email' => $this->session->userdata('user_email'),
                'avatar' => $this->session->userdata('user_avatar'),
                'SQuestion' => null,
                'id' => $this->session->userdata('user_id')
            );
        }
        $data['userslug'] = $slug;
        $data['user'] = $userinfo;
        $data['mesDemandes'] = $this->Demande_model->getMyDemandes($this->session->userdata('user_id'));
        $data['mesPropositions'] = $this->Demande_model->getMyPropositions($this->session->userdata('user_id'));
        $data['mesSeances'] = $this->Demande_model->getMySeances($this->session->userdata('user_id'));
        $data['otherSeances'] = $this->Demande_model->getOtherSeances($this->session->userdata('user_id'));

        $this->load->view('header');
        $this->load->model('rating_model');

        if ($this->logged_in() && $slug === null) {
            $this->load->view("profil_header", $data);
            $this->load->view("profil", $data);
            $idUserRated = $this->session->userdata('user_id');
            $data['ratings'] = $this->rating_model->show_ratings($idUserRated);
        } else if ($this->logged_in()) {
            $this->load->view("profil_header", $data);
            $this->load->view("profil", $data);
            $idUserRated = $this->rating_model->getIdFromSlug($slug);
            $data['ratings'] = $this->rating_model->show_ratings($idUserRated);
            $this->load->view('profil_ratings', $data);
        } else {
            $this->session->set_flashdata('login_error', $this->lang->line('access_not_authorized_please_login'));
            $this->login();
        }
        if ($this->logged_in()) {
            $this->load->view('footer');
        }
    } //end index

    public function edit_profile()
    {
        $userinfo = (object)array(
            'nom' => $this->session->userdata('user_nom'),
            'prenom' => $this->session->userdata('user_prenom'),
            'email' => $this->session->userdata('user_email'),
            'avatar' => $this->session->userdata('user_avatar'),
            'SQuestion' => null,
            'id' => $this->session->userdata('user_id')
        );

        $data['user'] = $userinfo;
        if (!$this->logged_in()) {
            $this->session->set_flashdata('login_error', $this->lang->line('no_access'));
            $this->login();
            return;
        }
        if (!empty($this->input->post('avatar_submit'))) {
            $this->do_upload();
        }

        if (!empty($this->input->post('repScr'))) {
            $this->QstSecr();
        }

        if (!empty($this->input->post('name_submit'))) {
            $this->modifName();
        }

        if (!empty($this->input->post('firstname_submit'))) {
            $this->modifPrenom();
        }

        if (!empty($this->input->post('mail_submit'))) {
            $this->modifMail();
        }

        if (!empty($this->input->post('pwd_submit'))) {
            $this->modifPwd();
        }
        $this->load->view('header');
        $this->load->view('edit_profil', $data);
        $this->load->view('footer');
    }

    public function view($slug = null)
    {
        if ($slug != null) {
            $this->index($slug);
        }
    }

    public function login()
    {
        $this->load->view('header');
        $this->load->view("login");
        $this->load->view('footer');
    }

    public function modifName()
    {

        $this->form_validation->set_rules('name', 'Nom de famille', 'trim|required|min_length[2]');
        if ($this->form_validation->run() == FALSE) {
        } else {
            $newName = $this->input->post('name');
            $this->session->set_userdata('user_nom', $newName);
            $idUser = $this->session->userdata('user_id');
            $this->load->model('Profil_model');
            $this->Profil_model->modifyName($idUser, $newName);
            $this->reload();
        }

    }

    function modifPrenom()
    {
        $this->form_validation->set_rules('prenom', 'Prenom', 'trim|required|min_length[2]');
        if ($this->form_validation->run() == FALSE) {
        } else {
            $newFirstName = $this->input->post('prenom');
            $idUser = $this->session->userdata('user_id');
            $this->load->model('Profil_model');
            $this->Profil_model->modifyFirstName($idUser, $newFirstName);
            $this->reload();
        }
    }

    function modifMail()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('confirmMail', "Confirmation de votre email", 'trim|required|valid_email|matches[email]');
        if ($this->form_validation->run() == FALSE) {
        } else {
            $newMail = $this->input->post('email');
            $this->load->model('Profil_model');
            $idUser = $this->session->userdata('user_id');
            $this->Profil_model->modifyEmail($idUser, $newMail);
            $this->reload();
        }
    }

    function modifPwd()
    {
        $this->form_validation->set_rules('newPwd', 'Mot de passe', 'trim|required|min_length[4]|max_length[64]');
        $this->form_validation->set_rules('confirmNewPwd', 'Confirmation de votre mot de passe', 'trim|required|matches[newPwd]');
        if ($this->form_validation->run() == FALSE) {
        } else {
            $oldPassword = hash('sha512', $this->input->post('oldPwd'));
            $idUser = $this->session->userdata('user_id');
            $this->load->model('Profil_model');
            $pwdDb = $this->Profil_model->recupPwd($idUser);
            if ($oldPassword === $pwdDb) {
                $newPassword = hash('sha512', $this->input->post('newPwd'));
                $this->load->model('Profil_model');
                $this->Profil_model->modifyPwd($idUser, $newPassword);
            } else {
                $this->session->set_flashdata('validation_errors', $this->lang->line('modif_pwd_failed'));
            }
        }
    }

    function QstSecr()
    {
        $this->form_validation->set_rules('repScr', 'Réponse secrète', '|required|');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('validation_errors', $this->lang->line('question_failed'));
        } else {
            $secretQst = $this->input->post('Secret');
            $repscr = $this->input->post('repScr');
            $this->load->model('Profil_model');
            $idUser = $this->session->userdata('user_id');
            $this->Profil_model->modifyQstSecr($idUser, $secretQst, $repscr);
        }
    }

    function do_upload()
    {
        $idUser = $this->session->userdata('user_id');
        $name_file = "AVATAR_" . $idUser;
        $content_dir = './uploads/';
        $config['upload_path'] = $content_dir;
        $config['allowed_types'] = "gif|jpg|png";
        $config['max_size'] = "2048000";
        $config['file_name'] = $name_file;
        $config['overwrite'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $this->session->set_flashdata('upload_error', $this->upload->display_errors());
            return false;
        }

        $image_data = $this->upload->data();

        $extension = $image_data['image_type'];

        // c'est la même
        if ($extension === "jpeg") {
            $extension = "jpg";
        }

        $config = array(
            'image_library' => "gd2",
            'source_image' => $image_data['full_path'],
            'create_thumb' => FALSE,
            'maintain_ratio' => TRUE,
            'width' => "150",
            'height' => "150",
        );

        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }

        $avatarUser = './uploads/' . $name_file . '.' . $extension;

        $this->Profil_model->addImage($avatarUser, $idUser);

        $this->session->set_userdata('user_avatar', $avatarUser);

        return true;
    }

    public function logged_in()
    {
        return !empty($this->session->userdata('user_id'));
    }

    public function reload()
    {
        redirect($this->uri->uri_string());
    }

    /* Utilitaire pour l'admin panel */
    public function data()
    {
        if ($this->logged_in()) {
            $data = array(
                "id" => $this->session->userdata('user_id'),
                "nom" => $this->session->userdata('user_nom'),
                "prenom" => $this->session->userdata('user_prenom'),
                "status" => $this->session->userdata('user_status')
            );
            header('Content-Type: application/json');
            print json_encode($data, JSON_PRETTY_PRINT);
        }
    }

    public function DeleteDemandeAide($idDemandeA)
    {
        $this->Demande_model->DeleteDA($idDemandeA);
    }

    public function DeletePropositionAide($idDemandeA)
    {
        $this->Demande_model->DeletePA($idDemandeA);
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

    public function mes_seances_termines()
    {
        $this->load->model('rating_model');
        $this->load->view("header");
        $idUserRated = $this->session->userdata('user_id');
        $data['seances'] = $this->Demande_model->show_seances($idUserRated);
        $this->load->view("list_my_seances", $data);
        $this->load->view("footer");

    }

    public function mdp_oublie()
    {
        $this->load->view('header');
        if ($this->input->get_post('mail_submit')) {
            $this->load->model('Profil_model');
            $this->load->model('Inscription_model');
            $this->load->helper('email');
            $udata = (object)$this->Profil_model->getUserDataFromEmail($this->input->get_post('email'));
            if (isset($udata->idUser) && strlen($udata->idUser)) {
                $user = (object)array(
                    'nom' => $udata->Nom,
                    'prenom' => $udata->Prenom,
                    'email' => $udata->AdresseMail,
                    'id' => $udata->idUser
                );
                $user->activation_key = $this->Inscription_model->create_activation_key($user);

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

                $data['user'] = $user;

                /* Nouveau mot de passe */
                $data['newMdp'] = uniqid();
                $this->Profil_model->modifyPwd($user->id, hash('sha512', $data['newMdp']));

                $email_msg = $this->load->view('mdp_reset_email', $data, TRUE);
                $subject = $this->lang->line('mdp_reset_email_subject');

                $this->email->from('theknowledgebase2015@gmail.com', 'theknowledgebase.be');
                $this->email->to($user->email);
                $this->email->subject($subject);
                $this->email->message($email_msg);

                if (!$this->email->send()) {
                    $this->email->print_debugger();
                }

                $this->load->view('mdp_oublie_sent');
            } else {
                $data['message'] = $this->lang->line('user_not_found');
                $this->load->view('errors/not_found', $data);
            }
        } else {
            $this->load->view('mdp_oublie');
        }

        $this->load->view('footer');
    }
}