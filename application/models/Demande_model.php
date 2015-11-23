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
            'DisponibilitesP' => $disponibilitesP,
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
            'DisponibilitesI' => $disponibilitesI,
        );
        $this->db->set('Date', 'now()', FALSE);
        $this->db->insert('Interet', $data);
    }

    public function getInfoTutore($slug)
    {
        $request = $this->db->select ('*')->where('idInteret', $slug) ->get('Interet', 10);
        return $request->result();
    }

    public function getInfoTuteur($slug)
    {
        $request = $this->db->select ('*')->where('idProposition', $slug) ->get('Proposition', 10);
        return $request->result();
    }

    public function getTutore($coursId)
    {
       $request = $this->db->select ('*')->where('idCours', $coursId) ->get('Interet', 10);
       return $request->result();
    }

    public function getTuteur($coursId)
    {
        $request = $this->db->select('*')->where('idCours', $coursId) ->get('Proposition', 10);
        return $request->result();
    }

    public function insertSceanceAide($idDemandeur, $prenomDemandeur, $prenomDemander, $idDemander, $idCours)
    {
        $data = array(
            'idDemandeur' => $idDemandeur ,
            'NomDemandeur' => $prenomDemandeur,
            'idDemander' => $idDemander,
            'NomDemander' => $prenomDemander,
            'confirmDemandeur' => 1,
            'confirmDemander' => 0,
            'status' => 0,
            'idCours' => $idCours,
            'isDemandeAide' => 0
        );
        $this->db->insert('Seance', $data);
    }

    public function insertSceanceDemande($idDemandeur, $prenomDemandeur, $prenomDemander, $idDemander, $idCours)
    {
        $data = array(
            'idDemandeur' => $idDemandeur ,
            'NomDemandeur' => $prenomDemandeur,
            'idDemander' => $idDemander,
            'NomDemander' => $prenomDemander,
            'confirmDemandeur' => 1,
            'confirmDemander' => 0,
            'status' => 0,
            'idCours' => $idCours,
            'isDemandeAide' => 1
        );
        $this->db->insert('Seance', $data);
    }

    public function getMyDemandes($id)
    {
        $request = $this->db->select ('*') ->where('idUser', $id) ->get('Interet',10);
        return $request->result();
    }

    public function getMyPropositions($id)
    {
        $request = $this->db->select ('*') ->where('idUser', $id) ->get('Proposition',10);
        return $request->result();
    }

    public function getMySeances($id)
    {
        $request = $this->db->select ('*') ->where('idDemandeur', $id) ->get('Seance',10);
        return $request->result();
    }

    public function getOtherSeances($id)
    {
        $request = $this->db->select ('*') ->where('idDemander', $id) ->get('Seance',10);
        return $request->result();
    }

}