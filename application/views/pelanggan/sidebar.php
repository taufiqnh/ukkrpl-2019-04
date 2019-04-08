<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="<?=base_url('Transaksi/daftartagihan'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Daftar Tagihan</span>
        </a>
    </li>
</ul>
