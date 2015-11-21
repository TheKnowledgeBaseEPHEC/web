<?php
/**
 * Created by PhpStorm.
 * User: youri
 * Date: 11/10/15
 * Time: 21:05
 */
class Home_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data() {
        $this->db->select('COUNT(distinct User.idUser) AS nbusers, COUNT(distinct Cours.idCours) AS nbcours, COUNT(distinct Ecole.idEcole) AS nbfacs');
        $this->db->from('User, Cours, Ecole');
        $query = $this->db->get();
        return $query->result();
    }
}