<?php
/**
 * Created by PhpStorm.
 * User: youri
 * Date: 11/10/15
 * Time: 21:05
 */
class Rating_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getIdFromSlug($slug)
    {
        $query = $this->db->get_where('User', array('slug' => $slug));
        $row = $query->row();
        return $row->idUser;
    }

    public function show_ratings($userId)
    {
        $query = $this->db->select ('*') ->where('idDemander', $userId) ->where('status', 'FINIE') ->get('Seance',10);
        return $query->result();

    }
}
