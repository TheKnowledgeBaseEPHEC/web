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

    /*
     * Récupère un cours
     */
    public function recupCours($slug)
    {
        $request = $this->db->select("*")->where('slug', $slug)->get('Cours');
        return $request->result();
    }

    /*
     * Récupère l'id d'un user
     */
    public function recupIdUser($slug)
    {
        $request = $this->db->select("idUser")
            ->where('slug', $slug)
            ->get('User');
        $row = $request->row();
        $idUser = $row->idUser;
        return $idUser;
    }

    /*
     * Ajout d'une proposition
     */
    public function insertInfoP($descriptionP, $remuneration, $disponibilitesP, $userid, $coursid, $prenom, $nom, $slugUser, $nomCours){
        $data = array(
            'idUser' => $userid ,
            'slug' =>  $slugUser,
            'Nom' => $nom,
            'Prenom' => $prenom,
            'idCours' => $coursid,
            'DescriptionP' => $descriptionP,
            'Remuneration' => $remuneration,
            'DisponibilitesP' => $disponibilitesP,
            'NomCours' => $nomCours
        );
        $this->db->set('Date', 'now()', FALSE);
        $this->db->insert('Proposition', $data);
    }

    /*
     * Ajout d'un intérêt
     */
    public function insertInfoI($descriptionI, $disponibilitesI, $userid, $coursid, $prenom, $nom, $slugUser, $nomCours){
        $data = array(
            'idUser' => $userid ,
            'slug' =>  $slugUser,
            'Nom' => $nom,
            'Prenom' => $prenom,
            'idCours' => $coursid,
            'DescriptionI' => $descriptionI,
            'DisponibilitesI' => $disponibilitesI,
            'NomCours' =>$nomCours
        );
        $this->db->set('Date', 'now()', FALSE);
        $this->db->insert('Interet', $data);
    }

    /*
     * Récupère un intérêt sur base du slug du tutoré
     */
    public function getInfoTutore($slug)
    {
        $request = $this->db->select('*')->where('idInteret', $slug)->join('User', 'User.idUser = Interet.idUser')->get('Interet', 10);
        return $request->result();
    }

    /*
     * Récupère un intérêt
     */
    public function getInteret($id)
    {
        $request = $this->db->select('*')->where('idUser', $id)->get('Interet', 10);
        return $request->result();
    }

    /*
     * Récupère une proposition
     */
    public function getProposition($id)
    {
        $request = $this->db->select('*')->where('idUser', $id)->get('Proposition', 10);
        return $request->result();
    }

    /*
     * Récupère un intérêt sur base du slug du tuteur
     */
    public function getInfoTuteur($slug)
    {
        $request = $this->db->select('*')->where('idProposition', $slug)->join('User', 'User.idUser = Proposition.idUser')->get('Proposition', 10);
        return $request->result();
    }

    /*
     * Récupère les interêts pour un cours
     */
    public function getTutore($coursId)
    {
        $request = $this->db->select ('*')->where('idCours', $coursId) ->get('Interet', 10);
        return $request->result();
    }

    /*
     * Récupère les propositions pour un cours
     */
    public function getTuteur($coursId)
    {
        $request = $this->db->select('*')->where('idCours', $coursId) ->get('Proposition', 10);
        return $request->result();
    }

    /*
     * Ajout d'une séance par demande d'aide
     */
    public function insertSceanceAide($idDemandeur, $prenomDemandeur, $prenomDemander, $idDemander, $idCours)
    {
        $data = array(
            'idDemandeur' => $idDemandeur ,
            'NomDemandeur' => $prenomDemandeur,
            'idDemander' => $idDemander,
            'NomDemander' => $prenomDemander,
            'confirmDemandeur' => 1,
            'confirmDemander' => 0,
            'status' => 'NON_CONFIRMEE',
            'idCours' => $idCours,
            'isDemandeAide' => 0
        );
        $this->db->set('startDate', 'now()', FALSE);
        $this->db->insert('Seance', $data);
    }

    /*
     * Ajout d'une séance par proposition d'aide
     */
    public function insertSceanceDemande($idDemandeur, $prenomDemandeur, $prenomDemander, $idDemander, $idCours)
    {
        $data = array(
            'idDemandeur' => $idDemandeur ,
            'NomDemandeur' => $prenomDemandeur,
            'idDemander' => $idDemander,
            'NomDemander' => $prenomDemander,
            'confirmDemandeur' => 1,
            'confirmDemander' => 0,
            'status' => 'NON_CONFIRMEE',
            'idCours' => $idCours,
            'isDemandeAide' => 1
        );
        $this->db->set('startDate', 'now()', FALSE);
        $this->db->insert('Seance', $data);
    }

    /*
     * Récupère les intérêts pour un utilisateur
     */
    public function getCours($id)
    {
        $request = $this->db->select ('*') ->where('idUser', $id) ->get('Interet',10);
        return $request->result();
    }

    /*
     * Récupère les propositiosn pour un utilisateur
     */
    public function getMyPropositions($id)
    {
        $request = $this->db->select ('*') ->where('idUser', $id) ->get('Proposition',10);
        return $request->result();
    }

    /*
     * Récupère les séances d'un utilisateur ou il est tutore
     */
    public function getMySeances($id)
    {
        $request = $this->db->select('*')->where ('idDemandeur', $id)->join('Cours', 'Cours.idCours = Seance.idCours')->get('Seance', 10);
        return $request->result();
    }

    /*
     * Récupère une séance active ou l'utilisateur est tuteur ou tutoré
     */
    public function getMySeancesFromId($sId) {
        return $this->db->select('idSeance, idDemandeur, idDemander')
            ->where('idSeance', $sId)
            ->where('status', "EN_COURS")
            ->group_start()
            ->where('idDemandeur', $this->session->userdata('user_id'))
            ->or_where('idDemander', $this->session->userdata('user_id'))
            ->group_end()
            ->get('Seance')
            ->row();
    }

    /*
     * Récupère les séances d'un utilisateur ou il est tuteur
     */
    public function getOtherSeances($id)
    {
        $request = $this->db->select('*')->where('idDemander', $id)->join('Cours', 'Cours.idCours = Seance.idCours')->get('Seance', 10);
        return $request->result();
    }

    /*
     * Récupère une séance sur base de son id
     */
    public function getMyScDP($id)
    {
        $request = $this->db->select('*')->where('idSeance', $id)->join('Cours', 'Cours.idCours = Seance.idCours')->get('Seance', 10);
        return $request->result();
    }

    /*
     * Suppression d'un intéret
     */
    public function DeleteDA($idDA)
    {
        $this->db->delete('Interet', array('idInteret' => $idDA));
    }

    /*
     * Suppression d'une proposition
     */
    public function DeletePA($idPA)
    {
        $this->db->delete('Proposition', array('idProposition' => $idPA));
    }

    /*
     * Récupère  un cours
     */
    public function recupNC($idCours)
    {
        $request = $this->db->select ('*') ->where('idCours', $idCours) ->get('Cours',10);
        return $request->result();
    }

    /*
     * Suppression d'une séance
     */
    public function DeleteSc($idSc)
    {
        $this->db->delete('Seance', array('idSeance' => $idSc));
    }

    /*
     * Confirmation d'une demande de séance
     */
    public function confirmDemSc($idSeance)
    {
        $data = array(
            'confirmDemander' => 1,
            'status' => 'EN_COURS'
        );
        $this->db->where('idSeance', $idSeance);
        $this->db->update('Seance', $data);
    }

    /*
     * Récupère les séances terminées
     */
    public function show_seances($id)
    {
        $request = $this->db->select ('*') ->where('idDemandeur', $id) ->where('status', 'FINIE') ->get('Seance',10);
        return $request->result();
    }
}