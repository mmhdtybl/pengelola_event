<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    protected $table = 'users';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->row_array();
    }

    public function get_user_by_username_or_email($identifier)
    {
        $this->db->where('username', $identifier);
        $this->db->or_where('email', $identifier);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function insert_user($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete_user($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function get_all_users()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function count_all_users()
    {
        return $this->db->count_all_results($this->table);
    }
}