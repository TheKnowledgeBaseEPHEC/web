<?php
/**
 * Created by PhpStorm.
 * User: SMN
 * Date: 16-11-15
 * Time: 05:12
 */

class Demande_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function recupIdCours($slug)
    {
        $request = $this->db->select("idCours")
            ->where('slug', $slug)
            ->get('Cours');
        $row = $request->row();
        $idCours = $row->idCours;
        return $idCours;
    }

    public function recupIdUser($slug)
    {
        $request = $this->db->select("idUser")
            ->where('slug', $slug)
            ->get('User');
        $row = $request->row();
        $idUser = $row->idUser;
        return $idUser;
    }

    public function insertInfoP($descriptionP, $remuneration, $disponibilitesP, $userid, $coursid, $prenom, $nom, $slugUser){
        $data = array(
            'idUser' => $userid ,
            'slug' =>  $slugUser,
            'Nom' => $nom,
            'Prenom' => $prenom,
            'idCours' => $coursid,
            'DescriptionP' => $descriptionP,
            'Remuneration' => $remuneration,
            'DisponibilitesP' => $disponibilitesP
        );
        $this->db->set('Date', 'now()', FALSE);
        $this->db->insert('Proposition', $data);
    }

    public function insertInfoI($descriptionI, $disponibilitesI, $userid, $coursid, $prenom, $nom, $slugUser){
        $data = array(
            'idUser' => $userid ,
            'slug' =>  $slugUser,
            'Nom' => $nom,
            'Prenom' => $prenom,
            'idCours' => $coursid,
            'DescriptionI' => $descriptionI,
            'DisponibilitesI' => $disponibilitesI
        );
        $this->db->set('Date', 'now()', FALSE);
        $this->db->insert('Interet', $data);
    }

    public function getTutore()
    {
       $request = $this->db->select ('*') ->get('Interet', 10);
       return $request->result();
    }

    public function getTuteur()
    {
        $request = $this->db->select('*') ->get('Proposition', 10);
        return $request->result();
    }

    public function insertSceance($userDemandeur, $userDemander)
    {
        $data = array(
            'idDemandeur' => $userDemandeur ,
            'idDemander' =>  $userDemander,
        );
        $this->db->insert('Seance', $data);
    }

    public function getSeanceDemandeur($id)
    {
        $request = $this->db->select ('*') ->where('idDemandeur', $id) ->get('Seance',10);
        return $request->result();
    }

    public function getSeanceDemander($id)
    {
        $request = $this->db->select ('*') ->where('idDemander', $id) ->get('Seance',10);
        return $request->result();
    }

    public function getAllSeancesDemandeur($id)
    {
        $request = $this->db->select ('*') ->where('idDemandeur', $id)->where('status', 1) ->get('Seance',10);
        return $request->result();
    }

    public function getAllSeancesDemander($id)
    {
        $request = $this->db->select ('*') ->where('idDemander', $id)->where('status', 1) ->get('Seance', 10);
        return $request->result();
    }

}