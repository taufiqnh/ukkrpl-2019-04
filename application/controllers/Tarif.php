<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarif extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_tarif');
    }

    public function datatarif()
    {
        $data['konten'] = 'v_tarif';
        $data['active'] = 'Tarif';
        $data['judul'] = 'Data Tarif';
        $data['tarif'] = $this->M_tarif->m_tarif_tampil();
        $data['count'] = $this->M_tarif->m_tarif_hitung();
        $this->load->view('v_datatarif', $data);
    }

    public function tarif_tambah()
    {
        $this->form_validation->set_rules('tarifperkwh', 'Tarif per kwh', 'trim|required', array('required' => 'Tarif per kwh harus diisi!'));
        $this->form_validation->set_rules('daya', 'Daya', 'trim|required', array('required' => 'Daya harus diisi!'));
        if ($this->form_validation->run() == true) {
            if ($this->input->post('tambah')) {
                if ($this->M_tarif->m_tarif_tambah() == TRUE) {
                    $this->session->set_flashdata('pesan', 'Sukses menambah tarif');
                }
                else {
                    $this->session->set_flashdata('pesan', 'Gagal menambah tarif');
                }
            }
            else {
                $this->session->set_flashdata('pesan', 'Terjadi kesalahan pada form');
            }
            redirect('Tarif/datatarif');
        }
        else {
            $this->session->set_flashdata('pesan', validation_errors());
            redirect('Tarif/datatarif');
        }
    }

    public function get_tarif_id($id)
    {
        $data = $this->M_tarif->get_datatarif_id($id);
        echo (json_encode($data));
    }

    public function tarif_ubah()
    {
        $this->form_validation->set_rules('tarifperkwh', 'Tarif per kwh', 'trim|required', array('required' => 'Tarif per kwh harus diisi!'));
        $this->form_validation->set_rules('daya', 'Daya', 'trim|required', array('required' => 'Daya harus diisi!'));
        if ($this->form_validation->run() == true) {
            $id             = $this->input->post('id_tarif');
            $daya           = $this->input->post('daya');
            $tarifperkwh    = $this->input->post('tarifperkwh');

            $this->session->set_flashdata('pesan', 'Sukses mengubah tarif');
            $this->M_tarif->m_tarif_ubah($id, $daya, $tarifperkwh);
        }
        else {
            $this->session->set_flashdata('pesan', 'Gagal mengubah tarif');
        }
        redirect('Tarif/datatarif');
    }

    public function tarif_hapus($id='')
    {
        $hapus = $this->M_tarif->m_tarif_hapus($id);
        if ($hapus == true) {
            $this->session->set_flashdata('pesan', 'Sukses menghapus tarif');
        }
        else {
            $this->session->set_flashdata('pesan', 'Gagal menghapus tarif');
        }
        redirect('Tarif/datatarif');
    }
}