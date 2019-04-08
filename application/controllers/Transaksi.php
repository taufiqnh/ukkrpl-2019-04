<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_transaksi');
        $this->load->model('M_pelanggan');
    }

    public function penggunaanpelanggan()
    {
        $data['konten'] = 'v_penggunaanpelanggan';
        $data['active'] = 'Penggunaan';
        $data['judul'] = 'Penggunaan Pelanggan';
        $data['pelanggan'] = $this->M_pelanggan->m_pelanggan_tampil();
        $data['count'] = $this->M_pelanggan->m_pelanggan_hitung();
        $this->load->view('v_penggunaanpelanggan', $data);
    }

    public function penggunaan_tambah()
    {
        $this->form_validation->set_rules('bulan', 'Bulan', 'trim|required', array('required' => 'Bulan harus diisi!'));
        $this->form_validation->set_rules('tahun', 'Tahun', 'trim|required', array('required' => 'Tahun harus diisi!'));
        $this->form_validation->set_rules('meter_awal', 'Meter Awal', 'trim|required', array('required' => 'Meter Awal harus diisi!'));
        $this->form_validation->set_rules('meter_akhir', 'Meter Akhir', 'trim|required', array('required' => 'Meter Akhir harus diisi!'));
        if ($this->form_validation->run() == true) {
            if ($this->input->post('submit')) {
                $cek = $this->M_transaksi->m_cek_penggunaan();
                if ($cek == null) {
                    if ($this->M_transaksi->m_penggunaan_tambah() == TRUE) {
                        $this->session->set_flashdata('pesan', 'Sukses menambah penggunaan');
                    }
                    else {
                        $this->session->set_flashdata('pesan', 'Gagal menambah penggunaan');
                    }
                }
                else {
                    $this->session->set_flashdata('pesan', 'Data sudah ada');
                }
            }
            else {
                $this->session->set_flashdata('pesan', 'Terjadi kesalahan pada form');
            }
            redirect('Transaksi/penggunaanpelanggan');
        }
        else {
            $this->session->set_flashdata('pesan', validation_errors());
            redirect('Transaksi/penggunaanpelanggan');
        }
    }

    public function transaksidetail($id='')
    {
        $data['konten'] = 'v_detailpenggunaan';
        $data['active'] = 'Penggunaan';
        $data['judul'] = 'Detail Penggunaan dan Tagihan';
        $data['detail'] = $this->M_transaksi->m_penggunaan_detail($id);
        $data['count'] = $this->M_transaksi->m_penggunaan_detail_hitung($id);
        $this->load->view('v_detailpenggunaan', $data);
    }

    public function daftartagihan()
    {
        $id = $this->session->userdata('id_pelanggan');
        $data['konten'] = 'v_daftartagihan';
        $data['active'] = 'Tagihan';
        $data['judul'] = 'Daftar Tagihan';
        $data['detail'] = $this->M_transaksi->m_penggunaan_detail($id);
        $data['count'] = $this->M_transaksi->m_penggunaan_detail_hitung($id);
        $this->load->view('v_daftartagihan', $data);
    }

    public function upload_bukti($id)
    {
        $config['upload_path'] = './assets/bukti/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = 'bukti'.$id;
        $config['max_size'] = '';
        $config['max_width'] = '';
        $config['max_height'] = '';

        $this->load->library('upload' , $config);
        if (!$this->upload->do_upload('bukti')) {
            $this->session->set_flashdata('pesan', 'Gagal mengupload bukti');
        }
        else {
            if ($this->M_transaksi->update_bukti($this->upload->data('file_name'))) {
                $this->session->set_flashdata('pesan', 'Sukses mengupload bukti. Silakan menunggu konfirmasi dari admin!');
            }
            else {
                $this->session->set_flashdata('pesan', 'Terjadi kesalahan pada jaringan');
            }
        }
        redirect('Transaksi/daftartagihan');
    }

    public function verifikasi()
    {
        $data['konten'] = 'v_verifikasi';
        $data['active'] = 'Verifikasi';
        $data['judul'] = 'Verifikasi Pembayaran';
        $data['verifikasi'] = $this->M_transaksi->m_verifikasi_tampil();
        $data['hitung'] = $this->M_transaksi->m_verifikasi_hitung();
        $this->load->view('v_verifikasi', $data);
    }

    public function transaksi_verifikasi($id)
    {
        $id_admin = $this->session->userdata('id_admin');
        if ($this->input->post('yes')) {
            $this->M_transaksi->m_setujui_verifikasi_tagihan($id, $id_admin);
        }
        else {
            $this->M_transaksi->m_tolak_verifikasi_tagihan($id, $id_admin);
        }
        $this->session->set_flashdata('pesan', 'Sukses verifikasi. Silakan lihat histori transaksi!');
        redirect('Transaksi/verifikasi');
    }

    public function historitransaksi()
    {
        $data['konten'] = 'v_historitransaksi';
        $data['active'] = 'Histori';
        $data['judul'] = 'Histori Transaksi';
        $data['histori'] = $this->M_transaksi->m_historitransaksi_tampil();
        $data['count'] = $this->M_transaksi->m_historitransaksi_hitung();
        $this->load->view('v_historitransaksi', $data);
    }
}
