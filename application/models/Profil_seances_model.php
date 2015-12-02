<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Profil_seances_model extends CI_Model {
    var $table = 'Cours';
    var $column = array('idcours','intitulecours','fac_ecole_idecole','slug');
    var $order = array('idcours' => 'desc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /*
     * Requêtes pour la datatable
     */
    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column as $item)
        {
            if($_POST['search']['value'])
                ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $column[$i] = $item;
            $i++;
        }

        if(isset($_POST['order']))
        {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Récupère le compte de la datatable
     */
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
     * Récupère le nombre d'éléments dans la table
     */
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    /*
     * Récupère un cours par l'id
     */
    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('idCours',$id);
        $query = $this->db->get();

        return $query->row();
    }

    /*
     * Enregistre un élément en BDD
     */
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /*
     * Màj élément en BDD
     */
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    /*
     * Suppression d'un élément par l'id de cours
     */
    public function delete_by_id($id)
    {
        $this->db->where('idCours', $id);
        $this->db->delete($this->table);
    }

    /*
     * Ajout d'un rating pour une séance
     */
    public function add_seance_rating($id, $rating, $comment)
    {
        $data = array(
            'rating' => $rating,
            'comment' => $comment,
        );
        $this->db->where('idSeance', $id);
        $this->db->update('Seance', $data);
    }
}