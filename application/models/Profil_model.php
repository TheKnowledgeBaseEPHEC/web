<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function modifyName($idUser, $newName){
        $data = array(
            'Nom' => $newName,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('user', $data);
        $newdata = array(
            'Nom' => $newName,
        );
        $this->session->set_userdata('user_data', $newdata);
    }

    function addImage($avatarUser, $idUser){
        $data = array(
            'ImagePath' => $avatarUser,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('User', $data);
    }
}