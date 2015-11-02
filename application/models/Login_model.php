<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function login($email, $password)
    {
        $request = $this->db->select("idUser, Nom, Prenom, AdresseMail, Tuteur, Tutoré, slug")
            ->where('AdresseMail', $email)
            ->where('Password', $password)
            ->get('User');
        $row = $request->result();
        if (!empty($row)) {
            // XXX ajouter plus
            $newdata = array(
                'id' => $row[0]->idUser,
                'slug' => $row[0]->slug,
                'email' => $row[0]->AdresseMail,
                'logged_in' => TRUE,
            );
            $this->session->set_userdata('user_data', $newdata);
            return true;
        }
        return false;
    }
}

?>