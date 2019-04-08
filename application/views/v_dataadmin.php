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
						<button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#tambahadmin" data-whatever="@mdo">Tambah</button>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Nama Admin</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Aksi</th>
									</tr>
								</thead>
                <tbody>
                  <?php
                  if ($count > 0) {
                    foreach ($admin as $a):
                  ?>
                  <tr>
                    <td><?=$a->nama_admin;?></td>
                    <td><?=$a->username;?></td>
                    <td><?=$a->nama_level;?></td>
                    <td>
											<a onclick="Edit(<?=$a->id_admin;?>);" style="color: white">
                        <button type="button" name="button" class="btn btn-primary btn-rounded btn-sm" aria-haspopup="true" aria-expanded="true" title="Edit Admin">
                    				<i class="fa fa-edit"></i>
                    		</button>
											</a>
											<a href="<?=base_url()?>Admin/admin_hapus/<?=$a->id_admin?>" style="color: white" onclick="return confirm('Apakah yakin?')">
	                    <button type="button" name="button" class="btn btn-danger btn-rounded btn-sm" title="Hapus Admin">
	                    		<i class="fa fa-trash"></i>
	                    </button>
											</a>
                    </td>
                  </tr>
                  <?php endforeach;}
                    else {
                  ?>
                  <td colspan="4"><center>Data tidak ditemukan.</center></td>
                  <?php }
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

<!-- Modal Tambah Admin -->
<div class="modal fade" id="tambahadmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
  <div class="modal-dialog" role="document">
    <form class="form-horizontal" action="<?=base_url('Admin/admin_tambah')?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputuname_3" class="col-sm-5 control-label">Nama Admin</label>
            <div class="col-sm-12">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Nama Admin" name="nama_admin" autocomplete="off" required="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputpwd_32" class="col-sm-3 control-label">Username</label>
            <div class="col-sm-12">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off" required="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputpwd_32" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-12">
              <div class="input-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required="">
              </div>
            </div>
          </div>
                  <div class="form-group">
            <label for="exampleInputpwd_32" class="col-sm-3 control-label">Level</label>
            <div class="col-sm-12">
              <div class="input-group">
                <select class="selectpicker form-control" data-style="form-control btn-default" name="id_level" required="">
                  <option>--Pilih--</option>
                              <?php foreach ($level as $l): ?>
                  <option value="<?=$l->id_level;?>"><?=$l->nama_level;?></option>
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

<!-- Modal Edit Admin -->
<div class="modal fade" id="editadmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
  <div class="modal-dialog" role="document">
    <form class="form-horizontal" action="<?=base_url('Admin/admin_ubah')?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
         <h5 class="modal-title">Edit Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputuname_3" class="col-sm-5 control-label">Nama Admin</label>
            <div class="col-sm-12">
              <div class="input-group">
                <input type="hidden" name="id_admin" id="id_admin">
                <input type="text" class="form-control" placeholder="Nama Admin" name="nama_admin" id="nama_admin" autocomplete="off" required="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputpwd_32" class="col-sm-3 control-label">Username</label>
            <div class="col-sm-12">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Username" name="username" id="username" autocomplete="off" required="">
              </div>
            </div>
          </div>
                    <div class="form-group">
            <label for="exampleInputpwd_32" class="col-sm-3 control-label">Level</label>
            <div class="col-sm-12">
              <div class="input-group">
                <select class="selectpicker form-control" data-style="form-control btn-default" name="id_level" id="id_level" required="">
                  <option>--Pilih--</option>
                                <?php foreach ($level as $l): ?>
                  <option value="<?=$l->id_level;?>"><?=$l->nama_level;?></option>
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
        $('#editadmin').modal('show');
        $.ajax({
            type  : 'GET',
            url   : '<?=base_url('Admin/get_admin_id/')?>'+id,
            dataType : 'json',
            success : function(data){
                $('#nama_level').val(data.nama_level).change();
                $('#id_admin').val(data.id_admin);
                $('#nama_admin').val(data.nama_admin);
                $('#username').val(data.username);
                $('#id_level').val(data.id_level);
            }
        });
    }
</script>
