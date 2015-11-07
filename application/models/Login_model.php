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
        $request = $this->db->select("idUser, Nom, Prenom, AdresseMail, Tuteur, Tutoré, slug, Actif")
            ->where('AdresseMail', $email)
            ->where('Password', $password)
            ->get('User');
        $row = $request->row();

        if (!empty($row)) {
            if (!$row->Actif) {
                $this->session->set_flashdata('login_error', $this->lang->line('not_activated'));
                return false;
            } else {
                $newdata = array(
                    'id' => $row->idUser,
                    'slug' => $row->slug,
                    'nom' => $row->Nom,
                    'prenom' => $row->Prenom,
                    'email' => $row->AdresseMail
                );
                $this->session->set_userdata('user_data', $newdata);
                return true;
            }
        } else {
            $this->session->set_flashdata('login_error', $this->lang->line('login_error'));
            return false;
        }
    }
}

?>