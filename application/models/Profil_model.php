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
        $this->session->set_userdata('user_nom', $newName);
    }
    function modifyFirstName($idUser, $newFirstName){
        $data = array(
            'Prenom' => $newFirstName,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('user', $data);
        $this->session->set_userdata('user_prenom', $newFirstName);
    }
    function modifyEmail($idUser, $newEmail){
        $data = array(
            'AdresseMail' => $newEmail,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('user', $data);
        $this->session->set_userdata('user_email', $newEmail);
    }

    function recupPwd($idUser){
        $request = $this->db->select("Password")
            ->where('idUser', $idUser)
            ->get('User');
        $row = $request->row();
        $passwordDb = $row->Password;
        return $passwordDb;
    }
    function modifyPwd($idUser, $newPassword){
            $data = array(
                'Password' => $newPassword,
            );
            $this->db->where('idUser', $idUser);
            $this->db->update('user', $data);
        }

    function modifyQstSecr($idUser, $secretQst, $repscr){
        $data = array(
            'SecretQ' => $secretQst,
            'SecretR' => $repscr,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('user', $data);
        $this->session->set_userdata('user_SQuestion', $secretQst);
    }

    function addImage($avatarUser, $idUser){
        $data = array(
            'ImagePath' => $avatarUser,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('User', $data);
    }
}