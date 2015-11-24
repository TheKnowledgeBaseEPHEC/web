<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profil_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helpers('common');
    }

    public function modifyName($idUser, $newName)
    {
        $data = array(
            'Nom' => $newName,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('User', $data);
        $this->session->set_userdata('user_nom', $newName);
    }

    public function modifyFirstName($idUser, $newFirstName)
    {
        $data = array(
            'Prenom' => $newFirstName,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('User', $data);
        $this->session->set_userdata('user_prenom', $newFirstName);
    }

    public function modifyEmail($idUser, $newEmail)
    {
        /* Maj en BDD */
        $data = array(
            'AdresseMail' => $newEmail,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('User', $data);

        $this->load->model('Inscription_model');

        $user = (object)array (
          'id' => $idUser
        );

        /* Crée la clé d'activation */
        $key = $this->Inscription_model->create_activation_key($user);

        /* Met le statut en réactivation email */
        $this->updateStatus($user, "reactivation-email");

        /* Envoi de l'email de réactivation */
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

        $user = (object)array(
            'nom' => $this->session->userdata('user_nom'),
            'prenom' => $this->session->userdata('user_prenom')
        );

        $data['user'] = $user;
        $data['activation_key'] = $key;

        $email_msg = $this->load->view('email_update_email', $data, TRUE);
        $subject = $this->lang->line('email_update_email_subject');

        $this->email->from('theknowledgebase2015@gmail.com', 'theknowledgebase.be');
        $this->email->to($newEmail);
        $this->email->subject($subject);
        $this->email->message($email_msg);

        if (!$this->email->send()) {
            $this->email->print_debugger();
        }
        // XXX timer avec message
        logout();
    }

    public function recupPwd($idUser)
    {
        $request = $this->db->select("Password")
            ->where('idUser', $idUser)
            ->get('User');
        $row = $request->row();
        $passwordDb = $row->Password;
        return $passwordDb;
    }

    public function modifyPwd($idUser, $newPassword)
    {
        $data = array(
            'Password' => $newPassword,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('User', $data);
    }

    public function modifyQstSecr($idUser, $secretQst, $repscr)
    {
        $data = array(
            'SecretQ' => $secretQst,
            'SecretR' => $repscr,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('User', $data);
        $this->session->set_userdata('user_SQuestion', $secretQst);
    }

    public function addImage($avatarUser, $idUser)
    {
        $data = array(
            'ImagePath' => $avatarUser,
        );
        $this->db->where('idUser', $idUser);
        $this->db->update('User', $data);
    }

    public function getUserData($slug)
    {
        return $this->db->select('idUser, Nom, Prenom, AdresseMail, slug, ImagePath')
            ->where('slug', $slug)
            ->get('User')
            ->row();
    }

    public function getUserDataFromEmail($email)
    {
        return $this->db->select('idUser, Nom, Prenom, AdresseMail')
            ->where('AdresseMail', $email)
            ->get('User')
            ->row();
    }

    public function updateStatus($user, $status) {
        $this->db->where('idUser', $user->id)
            ->update('User', array('status' => $status));
    }
}