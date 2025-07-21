<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_events extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Proteksi: Hanya admin atau event_manager yang bisa mengakses
        if (!$this->auth_lib->is_logged_in() || (!$this->auth_lib->has_role('admin') && !$this->auth_lib->has_role('event_manager'))) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('dashboard');
        }
        $this->load->model(['Event_model', 'Kategori_model', 'Penyelenggara_model']);
        $this->load->library('form_validation');
        $this->load->helper(['url', 'form']); // Pastikan helper form juga dimuat
        
    }

    public function index()
    {
        $data['title'] = 'Manajemen Event';
        $data['subtitle'] = 'Daftar semua event';
        $data['events'] = $this->Event_model->get_all_events();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/events/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Event Baru';
        $data['subtitle'] = 'Formulir untuk menambahkan event baru';
        $data['kategori_list'] = $this->Kategori_model->get_all_kategori();
        $data['penyelenggara_list'] = $this->Penyelenggara_model->get_all_penyelenggara();

        $this->form_validation->set_rules('nama_event', 'Nama Event', 'required|trim');
        $this->form_validation->set_rules('deskripsi_event', 'Deskripsi Event',);
        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required|trim');
        $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required|trim|callback_end_date_greater_than_start_date');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required|trim');
        $this->form_validation->set_rules('kuota', 'Kuota', 'integer|greater_than_equal_to[0]');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required|integer');
        $this->form_validation->set_rules('id_penyelenggara', 'Penyelenggara', 'required|integer');
        $this->form_validation->set_rules('status_event', 'Status Event', 'required|in_list[upcoming,active,finished,cancelled]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/events/form', $data);
            $this->load->view('templates/footer');
        } else {
            $upload_success = TRUE;
            $file_name = NULL;

            // Konfigurasi Upload Gambar
            $config['upload_path']   = './assets/uploads/events/'; // Pastikan folder ini ada dan writable
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048; // 2MB
            $config['file_name']     = 'event_' . time(); // Nama file unik

            // Pastikan direktori upload ada
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, TRUE);
            }

            $this->load->library('upload', $config);

            if (!empty($_FILES['gambar_event']['name'])) {
                if ($this->upload->do_upload('gambar_event')) {
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', 'Gagal upload gambar: ' . $this->upload->display_errors());
                    $upload_success = FALSE;
                }
            }

            if ($upload_success) {
                $event_data = array(
                    'nama_event'      => $this->input->post('nama_event'),
                    'deskripsi_event' => $this->input->post('deskripsi_event'),
                    'tanggal_mulai'   => date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_mulai'))),
                    'tanggal_selesai' => date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_selesai'))),
                    'lokasi'          => $this->input->post('lokasi'),
                    'kuota'           => ($this->input->post('kuota') === '' ? NULL : $this->input->post('kuota')),
                    'harga'           => $this->input->post('harga'),
                    'id_kategori'     => $this->input->post('id_kategori'),
                    'id_penyelenggara'=> $this->input->post('id_penyelenggara'),
                    'user_id'         => $this->auth_lib->get_user_data('id'),
                    'gambar_event'    => $file_name,
                    'status_event'    => $this->input->post('status_event')
                );

                if ($this->Event_model->insert_event($event_data)) {
                    $this->session->set_flashdata('success', 'Event berhasil ditambahkan!');
                    redirect('admin/events');
                } else {
                    // Hapus gambar jika insert ke DB gagal
                    if ($file_name && file_exists($config['upload_path'] . $file_name)) {
                        unlink($config['upload_path'] . $file_name);
                    }
                    $this->session->set_flashdata('error', 'Gagal menambahkan event.');
                    redirect('admin/events/create');
                }
            } else {
                redirect('admin/events/create');
            }
        }
    }

    public function edit($id = null)
    {
        if ($id === null) {
            redirect('admin/events');
        }

        $data['event_item'] = $this->Event_model->get_event_by_id($id);

        if (empty($data['event_item'])) {
            $this->session->set_flashdata('error', 'Event tidak ditemukan.');
            redirect('admin/events');
        }

        $data['title'] = 'Edit Event';
        $data['subtitle'] = 'Formulir untuk mengedit event';
        $data['kategori_list'] = $this->Kategori_model->get_all_kategori();
        $data['penyelenggara_list'] = $this->Penyelenggara_model->get_all_penyelenggara();

        $this->form_validation->set_rules('nama_event', 'Nama Event', 'required|trim');
        $this->form_validation->set_rules('deskripsi_event', 'Deskripsi Event', );
        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required|trim');
        $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required|trim|callback_end_date_greater_than_start_date');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required|trim');
        $this->form_validation->set_rules('kuota', 'Kuota', 'integer|greater_than_equal_to[0]');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required|integer');
        $this->form_validation->set_rules('id_penyelenggara', 'Penyelenggara', 'required|integer');
        $this->form_validation->set_rules('status_event', 'Status Event', 'required|in_list[upcoming,active,finished,cancelled]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/events/form', $data);
            $this->load->view('templates/footer');
        } else {
            $upload_success = TRUE;
            $file_name = $data['event_item']['gambar_event']; // Ambil nama file lama

            $config['upload_path']   = './assets/uploads/events/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048; // 2MB
            $config['file_name']     = 'event_' . time();

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, TRUE);
            }

            $this->load->library('upload', $config);

            if (!empty($_FILES['gambar_event']['name'])) {
                // Hapus gambar lama jika ada
                if ($file_name && file_exists($config['upload_path'] . $file_name)) {
                    unlink($config['upload_path'] . $file_name);
                }

                if ($this->upload->do_upload('gambar_event')) {
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', 'Gagal upload gambar: ' . $this->upload->display_errors());
                    $upload_success = FALSE;
                }
            }

            if ($upload_success) {
                $event_data = array(
                    'nama_event'      => $this->input->post('nama_event'),
                    'deskripsi_event' => $this->input->post('deskripsi_event'),
                    'tanggal_mulai'   => date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_mulai'))),
                    'tanggal_selesai' => date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_selesai'))),
                    'lokasi'          => $this->input->post('lokasi'),
                    'kuota'           => ($this->input->post('kuota') === '' ? NULL : $this->input->post('kuota')),
                    'harga'           => $this->input->post('harga'),
                    'id_kategori'     => $this->input->post('id_kategori'),
                    'id_penyelenggara'=> $this->input->post('id_penyelenggara'),
                    'gambar_event'    => $file_name,
                    'status_event'    => $this->input->post('status_event')
                );

                if ($this->Event_model->update_event($id, $event_data)) {
                    $this->session->set_flashdata('success', 'Event berhasil diperbarui!');
                    redirect('admin/events');
                } else {
                    // Jika update DB gagal, tapi gambar baru sudah terupload, hapus gambar baru
                    if ($file_name != $data['event_item']['gambar_event'] && file_exists($config['upload_path'] . $file_name)) {
                        unlink($config['upload_path'] . $file_name);
                    }
                    $this->session->set_flashdata('error', 'Gagal memperbarui event.');
                    redirect('admin/events/edit/' . $id);
                }
            } else {
                redirect('admin/events/edit/' . $id);
            }
        }
    }

    public function delete($id = null)
    {
        if ($id === null) {
            redirect('admin/events');
        }

        $event = $this->Event_model->get_event_by_id($id);
        if (empty($event)) {
            $this->session->set_flashdata('error', 'Event tidak ditemukan.');
            redirect('admin/events');
        }

        // Hapus file gambar terkait
        if ($event['gambar_event'] && file_exists('./assets/uploads/events/' . $event['gambar_event'])) {
            unlink('./assets/uploads/events/' . $event['gambar_event']);
        }

        if ($this->Event_model->delete_event($id)) {
            $this->session->set_flashdata('success', 'Event berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus event.');
        }
        redirect('admin/events');
    }

    // Callback validation untuk tanggal selesai harus lebih besar dari tanggal mulai
    public function end_date_greater_than_start_date($end_date)
    {
        $start_date = $this->input->post('tanggal_mulai');
        if (strtotime($end_date) <= strtotime($start_date)) {
            $this->form_validation->set_message('end_date_greater_than_start_date', 'Tanggal Selesai harus setelah Tanggal Mulai.');
            return FALSE;
        }
        return TRUE;
    }
}