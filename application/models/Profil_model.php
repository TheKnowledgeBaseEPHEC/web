<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function modifyName($idUser, $newName){
        $data = array(
            'Nom' => $newName,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('User', $data);
        $this->session->set_userdata('user_nom', $newName);
    }
    public function modifyFirstName($idUser, $newFirstName){
        $data = array(
            'Prenom' => $newFirstName,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('User', $data);
        $this->session->set_userdata('user_prenom', $newFirstName);
    }
    public function modifyEmail($idUser, $newEmail){
        $data = array(
            'AdresseMail' => $newEmail,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('User', $data);
        $this->session->set_userdata('user_email', $newEmail);
    }

    public function recupPwd($idUser){
        $request = $this->db->select("Password")
            ->where('idUser', $idUser)
            ->get('User');
        $row = $request->row();
        $passwordDb = $row->Password;
        return $passwordDb;
    }
    public function modifyPwd($idUser, $newPassword){
            $data = array(
                'Password' => $newPassword,
            );
            $this->db->where('idUser', $idUser);
            $this->db->update('User', $data);
        }

    public function modifyQstSecr($idUser, $secretQst, $repscr){
        $data = array(
            'SecretQ' => $secretQst,
            'SecretR' => $repscr,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('User', $data);
        $this->session->set_userdata('user_SQuestion', $secretQst);
    }

    public function addImage($avatarUser, $idUser){
        $data = array(
            'ImagePath' => $avatarUser,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('User', $data);
    }

    public function getUserData($slug) {
        return $this->db->select('idUser, Nom, Prenom, AdresseMail, slug, ImagePath')
            ->where('slug', $slug)
            ->get('User')
            ->row();
    }
}