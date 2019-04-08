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

        <!-- 
        karena ini halaman overview (home), kita matikan partial breadcrumb.
        Jika anda ingin mengampilkan breadcrumb di halaman overview,
        silahkan hilangkan komentar (//) di tag PHP di bawah.
        -->
		<?php //$this->load->view("admin/_partials/breadcrumb.php") ?>

		<!-- Icon Cards-->
		<div class="row">
			<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-primary o-hidden h-100">
				<div class="card-body">
				<div class="card-body-icon">
					<i class="fas fa-fw fa-user"></i>
				</div>
				<div class="mr-5">Verifikasi Pembayaran</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="<?=base_url('Transaksi/verifikasi')?>">
				<span class="float-left">Lihat</span>
				<span class="float-right">
					<i class="fas fa-angle-right"></i>
				</span>
				</a>
			</div>
			</div>
			<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-warning o-hidden h-100">
				<div class="card-body">
				<div class="card-body-icon">
					<i class="fas fa-fw fa-list"></i>
				</div>
				<div class="mr-5">History Transaksi</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="<?=base_url('Transaksi/historitransaksi')?>">
				<span class="float-left">Lihat</span>
				<span class="float-right">
					<i class="fas fa-angle-right"></i>
				</span>
				</a>
			</div>
			</div>
			<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-success o-hidden h-100">
				<div class="card-body">
				<div class="card-body-icon">
					<i class="fas fa-fw fa-shopping-cart"></i>
				</div>
				<div class="mr-5">Penggunaan</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="<?=base_url('Transaksi/penggunaanpelanggan')?>">
				<span class="float-left">Lihat</span>
				<span class="float-right">
					<i class="fas fa-angle-right"></i>
				</span>
				</a>
			</div>
			</div>
			<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-danger o-hidden h-100">
				<div class="card-body">
				<div class="card-body-icon">
					<i class="fas fa-fw fa-life-ring"></i>
				</div>
				<div class="mr-5">Tagihan</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="#">
				<span class="float-left">Lihat</span>
				<span class="float-right">
					<i class="fas fa-angle-right"></i>
				</span>
				</a>
			</div>
			</div>
		</div>

		<!-- Area Chart Example-->
		<div class="card mb-3">
			<div class="card-header">
			<i class="fas fa-chart-area"></i>
			Data Pelanggan</div>
			<div class="card-body">
			<div class="table-wrap">
                            						<div class="table-responsive">
                            							<table class="table table-hover table-striped" id="datable_1">
                            								<thead>
                            									<tr>
                            										<th>Nama Pelanggan</th>
                                                                    <th>Nomor Meter</th>
                                                                    <th>Daya</th>
                            									</tr>
                            								</thead>
                            								<tbody>
                                                            <?php
                                                            if ($count > 0) {
                                                                foreach ($pelanggan as $p):
                                                            ?>
                                                                <tr>
                                                                    <td>
        																<a href="<?=base_url()?>Transaksi/transaksidetail/<?=$p->id_pelanggan?>" style="color:rgb(43, 151, 221)">
        																	<?=$p->nama_pelanggan;?>
        																</a>
        															</td>
                                                                    <td><?=$p->nomor_kwh;?></td>
                                                                    <td><?=$p->daya;?> Watt</td>
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
                                                <div class="pull-right">
                                                    <a href="<?=base_url('Pelanggan/datapelanggan')?>">
                                                        <button type="button" name="button" class="btn btn-info btn-rounded">Detail</button>
                                                    </a>
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
