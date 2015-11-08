<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
    public function index(){
        $this->load->view('templates/header');
        $this->load->view("profil");
        $this->load->view('templates/footer');
    }
    public function login(){
        $this->load->view('templates/header');
        $this->load->view("login");
        $this->load->view('templates/footer');
    }

    function modifName(){
        $newName = $this->input->post('name');
        $idUser = $this->session->userdata('user_data')['id'];
        $this->load->model('Profil_model');
        $this->Profil_model->modifyName($idUser, $newName);
        $this->load->view('templates/header');
        $this->load->view("profil");
        $this->load->view('templates/footer');

    }
    function do_upload()
    {
        $idUser= $this->session->userdata('user_data')['id'];
        $name_file = "AVATAR_".$idUser;
        $content_dir = './uploads/';
        $config['upload_path'] = $content_dir;
        $config['allowed_types'] = "jpg|png";
        $config['max_size'] = "2048000";
        $config['file_name'] = $name_file;
        $config['overwrite'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload())
        {
            $this->load->view('templates/header');
            $this->load->view('upload_fail');
            $this->load->view('templates/footer');
        } else
        {
            }
            $image_data = $this->upload->data();
            $extension = $image_data['image_type'];
            $config = array (
                'image_library' => "gd2",
                'source_image' => $image_data['full_path'],
                'create_thumb' => FALSE,
                'maintain_ratio' => TRUE,
                'width' => "150",
                'height' => "150",
            );
            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->load->helper('html');
            $image_properties = array (
                'src' => './uploads/'.$name_file.'.'.$extension,
                'alt' => 'erreur de chargement',
                'class' => 'post_image',
                'width' => '200',
                'height' => '200',
                'title' => 'photo avatar',
                'rel' =>'lightbox',
            );
        $this->load->helper('html');
        $avatarUser = './uploads/'.$name_file.'.'.$extension;
        $this->Profil_model->addImage($avatarUser, $idUser);


        $this->load->view('templates/header');
        $this->load->view('profil');
        $this->load->view('templates/footer');
    }
}