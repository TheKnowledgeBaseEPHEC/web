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
        $this->load->database();

    }

    public function index()
    {
        if (!empty($this->input->post('avatar_submit'))) {
            $this->do_upload();
        }

        $this->load->view('header');
        $this->load->view("profil");
        $this->load->view('footer');
    }

    public function login()
    {
        $this->load->view('header');
        $this->load->view("login");
        $this->load->view('footer');
    }

    function modifName()
    {
        $newName = $this->input->post('name');
        $idUser = $this->session->userdata('user_id');
        $this->load->model('Profil_model');
        $this->Profil_model->modifyName($idUser, $newName);
        $this->load->view('header');
        $this->load->view("profil");
        $this->load->view('footer');

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

        $avatarUser = '/uploads/' . $name_file . '.' . $extension;

        $this->Profil_model->addImage($avatarUser, $idUser);

        $this->session->set_userdata('user_avatar', $avatarUser);

        return true;
    }
}