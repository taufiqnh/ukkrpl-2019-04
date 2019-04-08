<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="<?=base_url('Dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'products' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Transaksi</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?=base_url('Transaksi/penggunaanpelanggan')?>">Penggunaan</a>
            <a class="dropdown-item" href="<?=base_url('Transaksi/verifikasi')?>">Verivikasi Pembayaran</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?=base_url('Pelanggan/datapelanggan')?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Pelanggan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?=base_url('Admin/dataadmin')?>">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Admin</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?=base_url('Tarif/datatarif')?>">
            <i class="fas fa-fw fa-cloud"></i>
            <span>Data Tarif</span></a>
    </li>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?=base_url('Level/datalevel')?>">
            <i class="fas fa-fw fa-signal"></i>
            <span>Data Level</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?=base_url('Transaksi/historitransaksi')?>">
        <i class="fas fa-fw fa-history"></i>
        <span>History Transaksi</span></a>
    </li>
</ul>
