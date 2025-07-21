<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_lib {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->helper('url'); // Pastikan helper url di-load
    }

    public function is_logged_in()
    {
        return $this->CI->session->userdata('logged_in') === TRUE;
    }

    public function has_role($required_role)
    {
        if (!$this->is_logged_in()) {
            return FALSE;
        }
        $user_role = $this->CI->session->userdata('role');

        // Logika sederhana:
        // Admin bisa mengakses semua role
        if ($user_role === 'admin') {
            return TRUE;
        }

        // Event Manager bisa mengakses role event_manager dan peserta
        if ($user_role === 'event_manager' && ($required_role === 'event_manager' || $required_role === 'peserta')) {
            return TRUE;
        }

        // Peserta hanya bisa mengakses role peserta
        if ($user_role === 'peserta' && $required_role === 'peserta') {
            return TRUE;
        }

        // Jika role tidak cocok
        return $user_role === $required_role;
    }

    public function get_user_id()
    {
        return $this->CI->session->userdata('user_id');
    }

    public function get_user_data($key = null)
    {
        if ($key) {
            return $this->CI->session->userdata($key);
        }
        return $this->CI->session->userdata();
    }
}