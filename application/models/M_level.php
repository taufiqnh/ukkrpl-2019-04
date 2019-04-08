<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_level extends CI_Model{
    public function m_level_tampil()
    {
        return $this->db->query("SELECT * FROM level ORDER BY nama_level ASC")->result();
    }

    public function m_level_hitung()
    {
        return $this->db->query("SELECT * FROM level")->num_rows();
    }

    public function m_level_tambah()
    {
        $nama_level = $this->input->post('nama_level');

        $this->db->query("INSERT INTO level VALUES('', '$nama_level')");
        if ($this->db->affected_rows()>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function get_datalevel_id($id)
    {
        return $this->db->query("SELECT * FROM level WHERE id_level='$id'")->row();
    }

    public function m_level_ubah($id, $nama_level)
    {
        return $this->db->query("UPDATE level SET nama_level='$nama_level' WHERE id_level='$id'");
    }

    public function m_level_hapus($id)
    {
        return $this->db->query("DELETE FROM level WHERE id_level='$id'");
    }
}
