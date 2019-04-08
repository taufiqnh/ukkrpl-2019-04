<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_level');
    }

    public function datalevel()
    {
        $data['konten'] = 'v_level';
        $data['active'] = 'Level';
        $data['judul'] = 'Data Level';
        $data['level'] = $this->M_level->m_level_tampil();
        $data['count'] = $this->M_level->m_level_hitung();
        $this->load->view('v_datalevel', $data);
    }

    public function level_tambah()
    {
        $this->form_validation->set_rules('nama_level', 'Level', 'trim|required', array('required' => 'Level harus diisi!'));
        if ($this->form_validation->run() == true) {
            if ($this->input->post('tambah')) {
                if ($this->M_level->m_level_tambah() == TRUE) {
                    $this->session->set_flashdata('pesan', 'Sukses menambah level');
                }
                else {
                    $this->session->set_flashdata('pesan', 'Gagal menambah level');
                }
            }
            else {
                $this->session->set_flashdata('pesan', 'Terjadi kesalahan pada form');
            }
            redirect('Level/datalevel');
        }
        else {
            $this->session->set_flashdata('pesan', validation_errors());
            redirect('Level/datalevel');
        }
    }

    public function get_level_id($id)
    {
        $data = $this->M_level->get_datalevel_id($id);
        echo (json_encode($data));
    }

    public function level_ubah()
    {
        $this->form_validation->set_rules('nama_level', 'Level', 'trim|required', array('required' => 'Level harus diisi!'));
        if ($this->form_validation->run() == true) {
            $id_level   = $this->input->post('id_level');
            $nama_level = $this->input->post('nama_level');

            $this->session->set_flashdata('pesan', 'Sukses mengubah level');
            $this->M_level->m_level_ubah($id_level, $nama_level);
        }
        else {
            $this->session->set_flashdata('pesan', 'Gagal mengubah level');
        }
        redirect('Level/datalevel');
    }

    public function level_hapus($id='')
    {
        $hapus = $this->M_level->m_level_hapus($id);
        if ($hapus == true) {
            $this->session->set_flashdata('pesan', 'Sukses menghapus level');
        }
        else {
            $this->session->set_flashdata('pesan', 'Gagal menghapus level');
        }
        redirect('Level/datalevel');
    }
}
