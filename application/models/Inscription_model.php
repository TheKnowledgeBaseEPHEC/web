<?php
class Inscription_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data($slug = null)
    {
        {
            if ($slug != NULL)
                $query = $this->db->get_where('User', array('slug' => $slug));
            else
                $query = $this->db->get('User');

            return $query->result();
        }
        /* $this->db->select('Nom, Prenom');
         $this->db->from('user');
         $this->db->where(array('id' => 1));
         $query = $this->db->get();

         $query = $this->db->get('user');
         foreach ($query->result() as $row){
             echo $row->Nom;
         }*/
    }
    public function userLogin ($email, $mdp){
        return $this->db->select('email_user,mdp_user')
            ->from($this->user)
            ->where('Nom', $email)
            ->where('Prenom', $mdp)
            ->get()
            ->result();
    }


}