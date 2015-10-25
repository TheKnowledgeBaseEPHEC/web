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

    public function get_data($slug = null)
    {
        if ($slug != null) {
            $query = $this->db->get_where('Ecole', array('slug' => $slug));
            return $query->row();
        } else {
            $query = $this->db->get('Ecole');
            return $query->result();
        }
    }

    public function get_cours($slug = null)
    {
        if ($slug != null) {
            $query = $this->db->get_where('Cours', array('slug' => $slug));
            return $query->row();
        } else {
            $query = $this->db->get('Cours');
            return $query->result();
        }
    }
}