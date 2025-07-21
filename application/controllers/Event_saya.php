<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_saya extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('auth_lib');
        // Proteksi: Hanya pengguna yang login yang bisa mengakses
        if (!$this->auth_lib->is_logged_in()) {
            $this->session->set_flashdata('error', 'Anda harus login untuk mengakses halaman ini.');
            redirect('auth/login');
        }
        $this->load->model('Event_model');
        $this->load->helper('url');
         $this->load->helper('text');
         
    }

    public function index()
    {
        $user_id = $this->auth_lib->get_user_data('id'); // Ambil ID pengguna yang login

        $data['title'] = 'Event Saya';
        $data['subtitle'] = 'Daftar event yang saya buat/kelola';
        $data['events'] = $this->Event_model->get_events_by_user_id($user_id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('event_saya/index', $data); // View baru
        $this->load->view('templates/footer');
    }

    // Opsional: Jika Anda ingin user_manager bisa edit/hapus dari Event Saya,
    // Anda bisa duplikasi fungsi edit/delete dari Admin_events di sini,
    // TAPI pastikan ada validasi user_id (hanya boleh edit/hapus event milik sendiri)
    // atau redirect saja ke halaman admin/events jika itu yang diinginkan.
}