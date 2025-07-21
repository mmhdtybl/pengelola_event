<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model {

    protected $table = 'events';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_events()
    {
        $this->db->select('events.*, kategori.nama_kategori, penyelenggara.nama_penyelenggara');
        $this->db->from($this->table);
        $this->db->join('kategori', 'kategori.id = events.id_kategori', 'left');
        $this->db->join('penyelenggara', 'penyelenggara.id = events.id_penyelenggara', 'left');
        $this->db->order_by('tanggal_mulai', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_event_by_id($id)
    {
        $this->db->select('events.*, kategori.nama_kategori, penyelenggara.nama_penyelenggara');
        $this->db->from($this->table);
        $this->db->join('kategori', 'kategori.id = events.id_kategori', 'left');
        $this->db->join('penyelenggara', 'penyelenggara.id = events.id_penyelenggara', 'left');
        $this->db->where('events.id', $id);
        return $this->db->get()->row_array();
    }

     public function get_events_by_user_id($user_id)
    {
        $this->db->select('events.*, kategori.nama_kategori, penyelenggara.nama_penyelenggara');
        $this->db->from($this->table);
        $this->db->join('kategori', 'kategori.id = events.id_kategori', 'left');
        $this->db->join('penyelenggara', 'penyelenggara.id = events.id_penyelenggara', 'left');
        $this->db->where('events.user_id', $user_id); // Filter berdasarkan user_id
        $this->db->order_by('tanggal_mulai', 'DESC');
        return $this->db->get()->result_array();
    }

   
    


    public function insert_event($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_event($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete_event($id)
    {
        // Jika ada registrasi pengguna untuk event ini, Anda mungkin ingin menghapusnya juga
        // atau menambahkan kolom 'soft_delete'
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function count_all_events()
    {
        return $this->db->count_all_results($this->table);
    }

    public function get_upcoming_events()
    {
        $this->db->select('events.*, kategori.nama_kategori, penyelenggara.nama_penyelenggara');
        $this->db->from($this->table);
        $this->db->join('kategori', 'kategori.id = events.id_kategori', 'left');
        $this->db->join('penyelenggara', 'penyelenggara.id = events.id_penyelenggara', 'left');
        $this->db->where('tanggal_mulai >=', date('Y-m-d H:i:s'));
        $this->db->where_in('status_event', ['upcoming', 'active']);
        $this->db->order_by('tanggal_mulai', 'ASC');
        return $this->db->get()->result_array();
    }

    public function count_upcoming_events()
    {
        $this->db->where('tanggal_mulai >=', date('Y-m-d H:i:s'));
        $this->db->where_in('status_event', ['upcoming', 'active']);
        return $this->db->count_all_results($this->table);
    }

    public function count_cancelled_events()
    {
        $this->db->where('status_event', 'cancelled');
        return $this->db->count_all_results($this->table);
    }
}