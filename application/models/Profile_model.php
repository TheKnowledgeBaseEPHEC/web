<?php
/**
 * Created by PhpStorm.
 * User: youri
 * Date: 11/10/15
 * Time: 21:05
 */
class Profile_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data($slug = NULL)
    {
        if ($slug != NULL)
            $query = $this->db->get_where('User', array('slug' => $slug));
        else
            $query = $this->db->get('User');

        return $query->result();
    }
}