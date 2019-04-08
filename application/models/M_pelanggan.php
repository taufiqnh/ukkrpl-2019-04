<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelanggan extends CI_Model{
    public function m_pelanggan_login()
    {
        $username    = $this->input->post('username');
        $password    = md5($this->input->post('password'));
        return $this->db->query("SELECT * FROM pelanggan WHERE username='$username' AND password='$password'");
    }

    public function m_pelanggan_tampil()
    {
        return $this->db->query("SELECT * FROM pelanggan INNER JOIN tarif ON pelanggan.id_tarif=tarif.id_tarif ORDER BY nama_pelanggan ASC")->result();
    }

    public function m_pelanggan_hitung()
    {
        return $this->db->query("SELECT * FROM pelanggan")->num_rows();
    }

    public function m_pelanggan_tambah()
    {
        $nama_pelanggan = $this->input->post('nama_pelanggan');
        $username       = $this->input->post('username');
        $password       = md5($this->input->post('password'));
        $nomor_kwh      = $this->input->post('nomor_kwh');
        $alamat         = $this->input->post('alamat');
        $id_tarif       = $this->input->post('id_tarif');

        $this->db->query("INSERT INTO pelanggan VALUES('', '$username', '$password', '$nomor_kwh', '$nama_pelanggan', '$alamat', '$id_tarif')");
        if ($this->db->affected_rows()>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function get_datapelanggan_id($id)
    {
        return $this->db->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id'")->row();
    }

    public function m_pelanggan_ubah($id, $nama_pelanggan, $username, $nomor_kwh, $alamat, $id_tarif)
    {
        return $this->db->query("UPDATE pelanggan SET nama_pelanggan='$nama_pelanggan', username='$username', nomor_kwh='$nomor_kwh', alamat='$alamat', id_tarif='$id_tarif' WHERE id_pelanggan='$id'");
    }

    public function m_pelanggan_hapus($id)
    {
        return $this->db->query("DELETE FROM pelanggan WHERE id_pelanggan='$id'");
    }

    public function m_pelanggan_tampil_limit()
    {
        return $this->db->query("SELECT * FROM pelanggan INNER JOIN tarif ON pelanggan.id_tarif=tarif.id_tarif ORDER BY nama_pelanggan ASC LIMIT 4")->result();
    }
    public function keamanan(){
        $username = $this->session->userdata('username');
        if(empty($username)){
            $this->session->sess_destroy();
            redirect('Pelanggan');
        }
    }
}
