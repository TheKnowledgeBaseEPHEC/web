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

    public function get_data($user_id = NULL)
    {
        //if ($user_id = NULL)
        if ($user_id != NULL)
            $query = $this->db->get_where('User', array('idUser' => $user_id));
        else
            $query = $this->db->get('User');

        return $query->result();
    }
}