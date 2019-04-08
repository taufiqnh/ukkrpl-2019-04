<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model{
    public function m_hitung_total_transaksi()
    {
        return $this->db->query("SELECT SUM(total_bayar) as bayar FROM pembayaran WHERE status=3")->row();
    }

    public function m_cek_penggunaan()
    {
        $id_pelanggan = $this->input->post('id_pelanggan');
        $bulan        = $this->input->post('bulan');
        $tahun        = $this->input->post('tahun');

        return $this->db->query("SELECT * FROM penggunaan WHERE id_pelanggan='$id_pelanggan' AND bulan='$bulan' AND tahun='$tahun'")->row();
    }

    public function m_penggunaan_tambah()
    {
        $id_pelanggan = $this->input->post('id_pelanggan');
        $bulan        = $this->input->post('bulan');
        $tahun        = $this->input->post('tahun');
        $meter_awal   = $this->input->post('meter_awal');
        $meter_akhir  = $this->input->post('meter_akhir');

        $this->db->query("INSERT INTO penggunaan VALUES('', '$id_pelanggan', '$bulan', '$tahun', '$meter_awal', '$meter_akhir')");
        if ($this->db->affected_rows()>0) {
            $data = $this->db->query("SELECT * FROM penggunaan WHERE id_pelanggan='$id_pelanggan' ORDER BY id_penggunaan DESC LIMIT 1")->row();
            $jumlah_meter = $meter_akhir-$meter_awal;
            $id = $data->id_penggunaan;
            $this->db->query("INSERT INTO tagihan VALUES('', '$id', '$bulan', '$tahun', '$jumlah_meter', '0')");
        }
        if ($this->db->affected_rows()>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function m_penggunaan_detail($id)
    {
        return $this->db->query("SELECT * FROM penggunaan
                                INNER JOIN pelanggan ON penggunaan.id_pelanggan=pelanggan.id_pelanggan
                                INNER JOIN tagihan ON tagihan.id_penggunaan = penggunaan.id_penggunaan
                                INNER JOIN tarif ON pelanggan.id_tarif=tarif.id_tarif
                                WHERE penggunaan.id_pelanggan='$id' ORDER BY penggunaan.id_penggunaan DESC")->result();
    }

    public function m_penggunaan_detail_hitung($id)
    {
        return $this->db->query("SELECT * FROM penggunaan WHERE penggunaan.id_pelanggan='$id'")->num_rows();
    }

    public function update_bukti($filename)
    {
        $id_tagihan     = $this->input->post('id_tagihan');
        $tanggal        = date('Y-m-d');
        $bulan_bayar    = $this->input->post('bulan_bayar');
        $biaya_adm      = 2500;
        $total          = $this->input->post('grandtotal')+$biaya_adm;

        $cek = $this->db->query("SELECT * FROM tagihan WHERE status=2 AND id_tagihan='$id_tagihan'")->row();
        if ($cek == null) {
            $insert = $this->db->query("INSERT INTO pembayaran VALUES('', '$id_tagihan', '$tanggal', '$bulan_bayar', '$biaya_adm', '$total', '', '$filename', '1')");
            if ($insert) {
                return $this->db->query("UPDATE tagihan SET status=1 WHERE id_tagihan='$id_tagihan'");
            }
        }
        else {
            $update = $this->db->query("UPDATE pembayaran SET bukti='$filename', status=1 WHERE id_tagihan='$id_tagihan'");
            if ($update) {
                return $this->db->query("UPDATE tagihan SET status=1 WHERE id_tagihan='$id_tagihan'");
            }
        }
    }

    public function m_setujui_verifikasi_tagihan($id, $id_admin)
    {
        $this->db->query("UPDATE tagihan SET status=3 WHERE id_tagihan='$id'");
        $this->db->query("UPDATE pembayaran SET id_admin='$id_admin', status=3 WHERE id_tagihan='$id'");
    }

    public function m_tolak_verifikasi_tagihan($id, $id_admin)
    {
        $this->db->query("UPDATE tagihan SET status=2 WHERE id_tagihan='$id'");
        $this->db->query("UPDATE pembayaran SET id_admin='$id_admin', status=2 WHERE id_tagihan='$id'");
    }

    public function m_verifikasi_tampil()
    {
        return $this->db->query("SELECT * FROM pembayaran
                                INNER JOIN tagihan ON pembayaran.id_tagihan = tagihan.id_tagihan
                                INNER JOIN penggunaan ON tagihan.id_penggunaan = penggunaan.id_penggunaan
                                INNER JOIN pelanggan ON penggunaan.id_pelanggan = pelanggan.id_pelanggan
                                INNER JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif
                                WHERE pembayaran.status = '1'
                                ORDER BY pembayaran.id_pembayaran DESC")->result();
    }

    public function m_verifikasi_hitung()
    {
        return $this->db->query("SELECT * FROM pembayaran
                                INNER JOIN tagihan ON pembayaran.id_tagihan=tagihan.id_tagihan
                                WHERE pembayaran.status='1'")->num_rows();
    }

    public function m_historitransaksi_tampil()
    {
        return $this->db->query("SELECT * FROM pembayaran
                                LEFT JOIN tagihan ON tagihan.id_tagihan = pembayaran.id_tagihan
                                LEFT JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan
                                LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penggunaan.id_pelanggan
                                LEFT JOIN tarif ON tarif.id_tarif = pelanggan.id_tarif
                                LEFT JOIN admin ON admin.id_admin = pembayaran.id_admin
                                ORDER BY id_pembayaran DESC")->result();
    }

    public function m_historitransaksi_hitung()
    {
        return $this->db->query("SELECT * FROM pembayaran")->num_rows();
    }

    public function m_historitransaksi_tampil_limit()
    {
        return $this->db->query("SELECT * FROM pembayaran
                                LEFT JOIN tagihan ON tagihan.id_tagihan = pembayaran.id_tagihan
                                LEFT JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan
                                LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penggunaan.id_pelanggan
                                LEFT JOIN tarif ON tarif.id_tarif = pelanggan.id_tarif
                                LEFT JOIN admin ON admin.id_admin = pembayaran.id_admin
                                ORDER BY id_pembayaran DESC LIMIT 4")->result();
    }
}
