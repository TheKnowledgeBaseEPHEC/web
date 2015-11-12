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

    }

    public function index($slug = null)
    {
        if (empty($this->session->userdata('user_id')))
        {
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

        if ($slug != null && strlen($slug)) {
            $udata = $this->Profil_model->getUserData($slug);
            $userinfo = (object)array (
                'nom' => $udata->Nom,
                'prenom' => $udata->Prenom,
                'email' => $udata->AdresseMail,
                'avatar' => $udata->ImagePath,
                'SQuestion' => null,
                'id' => $udata->idUser
            );
        } else {
            $userinfo = (object)array (
                'nom' => $this->session->userdata('user_nom'),
                'prenom' => $this->session->userdata('user_prenom'),
                'email' => $this->session->userdata('user_email'),
                'avatar' => $this->session->userdata('user_avatar'),
                'SQuestion' => null,
                'id' => $this->session->userdata('user_id')
            );
        }


        $data['user'] = $userinfo;
        $this->load->view('header');
        $this->load->view("profil", $data);
        $this->load->view('footer');
    }

    public function view($slug = null) {
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
        if ($this->form_validation->run() == FALSE)
        {
        }
        else
        {
            $newName = $this->input->post('name');
            $idUser = $this->session->userdata('user_id');
            $this->load->model('Profil_model');
            $this->Profil_model->modifyName($idUser, $newName);
        }

    }

    function modifPrenom()
    {
        $this->form_validation->set_rules('prenom', 'Prenom', 'trim|required|min_length[2]');
        if ($this->form_validation->run() == FALSE)
        {
        }
        else
        {
            $newFirstName = $this->input->post('prenom');
            $idUser = $this->session->userdata('user_id');
            $this->load->model('Profil_model');
            $this->Profil_model->modifyFirstName($idUser, $newFirstName);
        }
    }

    function modifMail()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('confirmMail', "Confirmation de votre email", 'trim|required|valid_email|matches[email]');
        if ($this->form_validation->run() == FALSE)
        {
        }
        else {
            $newMail = $this->input->post('email');
            $this->load->model('Profil_model');
            $idUser = $this->session->userdata('user_id');
            $this->Profil_model->modifyEmail($idUser, $newMail);
        }
    }

    function modifPwd()
    {
        $this->form_validation->set_rules('newPwd', 'Mot de passe', 'trim|required|min_length[4]|max_length[64]');
        $this->form_validation->set_rules('confirmNewPwd', 'Confirmation de votre mot de passe', 'trim|required|matches[newPwd]');
        if ($this->form_validation->run() == FALSE)
        {
        }
        else {
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
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('validation_errors', $this->lang->line('question_failed'));
        }
        else {
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
}