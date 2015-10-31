<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inscription_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function login($username,$password)
    {
        $this->db->where("username",$username);
        $this->db->where("password",$password);
        $this->db->from("user");
        $query = $this->db->get();
        if($query->num_rows()>0)
        {
            foreach($query->result() as $rows)
            {
                //add all data to session
                $newdata = array(
                    'id'  => $rows->id,
                    'username'  => $rows->username,
                    'email'    => $rows->email,
                    //'logged_in'  => TRUE,
                );
            }
            $this->session->set_userdata($newdata);
            return true;
        }
        return false;
    }
    public function add_user($username, $email, $password)
    {
        $data=array(
            'username'=>$username,
            'email'=>$email,
            'password'=>md5($password)
        );
        $this->db->insert('user',$data);
    }
}
?>