<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/_partials/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/_partials/sidebar.php") ?>

		<div id="content-wrapper">
    <?php if ($this->session->flashdata('pesan') != null): ?>
	      <div class="alert alert-warning"><?= $this->session->flashdata('pesan');?></div>
    <?php endif ?>
			<div class="container-fluid">

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
                  <tr>
                  <th>Nomor Meter</th>
                  <th>Nama Pelanggan</th>
                  <th>Tanggal Bayar</th>
                  <th>Bulan Bayar</th>
                  <th>Total Bayar</th>
                  <th>Bukti</th>
                  <th>Aksi</th>
                  </tr>
                  </thead>
                    								<tbody>
                                                    <?php
                                                    if ($hitung > 0) {
                                                        foreach ($verifikasi as $h):
                                                    ?>
                                                        <tr>
                                                            <td><?=$h->nomor_kwh;?></td>
                                                            <td><?=$h->nama_pelanggan;?></td>
                                                            <td><?=$h->tanggal_pembayaran;?></td>
                                                            <td><?=$h->bulan_bayar;?></td>
                                                            <td>Rp <?=number_format($h->total_bayar)?></td>
                                                            <td> <img src="<?=base_url()?>assets/bukti/<?=$h->bukti;?>" style="max-width:80px;max-height:80px;"></td>
                                                            <td>
                                                                <form class="form-horizontal" action="<?=base_url()?>Transaksi/transaksi_verifikasi/<?=$h->id_tagihan;?>" method="post">
                                                                    <input type="submit" name="yes" value="+" class="btn btn-primary btn-sm btn-rounded" title="Setujui">
                                                                    <input type="submit" name="no" value="x" class="btn btn-danger btn-sm btn-rounded" title="Tolak">
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        endforeach;
                                                    }
                                                    else {
                                                    ?>
                                                            <td colspan="7"><center>Data tidak ditemukan.</center></td>
                                                    <?php
                                                    }
                                                    ?>
                    								</tbody>
                    							</table>
						</div>
					</div>
				</div>

			</div>
			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
	<?php $this->load->view("admin/_partials/footer.php") ?>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("admin/_partials/scrolltop.php") ?>
	<?php $this->load->view("admin/_partials/modal.php") ?>
	<?php $this->load->view("admin/_partials/js.php") ?>
	
</body>

</html>