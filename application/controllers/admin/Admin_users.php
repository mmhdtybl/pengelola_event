<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Proteksi: Hanya admin yang bisa mengakses ini
        if (!$this->auth_lib->is_logged_in() || !$this->auth_lib->has_role('admin')) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('dashboard'); // Arahkan ke dashboard jika tidak punya akses
        }
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'Manajemen Pengguna';
        $data['subtitle'] = 'Daftar semua pengguna';
        $data['users'] = $this->User_model->get_all_users();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/users/index', $data); // Ini view daftar user
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Pengguna Baru';
        $data['subtitle'] = 'Formulir untuk menambahkan pengguna baru';

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]|alpha_dash');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,event_manager,peserta]');


        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/users/form', $data); // Ini view form user
            $this->load->view('templates/footer');
        } else {
            $password = $this->input->post('password');
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $user_data = array(
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => $hashed_password,
                'role' => $this->input->post('role')
            );

            if ($this->User_model->insert_user($user_data)) {
                $this->session->set_flashdata('success', 'Pengguna berhasil ditambahkan!');
                redirect('admin/users');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan pengguna.');
                redirect('admin/users/create');
            }
        }
    }

    public function edit($id = null)
    {
        if ($id === null) {
            redirect('admin/users');
        }

        $data['user'] = $this->User_model->get_user_by_id($id);

        if (empty($data['user'])) {
            $this->session->set_flashdata('error', 'Pengguna tidak ditemukan.');
            redirect('admin/users');
        }

        $data['title'] = 'Edit Pengguna';
        $data['subtitle'] = 'Formulir untuk mengedit pengguna';

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        // Untuk username dan email, is_unique perlu dikecualikan untuk ID saat ini
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email.'.$id.']');
        $this->form_validation->set_rules('password', 'Password','min_length[6]'); // permit_empty jika tidak wajib diisi saat edit
        $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'matches[password]');
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,event_manager,peserta]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/users/form', $data);
            $this->load->view('templates/footer');
        } else {
            $user_data = array(
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'email' => $this->input->post('email'),
                'role' => $this->input->post('role')
            );

            // Hanya update password jika diisi
            if (!empty($this->input->post('password'))) {
                $user_data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            }

            if ($this->User_model->update_user($id, $user_data)) {
                $this->session->set_flashdata('success', 'Pengguna berhasil diperbarui!');
                redirect('admin/users');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui pengguna.');
                redirect('admin/users/edit/' . $id);
            }
        }
    }

    public function delete($id = null)
    {
        if ($id === null) {
            redirect('admin/users');
        }

        if ($this->User_model->delete_user($id)) {
            $this->session->set_flashdata('success', 'Pengguna berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pengguna.');
        }
        redirect('admin/users');
    }
}