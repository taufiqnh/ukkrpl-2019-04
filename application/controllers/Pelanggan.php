<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_pelanggan');
        $this->load->model('M_tarif');
        $this->load->model('M_admin');
    }

    public function index()
    {
        $this->load->view('v_login_pelanggan');
    }

    public function register()
    {
        $data['tarif'] = $this->M_tarif->m_tarif_tampil();
        $this->load->view('v_register', $data);
    }

    public function pelanggan_register()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi!'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password harus diisi!'));
        $this->form_validation->set_rules('nomor_kwh', 'Nomor Meter', 'trim|required', array('required' => 'Nomor Meter harus diisi!'));
		$this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'trim|required', array('required' => 'Nama Pelanggan harus diisi!'));
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', array('required' => 'Alamat harus diisi!'));
		$this->form_validation->set_rules('id_tarif', 'Daya', 'trim|required', array('required' => 'Daya harus diisi!'));
        if ($this->form_validation->run() == true) {
            if ($this->input->post('submit')) {
                if ($this->M_pelanggan->m_pelanggan_tambah() == TRUE) {
                    redirect('Pelanggan','refresh');
                }
                else {
                    $this->session->set_flashdata('pesan', 'Gagal menambahkan pelanggan');
                    redirect('Pelanggan/register');
                }
            }
            else {
                $this->session->set_flashdata('pesan', 'Terjadi kesalahan pada form');
                redirect('Pelanggan/register');
            }
        }
        else {
            $this->session->set_flashdata('pesan', validation_errors());
            redirect('Pelanggan/register');
        }
    }

    public function pelanggan_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi!'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password harus diisi!'));
        if ($this->form_validation->run() == true) {
            if ($this->M_pelanggan->m_pelanggan_login()->num_rows() > 0) {
                $data = $this->M_pelanggan->m_pelanggan_login()->row();
                $datapelanggan = array(
                    'login' => TRUE,
                    'username' => $data->username,
                    'password' => $data->password,
                    'nama_pelanggan' => $data->nama_pelanggan,
                    'id_pelanggan' => $data->id_pelanggan,
                    'role' => 'Pelanggan'
                );
                $this->session->set_userdata($datapelanggan);
                redirect('Transaksi/daftartagihan','refresh');
            }
            else {
                $this->session->set_flashdata('pesan', 'Username dan password salah');
                redirect('/');
            }
        }
        else {
            $this->session->set_flashdata('pesan', validation_errors());
            redirect('/');
        }
    }

    public function datapelanggan()
    {
        $data['konten'] = 'v_pelanggan';
        $data['active'] = 'Pelanggan';
        $data['judul'] = 'Data Pelanggan';
        $data['pelanggan'] = $this->M_pelanggan->m_pelanggan_tampil();
        $data['count'] = $this->M_pelanggan->m_pelanggan_hitung();
        $data['tarif'] = $this->M_tarif->m_tarif_tampil();
        $this->load->view('v_pelanggan', $data);
    }

    public function pelanggan_tambah()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi!'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password harus diisi!'));
        $this->form_validation->set_rules('nomor_kwh', 'Nomor Meter', 'trim|required', array('required' => 'Nomor Meter harus diisi!'));
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'trim|required', array('required' => 'Nama Pelanggan harus diisi!'));
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', array('required' => 'Alamat harus diisi!'));
        $this->form_validation->set_rules('id_tarif', 'Daya', 'trim|required', array('required' => 'Daya harus diisi!'));
        if ($this->form_validation->run() == true) {
            if ($this->input->post('tambah')) {
                if ($this->M_pelanggan->m_pelanggan_tambah() == TRUE) {
                    $this->session->set_flashdata('pesan', 'Sukses menambah pelanggan');
                }
                else {
                    $this->session->set_flashdata('pesan', 'Gagal menambah pelanggan');
                }
            }
            else {
                $this->session->set_flashdata('pesan', 'Terjadi kesalahan pada form');
            }
            redirect('Pelanggan/datapelanggan');
        }
        else {
            $this->session->set_flashdata('pesan', validation_errors());
            redirect('Pelanggan/datapelanggan');
        }
    }

    public function get_pelanggan_id($id)
    {
        $data = $this->M_pelanggan->get_datapelanggan_id($id);
        echo (json_encode($data));
    }

    public function pelanggan_ubah()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi!'));
        $this->form_validation->set_rules('nomor_kwh', 'Nomor Meter', 'trim|required', array('required' => 'Nomor Meter harus diisi!'));
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'trim|required', array('required' => 'Nama Pelanggan harus diisi!'));
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', array('required' => 'Alamat harus diisi!'));
        $this->form_validation->set_rules('id_tarif', 'Daya', 'trim|required', array('required' => 'Daya harus diisi!'));
        if ($this->form_validation->run() == true) {
            $id             = $this->input->post('id_pelanggan');
            $nama_pelanggan = $this->input->post('nama_pelanggan');
            $username       = $this->input->post('username');
            $nomor_kwh      = $this->input->post('nomor_kwh');
            $alamat         = $this->input->post('alamat');
            $id_tarif       = $this->input->post('id_tarif');

            $this->session->set_flashdata('pesan', 'Sukses mengubah pelanggan');
            $this->M_pelanggan->m_pelanggan_ubah($id, $nama_pelanggan, $username, $nomor_kwh, $alamat, $id_tarif);
        }
        else {
            $this->session->set_flashdata('pesan', 'Gagal mengubah pelanggan');
        }
        redirect('Pelanggan/datapelanggan');
    }

    public function pelanggan_hapus($id='')
    {
        $hapus = $this->M_pelanggan->m_pelanggan_hapus($id);
        if ($hapus == true) {
            $this->session->set_flashdata('pesan', 'Sukses menghapus pelanggan');
        }
        else {
            $this->session->set_flashdata('pesan', 'Gagal menghapus pelanggan');
        }
        redirect('Pelanggan/datapelanggan');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Pelanggan','refresh');
    }
}
