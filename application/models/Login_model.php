<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /*
     * Fonction de login
     * param: $email, $password
     * return: true si login ok
     */
    public function login($email, $password)
    {
        $request = $this->db->select()
            ->where('AdresseMail', $email)
            ->where('Password', $password)
            ->get('User');
        $row = $request->row();

        if (!empty($row)) {
            if (!$row->Actif) {
                $this->session->set_flashdata('login_error', $this->lang->line('not_activated'));
                return false;
            } else {
                if ($row->status === "reactivation-email") {
                    $this->session->set_flashdata('login_error', $this->lang->line('email_reactivation_login'));
                    return false;
                }
                $this->session->set_userdata('logged_in', 1);
                $this->session->set_userdata('user_id', $row->idUser);
                $this->session->set_userdata('user_slug', $row->slug);
                $this->session->set_userdata('user_nom', $row->Nom);
                $this->session->set_userdata('user_prenom', $row->Prenom);
                $this->session->set_userdata('user_email', $row->AdresseMail);
                $this->session->set_userdata('user_avatar', $row->ImagePath);
                $this->session->set_userdata('user_status', $row->status);

                return true;
            }
        } else {
            $this->session->set_flashdata('login_error',
                $this->lang->line('login_error') . anchor(base_url('mdpoublie'),
                    'Réinitialiser votre mot de passe', 'class="btn btn-block formsubmit"'));
            return false;
        }
    }
}

?>