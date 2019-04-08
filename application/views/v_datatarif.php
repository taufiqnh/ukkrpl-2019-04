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
						<button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#tambahtarif" data-whatever="@mdo">Tambah</button>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
                  <tr>
                    <th>Daya</th>
                    <th>Tarif/Kwh</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                if ($count > 0) {
                    foreach ($tarif as $t):
                ?>
                    <tr>
                                                            <td><?=$t->daya;?> Watt</td>
                                                            <td>Rp <?=number_format($t->tarifperkwh);?></td>
                                                            <td>
                                <a onclick="Edit(<?=$t->id_tarif;?>);" style="color: white">
                                                                  <button type="button" name="button" class="btn btn-primary btn-rounded btn-sm" aria-haspopup="true" aria-expanded="true" title="Edit Tarif">
                                              <i class="fa fa-edit"></i>
                                            </button>
                                </a>
                                <a href="<?=base_url()?>Tarif/tarif_hapus/<?=$t->id_tarif?>" style="color: white" onclick="return confirm('Apakah yakin?')">
                                            <button type="button" name="button" class="btn btn-danger btn-rounded btn-sm" title="Hapus Tarif">
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

<!-- Modal Tambah Tarif -->
<div class="modal fade" id="tambahtarif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
  <div class="modal-dialog" role="document">
    <form class="form-horizontal" action="<?=base_url('Tarif/tarif_tambah')?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Tambah Tarif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputpwd_32" class="col-sm-5 control-label">Daya (Watt)</label>
            <div class="col-sm-12">
              <div class="input-group">
                <div class="input-group-addon"><i class="icon-energy"></i></div>
                <input type="number" class="form-control" placeholder="Daya (Watt)" name="daya" autocomplete="off" required="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputpwd_32" class="col-sm-3 control-label">Tarif / Kwh</label>
            <div class="col-sm-12">
              <div class="input-group">
                <div class="input-group-addon"><i class="icon-wallet"></i></div>
                <input type="number" class="form-control" placeholder="Tarif / Kwh" name="tarifperkwh" required="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="form-group mb-0">
            <div class="col-sm-offset-3 col-sm-9">
              <input type="submit" class="btn btn-info btn-rounded" value="Tambah" name="tambah">
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit Tarif -->
<div class="modal fade" id="edittarif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
  <div class="modal-dialog" role="document">
    <form class="form-horizontal" action="<?=base_url('Tarif/tarif_ubah')?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Edit Tarif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputuname_3" class="col-sm-3 control-label">Daya</label>
            <div class="col-sm-12">
              <div class="input-group">
                <div class="input-group-addon"><i class="icon-energy"></i></div>
                <input type="hidden" name="id_tarif" id="id_tarif">
                <input type="number" class="form-control" placeholder="Daya" name="daya" id="daya" autocomplete="off" required="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputuname_3" class="col-sm-3 control-label">Tarif / Kwh</label>
            <div class="col-sm-12">
              <div class="input-group">
                <div class="input-group-addon"><i class="icon-wallet"></i></div>
                <input type="number" class="form-control" placeholder="Tarif / Kwh" name="tarifperkwh" id="tarifperkwh" autocomplete="off" required="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="form-group mb-0">
            <div class="col-sm-offset-3 col-sm-9">
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
        $('#edittarif').modal('show');
        $.ajax({
            type  : 'GET',
            url   : '<?=base_url('Tarif/get_tarif_id/')?>'+id,
            dataType : 'json',
            success : function(data){
                $('#id_tarif').val(data.id_tarif);
                $('#daya').val(data.daya);
                $('#tarifperkwh').val(data.tarifperkwh);
            }
        });
    }
</script>