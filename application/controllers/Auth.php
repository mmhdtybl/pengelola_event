<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('auth_lib'); // Pastikan auth_lib di-load
    }

    public function login()
    {
        if ($this->auth_lib->is_logged_in()) {
            redirect('dashboard');
        }

        $data['title'] = 'Login';

        $this->form_validation->set_rules('username_or_email', 'Username atau Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/login', $data);
        } else {
            $identifier = $this->input->post('username_or_email');
            $password = $this->input->post('password');

            $user = $this->User_model->get_user_by_username_or_email($identifier);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $user_data = array(
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'nama_lengkap' => $user['nama_lengkap'],
                        'role' => $user['role'],
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($user_data);

                    $this->session->set_flashdata('success', 'Selamat datang, ' . $user['nama_lengkap'] . '!');
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('error', 'Password yang Anda masukkan salah.');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('error', 'Username atau Email tidak ditemukan.');
                redirect('auth/login');
            }
        }
    }

    public function register()
    {
        if ($this->auth_lib->is_logged_in()) {
            redirect('dashboard');
        }

        $data['title'] = 'Daftar Akun Baru';

        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]|trim|alpha_dash');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/register', $data);
        } else {
            $password = $this->input->post('password');
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $user_data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => $hashed_password,
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'role' => 'peserta'
            );

            if ($this->User_model->insert_user($user_data)) {
                $this->session->set_flashdata('success', 'Pendaftaran berhasil! Silakan login.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Gagal mendaftar. Silakan coba lagi.');
                redirect('auth/register');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(array('user_id', 'username', 'email', 'nama_lengkap', 'role', 'logged_in'));
        $this->session->sess_destroy();

        $this->session->set_flashdata('success', 'Anda telah berhasil logout.');
        redirect('auth/login');
    }
}