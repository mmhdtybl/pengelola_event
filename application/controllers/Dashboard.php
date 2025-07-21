<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('auth_lib');
        if (!$this->auth_lib->is_logged_in()) {
            $this->session->set_flashdata('error', 'Anda harus login untuk mengakses halaman ini.');
            redirect('auth/login');
        }
        $this->load->model(['User_model', 'Event_model']); // Tambahkan Event_model
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['subtitle'] = 'Control panel';
        $data['user_role'] = $this->auth_lib->get_user_data('role');

        if ($data['user_role'] === 'admin' || $data['user_role'] === 'event_manager') {
            $data['total_users'] = $this->User_model->count_all_users();
            $data['total_events'] = $this->Event_model->count_all_events(); // Ambil total event
            $data['upcoming_events_count'] = $this->Event_model->count_upcoming_events(); // Ambil jumlah event mendatang
            $data['cancelled_events_count'] = $this->Event_model->count_cancelled_events(); // Ambil jumlah event dibatalkan
        } else {
            $data['upcoming_events_for_user'] = $this->Event_model->get_upcoming_events(); // Ambil event mendatang untuk user
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}