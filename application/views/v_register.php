<?php
if ($this->session->userdata('login') == TRUE){
   redirect('dashboard');
}
?>
<title>Selamat Datang!</title>
<link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" id="bootstrap-css">
<link href="<?=base_url('assets/bootstrap/css/cssreg.css') ?>" rel="stylesheet" id="bootstrap-css">
<script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?=base_url('assets/bootstrap/js/jquery.min.js') ?>"></script>
<link rel="icon" type="image/png" href="<?=base_url()?>assets/logo.png">

<!------ Include the above in your HEAD tag ---------->

<div class="sidenav">
         <div class="login-main-text">
         </div>
      </div>
      <div class="main">
         <div class="col-md-5 col-sm-12">
            <div class="login-form">
               <form action="<?=base_url('Pelanggan/pelanggan_register')?>" method="post">
               <h1>Daftar akun</h1>
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputEmail_2">Nama Pelanggan</label>
													<input type="text" class="form-control" required="" name="nama_pelanggan" placeholder="Nama Pelanggan" autocomplete="off">
												</div>
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputEmail_2">Username</label>
													<input type="text" class="form-control" required="" name="username" placeholder="Username" autocomplete="off">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="exampleInputpwd_2">Password</label>
													<input type="password" class="form-control" required="" name="password" placeholder="Password" autocomplete="off">
												</div>
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputEmail_2">Nomor Meter</label>
													<input type="text" class="form-control" required="" name="nomor_kwh" placeholder="Nomor Meter" autocomplete="off">
												</div>
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputEmail_2">Alamat</label>
													<input type="text" class="form-control" required="" name="alamat" placeholder="Alamat" autocomplete="off">
												</div>
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputEmail_2">Daya</label>
													<select class="selectpicker form-control" data-style="form-control btn-default" name="id_tarif" required="">
														<option>--Pilih--</option>
													<?php foreach ($tarif as $t): ?>
														<option value="<?=$t->id_tarif;?>"><?=$t->daya;?> Watt</option>
													<?php endforeach; ?>
													</select>
												</div>
												<div class="form-group text-center">
													<input type="submit" name="submit" value="Daftar" class="btn btn-info btn-rounded">
                                       <a class="btn btn-secondary" href="<?=base_url('Pelanggan')?>">Login</a>
                                    </div>
											</form>
               <?php if ($this->session->flashdata('pesan') != null): ?>
				   <div class="alert alert-warning"><?= $this->session->flashdata('pesan');?></div>
				   <?php endif ?>
            </div>
         </div>
      </div>