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
			<div class="container-fluid">

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#tambahtarif" data-whatever="@mdo">Tambah</button>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
                  <tr>
                  <th>Nomor Meter</th>
                  <th>Nama Pelanggan</th>
                  <th>Tanggal Bayar</th>
                  <th>Bulan Bayar</th>
                  <th>Biaya Admin</th>
                  <th>Total Bayar</th>
                  <th>Status</th>
                  <th>Bukti</th>
                  <th>Verifikasi Admin</th>
                  </tr>
                  </thead>
                    								<tbody>
                                                    <?php
                                                    if ($count > 0) {
                                                        foreach ($histori as $h):
                                                    ?>
                                                        <tr>
                                                            <td><?=$h->nomor_kwh;?></td>
                                                            <td><?=$h->nama_pelanggan;?></td>
                                                            <td><?=$h->tanggal_pembayaran;?></td>
                                                            <td><?=$h->bulan_bayar;?></td>
                                                            <td>Rp <?=number_format($h->biaya_admin)?></td>
                                                            <td>Rp <?=number_format($h->total_bayar)?></td>
														<?php if ($h->status == 0) { ?>
															<td>Belum Bayar</td>
														<?php } else if ($h->status == 1) { ?>
															<td>Pending</td>
                                                        <?php } else if ($h->status == 2) { ?>
                                                            <td>Ditolak</td>
                                                        <?php } else { ?>
                                                            <td>Lunas</td>
														<?php } ?>
                                                            <td><img src="<?=base_url()?>assets/bukti/<?=$h->bukti;?>" style="max-width:80px;max-height:80px;"></td>
                                                            <td><?=$h->nama_admin;?></td>
                                                        </tr>
                                                    <?php
                                                        endforeach;
                                                    }
                                                    else {
                                                    ?>
                                                            <td colspan="9"><center>Data tidak ditemukan.</center></td>
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
