<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("pelanggan//navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("pelanggan/sidebar.php") ?>

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
                  <th>ID Tagihan</th>
                  <th>Periode</th>
                  <th>Grandtotal</th>
									<th>Status</th>
                  <th>Aksi</th>
                  </tr>
                  </thead>
                    								<tbody>
                                                    <?php
                                                    if ($count > 0) {
                                                        foreach ($detail as $d):
                                                    ?>
                                                        <tr>
                                                            <td><?=$d->id_tagihan;?></td>
                                                            <td><?=$d->bulan;?>  <?=$d->tahun;?></td>
                                                            <td>Rp <?=number_format($d->tarifperkwh*$d->jumlah_meter);?></td>
														<?php if ($d->status == 0) { ?>
															<td>Belum Bayar</td>
															<td>
																<a data-toggle="modal" data-target="#uploadbukti<?= $d->id_tagihan;?>" style="color: white">
																	<button type="button" name="button" class="btn btn-info btn-rounded btn-sm" aria-haspopup="true" aria-expanded="true" title="Upload Bukti">
																		<i class="fa fa-upload"></i>
																	</button>
																</a>
															</td>
														<?php } else if ($d->status == 1) { ?>
															<td>Pending</td>
															<td>
																<button type="button" name="button" class="btn btn-primary btn-rounded btn-sm" aria-haspopup="true" aria-expanded="true" title="Upload Bukti">
																	<i class="fa fa-upload"></i>
																</button>
															</td>
                                                        <?php } else if ($d->status == 2) { ?>
                                                            <td>Ditolak</td>
															<td>
																<a data-toggle="modal" data-target="#uploadbukti<?= $d->id_tagihan;?>" style="color: white">
																	<button type="button" name="button" class="btn btn-info btn-rounded btn-sm" aria-haspopup="true" aria-expanded="true" title="Upload Bukti">
																		<i class="fa fa-upload"></i>
																	</button>
																</a>
															</td>
                                                        <?php } else { ?>
                                                            <td>Lunas</td>
															<td>LUNAS</td>
														<?php } ?>
                                                        </tr>
                                                    <?php
                                                        endforeach;
                                                    }
                                                    else {
                                                    ?>
                                                            <td colspan="6"><center>Data tidak ditemukan.</center></td>
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

<!-- Upload Bukti -->
<?php foreach ($detail as $d) { ?>
<div class="modal fade" id="uploadbukti<?=$d->id_tagihan;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
	<div class="modal-dialog" role="document">
		<form class="form-horizontal" action="<?=base_url()?>Transaksi/upload_bukti/<?=$d->id_tagihan?>" method="post" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
          <h5 class="modal-title">Upload Bukti</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
				</div>
				<div class="modal-body">
                    <input type="hidden" name="bulan_bayar" value="<?=$d->bulan;?>  <?=$d->tahun;?>">
                    <input type="hidden" name="grandtotal" value="<?=$d->tarifperkwh*$d->jumlah_meter?>">
                    <input type="hidden" name="id_tagihan" value="<?=$d->id_tagihan;?>">
                    <input type="file" name="bukti" class="form_control">
				</div>
				<div class="modal-footer">
					<div class="form-group mb-0">
						<div class="col-sm-offset-3 col-sm-9">
							<input type="submit" class="btn btn-info btn-rounded" value="Upload" name="submit">
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<?php } ?>
