<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_penyelenggara extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Proteksi: Hanya admin atau event_manager yang bisa mengakses
        if (!$this->auth_lib->is_logged_in() || (!$this->auth_lib->has_role('admin') && !$this->auth_lib->has_role('event_manager'))) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('dashboard');
        }
        $this->load->model('Penyelenggara_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'Manajemen Penyelenggara';
        $data['subtitle'] = 'Daftar semua penyelenggara event';
        $data['penyelenggara'] = $this->Penyelenggara_model->get_all_penyelenggara();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/penyelenggara/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Penyelenggara Baru';
        $data['subtitle'] = 'Formulir untuk menambahkan penyelenggara event baru';

        $this->form_validation->set_rules('nama_penyelenggara', 'Nama Penyelenggara', 'required|trim|is_unique[penyelenggara.nama_penyelenggara]');
        $this->form_validation->set_rules('email_penyelenggara', 'Email Penyelenggara', 'valid_email');
        $this->form_validation->set_rules('telepon_penyelenggara', 'Telepon Penyelenggara', 'trim');
        $this->form_validation->set_rules('alamat_penyelenggara', 'Alamat Penyelenggara', );

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/penyelenggara/form', $data);
            $this->load->view('templates/footer');
        } else {
            $penyelenggara_data = array(
                'nama_penyelenggara' => $this->input->post('nama_penyelenggara'),
                'email_penyelenggara' => $this->input->post('email_penyelenggara'),
                'telepon_penyelenggara' => $this->input->post('telepon_penyelenggara'),
                'alamat_penyelenggara' => $this->input->post('alamat_penyelenggara')
            );

            if ($this->Penyelenggara_model->insert_penyelenggara($penyelenggara_data)) {
                $this->session->set_flashdata('success', 'Penyelenggara berhasil ditambahkan!');
                redirect('admin/penyelenggara');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan penyelenggara.');
                redirect('admin/penyelenggara/create');
            }
        }
    }

    public function edit($id = null)
    {
        if ($id === null) {
            redirect('admin/penyelenggara');
        }

        $data['penyelenggara_item'] = $this->Penyelenggara_model->get_penyelenggara_by_id($id);

        if (empty($data['penyelenggara_item'])) {
            $this->session->set_flashdata('error', 'Penyelenggara tidak ditemukan.');
            redirect('admin/penyelenggara');
        }

        $data['title'] = 'Edit Penyelenggara';
        $data['subtitle'] = 'Formulir untuk mengedit penyelenggara event';

        $this->form_validation->set_rules('nama_penyelenggara', 'Nama Penyelenggara', 'required|trim|is_unique[penyelenggara.nama_penyelenggara.'.$id.']');
        $this->form_validation->set_rules('email_penyelenggara', 'Email Penyelenggara', 'valid_email');
        $this->form_validation->set_rules('telepon_penyelenggara', 'Telepon Penyelenggara', );
        $this->form_validation->set_rules('alamat_penyelenggara', 'Alamat Penyelenggara', );

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/penyelenggara/form', $data);
            $this->load->view('templates/footer');
        } else {
            $penyelenggara_data = array(
                'nama_penyelenggara' => $this->input->post('nama_penyelenggara'),
                'email_penyelenggara' => $this->input->post('email_penyelenggara'),
                'telepon_penyelenggara' => $this->input->post('telepon_penyelenggara'),
                'alamat_penyelenggara' => $this->input->post('alamat_penyelenggara')
            );

            if ($this->Penyelenggara_model->update_penyelenggara($id, $penyelenggara_data)) {
                $this->session->set_flashdata('success', 'Penyelenggara berhasil diperbarui!');
                redirect('admin/penyelenggara');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui penyelenggara.');
                redirect('admin/penyelenggara/edit/' . $id);
            }
        }
    }

    public function delete($id = null)
    {
        if ($id === null) {
            redirect('admin/penyelenggara');
        }

        if ($this->Penyelenggara_model->delete_penyelenggara($id)) {
            $this->session->set_flashdata('success', 'Penyelenggara berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus penyelenggara.');
        }
        redirect('admin/penyelenggara');
    }
}