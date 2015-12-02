<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seances_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*
     * Ajoute un rating à une séance en BDD
     */
    public function add_seances_rating($id, $data){
        $this->db->where('idSeance', $id);
        $this->db->update('Seance', $data);

    }

    /*
     * Vérifie si un rating existe pour une séance
     */
    public function check_seances_rating_exists($id){
        $query = $this->db->select('*')
            ->from('Seance')
            ->where('idSeance', $id)
            ->where('comment', NULL)
            ->get();
        if ($query->num_rows() > 0){
            return TRUE;
        } else {
            return FALSE;
        }
    }

}