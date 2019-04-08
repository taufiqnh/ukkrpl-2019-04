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
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
                  <tr>
                  <th>Periode</th>
                                                            <th>Meter Awal</th>
                                                            <th>Meter Akhir</th>
                                                            <th>Total Penggunaan</th>
															<th>Status</th>
                  </tr>
                  </thead>
                    								<tbody>
                                                    <?php
                                                    if ($count > 0) {
                                                        foreach ($detail as $d):
                                                    ?>
                                                        <tr>
                                                            <td><?=$d->bulan;?>  <?=$d->tahun;?></td>
                                                            <td><?=$d->meter_awal;?></td>
                                                            <td><?=$d->meter_akhir;?></td>
                                                            <td><?=$d->meter_akhir - $d->meter_awal?></td>
														<?php if ($d->status == 0) { ?>
															<td>Belum Bayar</td>
														<?php } else if ($d->status == 1) { ?>
															<td>Pending</td>
                                                        <?php } else if ($d->status == 2) { ?>
                                                            <td>Ditolak</td>
                                                        <?php } else { ?>
                                                            <td>Lunas</td>
														<?php } ?>
                                                        </tr>
                                                    <?php
                                                        endforeach;
                                                    }
                                                    else {
                                                    ?>
                                                            <td colspan="5"><center>Data tidak ditemukan.</center></td>
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