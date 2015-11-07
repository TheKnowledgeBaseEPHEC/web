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
    public function gen_slug($user)
    {
        return substr(strtolower($user->prenom . "." . $user->nom), 0, 20);
    }

    /* Vérifie si une adresse email existe déjà en DB */
    public function check_mail($user)
    {
        $count = $this->db->where('AdresseMail', $user->email)->count_all_results('User');
        return ($count > 0);
    }

    /* Vérifie si un slug existe, si oui on y ajoute un chiffre random,
       On imagine que pas plus de 10 personnes on le même nom/prénom
     */
    public function check_and_update_slug(&$user)
    {
        $count = $this->db->where('slug', $user->slug)->count_all_results('User');
        while ($count > 0) {
            $user->slug .= "." . rand(0, 10);
            $count = $this->db->where('slug', $user->slug)->count_all_results('User');
        }
    }

    /* Ajout d'un nouvel utilisateur en BDD */
    public function add_user($user)
    {
        $data = array(
            'Nom' => $user->nom,
            'Prenom' => $user->prenom,
            'AdresseMail' => $user->email,
            'Password' => hash('sha512', $user->password),
            'slug' => $user->slug,
            'Actif' => 0
        );

        $this->db->insert('User', $data);

        return $this->db->insert_id();
    }

    /* Ajout d'une entrée activation en BDD, l'utilisateur a une semaine pour activer. */
    public function create_activation_key($user)
    {
        $key = uniqid();
        $data = array(
            'cle' => $key,
            'User_idUser' => $user->id
        );
        $this->db->set('expiration', 'now() + interval 1 week', FALSE);
        $this->db->insert('Activation', $data);

        return $key;
    }

    /* Vérifie et active un nouvel utilisateur */
    public function verify_activation_key($key) {
        // XXX secret question ?
        // clé expirée
        // login auto
    }
}