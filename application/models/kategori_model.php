<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

    protected $table = 'kategori';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_kategori()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function get_kategori_by_id($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->row_array();
    }

    public function insert_kategori($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_kategori($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete_kategori($id)
    {
        // Pertimbangkan logika: Apakah event terkait harus dihapus/disetel null kategorinya?
        // Untuk saat ini, kita biarkan saja, tapi di kasus nyata ini penting.
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function count_all_kategori()
    {
        return $this->db->count_all_results($this->table);
    }
}