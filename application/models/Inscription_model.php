<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inscription_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    function login($username)
    {

        $this->db->select("*");
        $this->db->where("Nom",$username);
        //$this->db->where("Password",$password);
        $this->db->from("User");
        $query=$this->db->get();
        //$query = $this->db->get();
        //var_dump($query);
        //print_r($query);
        if($query->num_rows()>0)
        {
            foreach($query->result() as $rows)
            {
                //add all data to session
                $newdata = array(
                    'id'  => $rows->idUser,
                    'username'  => $rows->Nom,
                    'email'    => $rows->AdresseMail,
                    //'logged_in'  => TRUE,
                );
            }
            $this->session->set_userdata($newdata);
            return true;
        }
        return false;
    }
    public function add_user($username, $prenom, $email, $confirmEmail, $password, $confirmPassword)
    {
        $data=array(
            'Nom'=>$username,
            'Prenom'=>$prenom,
            'AdresseMail'=>$email,
            'confirmAdMail'=>$confirmEmail,
            'password'=> hash('sha512', $password),
            'confirmPasswd'=> hash('sha512', $confirmPassword)
        );
        $this->db->insert('user',$data);

    }

}
?>