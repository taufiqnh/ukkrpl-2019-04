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
					<div class="card-header">
						<button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#tambahpelanggan" data-whatever="@mdo">Tambah</button>
					</div>
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
																<a onclick="Edit(<?=$p->id_pelanggan;?>);" style="color: white">
                                                                	<button type="button" name="button" class="btn btn-primary btn-rounded btn-sm" aria-haspopup="true" aria-expanded="true" title="Edit Pelanggan">
                    													<i class="fa fa-edit"></i>
                    												</button>
																</a>
																<a href="<?=base_url()?>Pelanggan/pelanggan_hapus/<?=$p->id_pelanggan?>" style="color: white" onclick="return confirm('Apakah yakin?')">
	                    											<button type="button" name="button" class="btn btn-danger btn-rounded btn-sm" title="Hapus Pelanggan">
	                    												<i class="fa fa-trash"></i>
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

<!-- Modal Tambah Pelanggan -->
<div class="modal fade" id="tambahpelanggan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
  <div class="modal-dialog" role="document">
    <form class="form-horizontal" action="<?=base_url('Pelanggan/Pelanggan_tambah')?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Tambah Pelanggan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
					<div class="form-group">
						<label for="exampleInputuname_3" class="col-sm-5 control-label">Nama Pelanggan</label>
						<div class="col-sm-12">
							<div class="input-group">
								<div class="input-group-addon"><i class="icon-user"></i></div>
								<input type="text" class="form-control" placeholder="Nama Pelanggan" name="nama_pelanggan" autocomplete="off" required="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputpwd_32" class="col-sm-3 control-label">Username</label>
						<div class="col-sm-12">
							<div class="input-group">
								<div class="input-group-addon"><i class="icon-user"></i></div>
								<input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off" required="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputpwd_32" class="col-sm-3 control-label">Password</label>
						<div class="col-sm-12">
							<div class="input-group">
								<div class="input-group-addon"><i class="icon-lock"></i></div>
								<input type="password" class="form-control" placeholder="Password" name="password" required="">
							</div>
						</div>
					</div>
	                <div class="form-group">
						<label for="exampleInputpwd_32" class="col-sm-3 control-label">Alamat</label>
						<div class="col-sm-12">
							<div class="input-group">
								<div class="input-group-addon"><i class="icon-map"></i></div>
								<input type="text" class="form-control" placeholder="Alamat" name="alamat" autocomplete="off" required="">
							</div>
						</div>
					</div>
	                <div class="form-group">
						<label for="exampleInputpwd_32" class="col-sm-5 control-label">Nomor Meter</label>
						<div class="col-sm-12">
							<div class="input-group">
								<div class="input-group-addon"><i class="icon-doc"></i></div>
								<input type="text" class="form-control" placeholder="Nomor Meter" name="nomor_kwh" autocomplete="off" required="">
							</div>
						</div>
					</div>
	                <div class="form-group">
						<label for="exampleInputpwd_32" class="col-sm-3 control-label">Daya</label>
						<div class="col-sm-12">
							<div class="input-group">
								<div class="input-group-addon"><i class=" icon-bulb"></i></div>
								<select class="selectpicker form-control" data-style="form-control btn-default" name="id_tarif" required="">
									<option>--Pilih--</option>
	                            <?php foreach ($tarif as $t): ?>
									<option value="<?=$t->id_tarif;?>"><?=$t->daya;?> Watt</option>
	                            <?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group mb-0">
						<div class="col-sm-offset-3 col-sm-12">
							<input type="submit" class="btn btn-info btn-rounded" value="Tambah" name="tambah">
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- Modal Edit Pelanggan -->
<div class="modal fade" id="editpelanggan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
  <div class="modal-dialog" role="document">
    <form class="form-horizontal" action="<?=base_url('Pelanggan/Pelanggan_ubah')?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Edit Pelanggan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
					<div class="form-group">
						<label for="exampleInputuname_3" class="col-sm-5 control-label">Nama Pelanggan</label>
						<div class="col-sm-12">
							<div class="input-group">
								<div class="input-group-addon"><i class="icon-user"></i></div>
								<input type="hidden" name="id_pelanggan" id="id_pelanggan">
								<input type="text" class="form-control" placeholder="Nama Pelanggan" name="nama_pelanggan" id="nama_pelanggan" autocomplete="off" required="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputpwd_32" class="col-sm-3 control-label">Username</label>
						<div class="col-sm-12">
							<div class="input-group">
								<div class="input-group-addon"><i class="icon-user"></i></div>
								<input type="text" class="form-control" placeholder="Username" name="username" id="username" autocomplete="off" required="">
							</div>
						</div>
					</div>
                    <div class="form-group">
						<label for="exampleInputpwd_32" class="col-sm-3 control-label">Alamat</label>
						<div class="col-sm-12">
							<div class="input-group">
								<div class="input-group-addon"><i class="icon-map"></i></div>
								<input type="text" class="form-control" placeholder="Alamat" name="alamat" id="alamat" autocomplete="off" required="">
							</div>
						</div>
					</div>
                    <div class="form-group">
						<label for="exampleInputpwd_32" class="col-sm-5 control-label">Nomor Meter</label>
						<div class="col-sm-12">
							<div class="input-group">
								<div class="input-group-addon"><i class="icon-doc"></i></div>
								<input type="text" class="form-control" placeholder="Nomor Meter" name="nomor_kwh" id="nomor_kwh" autocomplete="off" required="">
							</div>
						</div>
					</div>
                    <div class="form-group">
						<label for="exampleInputpwd_32" class="col-sm-3 control-label">Daya</label>
						<div class="col-sm-12">
							<div class="input-group">
								<div class="input-group-addon"><i class=" icon-bulb"></i></div>
								<select class="selectpicker form-control" data-style="form-control btn-default" name="id_tarif" id="id_tarif" required="">
									<option>--Pilih--</option>
                                <?php foreach ($tarif as $t): ?>
									<option value="<?=$t->id_tarif;?>"><?=$t->daya;?> Watt</option>
                                <?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group mb-0">
						<div class="col-sm-offset-3 col-sm-12">
							<input type="submit" class="btn btn-primary btn-rounded" value="Ubah" name="ubah">
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>


<script>
    function Edit(id){
        $('#editpelanggan').modal('show');
        $.ajax({
            type  : 'GET',
            url   : '<?=base_url('Pelanggan/get_pelanggan_id/')?>'+id,
            dataType : 'json',
            success : function(data){
                $('#daya').val(data.daya).change();
				$('#id_pelanggan').val(data.id_pelanggan);
                $('#nama_pelanggan').val(data.nama_pelanggan);
                $('#username').val(data.username);
                $('#alamat').val(data.alamat);
				$('#nomor_kwh').val(data.nomor_kwh);
				$('#id_tarif').val(data.id_tarif);
            }
        });
    }
</script>
<script src="<?=base_url()?>asset/vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?=base_url()?>asset/dist/js/sweetalert-data.js"></script>