<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model{
    public function m_admin_login()
    {
        $username    = $this->input->post('username');
        $password    = md5($this->input->post('password'));
        return $this->db->query("SELECT * FROM admin WHERE username='$username' AND password='$password'");
    }

    public function m_admin_tampil()
    {
        return $this->db->query("SELECT * FROM admin INNER JOIN level ON admin.id_level=level.id_level ORDER BY nama_admin ASC")->result();
    }

    public function m_admin_hitung()
    {
        return $this->db->query("SELECT * FROM admin")->num_rows();
    }

    public function level_tampil()
    {
        return $this->db->query("SELECT * FROM level")->result();
    }

    public function m_admin_tambah()
    {
        $nama_admin     = $this->input->post('nama_admin');
        $username       = $this->input->post('username');
        $password       = md5($this->input->post('password'));
        $id_level       = $this->input->post('id_level');

        $this->db->query("INSERT INTO admin VALUES('', '$username', '$password', '$nama_admin', '$id_level')");
        if ($this->db->affected_rows()>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function get_dataadmin_id($id)
    {
        return $this->db->query("SELECT * FROM admin WHERE id_admin='$id'")->row();
    }

    public function m_admin_ubah($id, $nama_admin, $username, $id_level)
    {
        return $this->db->query("UPDATE admin SET nama_admin='$nama_admin', username='$username', id_level='$id_level' WHERE id_admin='$id'");
    }

    public function m_admin_hapus($id)
    {
        return $this->db->query("DELETE FROM admin WHERE id_admin='$id'");
    }
    public function keamanan(){
        $username = $this->session->userdata('username');
        if(empty($username)){
            $this->session->sess_destroy();
            redirect('Admin');
        }
    }
}
