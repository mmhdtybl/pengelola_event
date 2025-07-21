<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Splash extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url'); // Memuat URL Helper untuk base_url()
    }

    public function index()
    {
        // Pastikan user belum login, jika sudah, langsung arahkan ke dashboard
        // Anda bisa menambahkan logika pengecekan login di sini
        // Misalnya:
        // $this->load->library('auth_lib');
        // if ($this->auth_lib->is_logged_in()) {
        //     redirect('dashboard'); // Atau ke halaman utama setelah login
        // }

        $this->load->view('splash_screen');
    }
}