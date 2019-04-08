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
                  <th>Nama Pelanggan</th>
                  <th>Nomor Meter</th>
                  <th>Daya</th>
                  <th>Aksi</th>
                  </tr>
                  </thead>
                    								<tbody>
                                                    <?php
                                                    if ($count > 0) {
                                                        foreach ($pelanggan as $p):
                                                    ?>
                                                        <tr>
                                                            <td><?=$p->nama_pelanggan;?></td>
                                                            <td><?=$p->nomor_kwh;?></td>
                                                            <td><?=$p->daya;?> Watt</td>
                                                            <td>
                                                                <a data-toggle="modal" data-target="#tambahpenggunaan<?= $p->id_pelanggan;?>" style="color: white">
                                                                	<button type="button" name="button" class="btn btn-info btn-rounded btn-sm" aria-haspopup="true" aria-expanded="true" title="Tambah Penggunaan">
                    													<i class="fa fa-plus"></i>
                    												</button>
																</a>
																<a href="<?=base_url()?>Transaksi/transaksidetail/<?=$p->id_pelanggan?>" style="color: white">
                                                                	<button type="button" name="button" class="btn btn-primary btn-rounded btn-sm" aria-haspopup="true" aria-expanded="true" title="Detail Transaksi">
                    													<i class="fa fa-info"></i>
                    												</button>
																</a>
                    										</td>
                                                        </tr>
                                                    <?php
                                                        endforeach;
                                                    }
                                                    else {
                                                    ?>
                                                            <td colspan="4"><center>Data tidak ditemukan.</center></td>
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

<!-- Tambah Penggunaan -->
<?php foreach ($pelanggan as $p) { ?>
<div class="modal fade" id="tambahpenggunaan<?= $p->id_pelanggan;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
	<div class="modal-dialog" role="document">
		<form class="form-horizontal" action="<?=base_url('Transaksi/penggunaan_tambah')?>" method="post">
			<div class="modal-content">
				<div class="modal-header">
          <h5 class="modal-title">Tambah Penggunaan <?=$p->nama_pelanggan;?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
				</div>
				<input type="hidden" class="form-control" value="<?=$p->id_pelanggan;?>" name="id_pelanggan">
				<div class="modal-body">
	                <div class="form-group">
						<label for="exampleInputpwd_32" class="col-sm-3 control-label">Bulan</label>
						<div class="col-sm-12">
							<div class="input-group">
								<div class="input-group-addon"><i class=" icon-clock"></i></div>
								<select class="selectpicker form-control" data-style="form-control btn-default" name="bulan" required="">
									<option>--Pilih--</option>
									<option value="Januari">Januari</option>
									<option value="Februari">Februari</option>
									<option value="Maret">Maret</option>
									<option value="April">April</option>
									<option value="Mei">Mei</option>
									<option value="Juni">Juni</option>
									<option value="Juli">Juli</option>
									<option value="Agustus">Agustus</option>
									<option value="September">September</option>
									<option value="Oktober">Oktober</option>
									<option value="November">November</option>
									<option value="Desember">Desember</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputpwd_32" class="col-sm-3 control-label">Tahun</label>
						<div class="col-sm-12">
							<div class="input-group">
								<div class="input-group-addon"><i class="icon-clock"></i></div>
								<select class="selectpicker form-control" data-style="form-control btn-default" name="tahun" required="">
									<option>--Pilih--</option>
								<?php for ($i=2025; $i > 2000 ; $i--) { ?>
									<option value="<?=$i?>"><?=$i?></option>
								<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputpwd_32" class="col-sm-3 control-label">Meter Awal</label>
						<div class="col-sm-12">
							<div class="input-group">
								<div class="input-group-addon"><i class="icon-doc"></i></div>
								<input type="number" class="form-control" placeholder="Meter Awal" name="meter_awal" autocomplete="off" required="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputpwd_32" class="col-sm-3 control-label">Meter Akhir</label>
						<div class="col-sm-12">
							<div class="input-group">
								<div class="input-group-addon"><i class="icon-doc"></i></div>
								<input type="number" class="form-control" placeholder="Meter Akhir" name="meter_akhir" autocomplete="off" required="">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group mb-0">
						<div class="col-sm-offset-3 col-sm-12">
							<input type="submit" class="btn btn-info btn-rounded" value="Tambah" name="submit">
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<?php } ?>
