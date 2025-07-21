<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyelenggara_model extends CI_Model {

    protected $table = 'penyelenggara';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_penyelenggara()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function get_penyelenggara_by_id($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->row_array();
    }

    public function insert_penyelenggara($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_penyelenggara($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete_penyelenggara($id)
    {
        // Pertimbangkan logika: Apakah event terkait harus dihapus/disetel null penyelenggaranya?
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function count_all_penyelenggara()
    {
        return $this->db->count_all_results($this->table);
    }
}