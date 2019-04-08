<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
        $this->load->model('M_pelanggan');
    }

    public function index()
    {
        $this->load->view('v_login');
    }

    public function admin_login()
    {
		$this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi!'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password harus diisi!'));
        if ($this->form_validation->run() == true) {
            if ($this->M_admin->m_admin_login()->num_rows() > 0) {
                $data = $this->M_admin->m_admin_login()->row();
                $dataadmin = array(
                    'login' => TRUE,
                    'username' => $data->username,
                    'password' => $data->password,
                    'nama_admin' => $data->nama_admin,
                    'level' => $data->id_level,
                    'id_admin' => $data->id_admin,
                    'role' => 'Admin'
                );
                $this->session->set_userdata($dataadmin);
                redirect('Dashboard','refresh');
            }
            else {
                $this->session->set_flashdata('pesan', 'Username dan password salah');
                redirect('Admin');
            }
        }
        else {
            $this->session->set_flashdata('pesan', validation_errors());
            redirect('Admin');
        }
    }

    public function dataadmin()
    {
        $data['konten'] = 'v_admin';
        $data['active'] = 'Admin';
        $data['judul'] = 'Data Admin';
        $data['admin'] = $this->M_admin->m_admin_tampil();
        $data['count'] = $this->M_admin->m_admin_hitung();
        $data['level'] = $this->M_admin->level_tampil();;
        $this->load->view('v_dataadmin', $data);
    }

    public function admin_tambah()
    {
        $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'trim|required', array('required' => 'Nama Admin harus diisi!'));
        $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi!'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password harus diisi!'));
        $this->form_validation->set_rules('id_level', 'Level', 'trim|required', array('required' => 'Level harus diisi!'));
        if ($this->form_validation->run() == true) {
            if ($this->input->post('tambah')) {
                if ($this->M_admin->m_admin_tambah() == TRUE) {
                    $this->session->set_flashdata('pesan', 'Sukses menambah admin');
                }
                else {
                    $this->session->set_flashdata('pesan', 'Gagal menambah admin');
                }
            }
            else {
                $this->session->set_flashdata('pesan', 'Terjadi kesalahan pada form');
            }
            redirect('Admin/dataadmin');
        }
        else {
            $this->session->set_flashdata('pesan', validation_errors());
            redirect('Admin/dataadmin');
        }
    }

    public function get_admin_id($id)
    {
        $data = $this->M_admin->get_dataadmin_id($id);
        echo (json_encode($data));
    }

    public function admin_ubah()
    {
        $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'trim|required', array('required' => 'Nama Admin harus diisi!'));
        $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi!'));
        $this->form_validation->set_rules('id_level', 'Level', 'trim|required', array('required' => 'Level harus diisi!'));
        if ($this->form_validation->run() == true) {
            $id             = $this->input->post('id_admin');
            $nama_admin     = $this->input->post('nama_admin');
            $username       = $this->input->post('username');
            $id_level       = $this->input->post('id_level');

            $this->session->set_flashdata('pesan', 'Sukses mengubah admin');
            $this->M_admin->m_admin_ubah($id, $nama_admin, $username, $id_level);
        }
        else {
            $this->session->set_flashdata('pesan', 'Gagal mengubah admin');
        }
        redirect('Admin/dataadmin');
    }

    public function admin_hapus($id='')
    {
        $hapus = $this->M_admin->m_admin_hapus($id);
        if ($hapus == true) {
            $this->session->set_flashdata('pesan', 'Sukses menghapus admin');
        }
        else {
            $this->session->set_flashdata('pesan', 'Gagal menghapus admin');
        }
        redirect('Admin/dataadmin');
    }

    public function logout()
    {
        $this->session->set_userdata('username', FALSE);
        $this->session->sess_destroy();
        redirect('Admin','refresh');
    }
}
