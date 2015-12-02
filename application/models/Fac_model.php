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

    /*
     * Récupère une fac sur base de son slug
     */
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

    /*
     * Recherche d'une fac
     */
    public function search_fac($term = null) {
        if ($term != null) {
            $this->db->like('NomEcole', $term);
            $query = $this->db->get('Ecole');
            return $query->result();
        }
        return false;
    }

    /*
     * Récupère un cours sur base de son slug
     */
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

    /*
     * Génère un slug basé sur le nom du cours de la fac
     */
    public function gen_slug($IntituleCours,$Fac_Ecole_idEcole)
    {
        return substr(strtolower($IntituleCours.$Fac_Ecole_idEcole), 0, 20);
    }

    /*
     * Ajout d'un cours
     */
    public function add_cour($data)
    {
        $this->db->insert('Cours', $data);
    }

    /*
     * Récupère l'id d'une école
     */
    public function get_ecole_name($Fac_Ecole_idEcole)
    {
        $query = $this->db->get_where('Ecole', array('idEcole' => $Fac_Ecole_idEcole));
        $row = $query->row();
        return $row->idEcole;
    }
}
