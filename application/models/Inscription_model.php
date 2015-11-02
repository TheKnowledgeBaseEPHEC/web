<?php

/**
 * Created by PhpStorm.
 * User: youri
 * Date: 02/11/15
 * Time: 14:09
 */
class Inscription_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /* Génère un slug de 20 caractères max en utilisant le prénom et le nom de famille */
    public function gen_slug($nom, $prenom)
    {
        return substr(strtolower($prenom . "." . $nom), 0, 20);
    }

    /* Vérifie si une adresse email existe déjà en DB */
    public function check_mail($email)
    {
        $count = $this->db->where('AdresseMail', $email)->count_all_results('User');
        return ($count > 0);
    }

    /* Vérifie si un slug existe, si oui on y ajoute un chiffre random,
       On imagine que pas plus de 10 personnes on le même nom/prénom
     */
    public function check_and_update_slug(&$slug)
    {
        $count = $this->db->where('slug', $slug)->count_all_results('User');
        while ($count > 0) {
            $slug .= "." . rand(0, 10);
            $count = $this->db->where('slug', $slug)->count_all_results('User');
        }
    }

    /* Ajout d'un nouvel utilisateur en BDD */
    public function add_user($nom, $prenom, $email, $password, $slug)
    {
        $data = array(
            'Nom' => $nom,
            'Prenom' => $prenom,
            'AdresseMail' => $email,
            'Password' => hash('sha512', $password),
            'slug' => $slug
        );

        $this->db->insert('User', $data);
    }
}