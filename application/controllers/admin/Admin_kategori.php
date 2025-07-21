<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_kategori extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Proteksi: Hanya admin atau event_manager yang bisa mengakses
        if (!$this->auth_lib->is_logged_in() || (!$this->auth_lib->has_role('admin') && !$this->auth_lib->has_role('event_manager'))) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('dashboard');
        }
        $this->load->model('Kategori_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'Manajemen Kategori';
        $data['subtitle'] = 'Daftar semua kategori event';
        $data['kategori'] = $this->Kategori_model->get_all_kategori();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/kategori/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Kategori Baru';
        $data['subtitle'] = 'Formulir untuk menambahkan kategori event baru';

        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim|is_unique[kategori.nama_kategori]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', );

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/kategori/form', $data);
            $this->load->view('templates/footer');
        } else {
            $kategori_data = array(
                'nama_kategori' => $this->input->post('nama_kategori'),
                'deskripsi' => $this->input->post('deskripsi')
            );

            if ($this->Kategori_model->insert_kategori($kategori_data)) {
                $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan!');
                redirect('admin/kategori');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan kategori.');
                redirect('admin/kategori/create');
            }
        }
    }

    public function edit($id = null)
    {
        if ($id === null) {
            redirect('admin/kategori');
        }

        $data['kategori_item'] = $this->Kategori_model->get_kategori_by_id($id);

        if (empty($data['kategori_item'])) {
            $this->session->set_flashdata('error', 'Kategori tidak ditemukan.');
            redirect('admin/kategori');
        }

        $data['title'] = 'Edit Kategori';
        $data['subtitle'] = 'Formulir untuk mengedit kategori event';

        // Untuk is_unique, kecualikan ID yang sedang diedit
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim|is_unique[kategori.nama_kategori.'.$id.']');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'permit_empty');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/kategori/form', $data);
            $this->load->view('templates/footer');
        } else {
            $kategori_data = array(
                'nama_kategori' => $this->input->post('nama_kategori'),
                'deskripsi' => $this->input->post('deskripsi')
            );

            if ($this->Kategori_model->update_kategori($id, $kategori_data)) {
                $this->session->set_flashdata('success', 'Kategori berhasil diperbarui!');
                redirect('admin/kategori');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui kategori.');
                redirect('admin/kategori/edit/' . $id);
            }
        }
    }

    public function delete($id = null)
    {
        if ($id === null) {
            redirect('admin/kategori');
        }

        // Pertimbangkan untuk memeriksa apakah ada event yang terkait dengan kategori ini
        // Jika ada, Anda mungkin tidak ingin mengizinkan penghapusan atau meminta konfirmasi lebih lanjut.

        if ($this->Kategori_model->delete_kategori($id)) {
            $this->session->set_flashdata('success', 'Kategori berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus kategori.');
        }
        redirect('admin/kategori');
    }
}