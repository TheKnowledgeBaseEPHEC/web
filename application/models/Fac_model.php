<?php
/**
 * Created by PhpStorm.
 * User: youri
 * Date: 11/10/15
 * Time: 21:05
 */
class Fac_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_fac($slug = null)
    {
        if ($slug != null) {
            $query = $this->db->get_where('Ecole', array('slug' => $slug));
            return $query->row();
        } else {
            $query = $this->db->get('Ecole');
            return $query->result();
        }
    }

    public function search_fac($term = null) {
        if ($term != null) {
            $this->db->like('NomEcole', $term);
            $query = $this->db->get('Ecole');
            return $query->result();
        }
    }

    public function get_cours($slug = null)
    {
        if ($slug != null) {
            $query = $this->db->get_Where('Cours', array('slug' => $slug));
            return $query->row();
        } else {
            $this->db->select('C.*, E.NomEcole, E.idEcole, E.slug as eslug');
            $this->db->from('Cours as C, Ecole as E');
            $this->db->where('E.idEcole = C.Fac_Ecole_idEcole');
            $query = $this->db->get();
            return $query->result();
        }
    }

    public function interet()
    {
        $data = array(
            'cle' => $key,
            'User_idUser' => $user->id
        );
        $this->db->set('expiration', 'now() + interval 1 week', FALSE);
        $this->db->insert('Activation', $data);
    }
}