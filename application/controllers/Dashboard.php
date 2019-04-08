<?php

class Dashboard extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
	}

	public function index()
	{
	$this->load->model('M_pelanggan');
	$this->M_pelanggan->keamanan();
	$data['pelanggan'] = $this->M_pelanggan->m_pelanggan_tampil();
        $data['count'] = $this->M_pelanggan->m_pelanggan_hitung();
	$this->load->view('admin/overview', $data);
	
	}
}