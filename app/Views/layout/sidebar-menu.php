<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->

    <li class="nav-item">
      <a href="<?= base_url('/') ?>" class="nav-link <?= $menu == 'beranda' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Beranda
        </p>
      </a>
    </li>

    <li class="nav-header">TRANSAKSI</li>
    <li class="nav-item">
      <a href="<?= base_url('/transaksi/pemesanan') ?>" class="nav-link <?= $menu == 'tr_pemesanan' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-file-invoice"></i>
        <p>
          Pemesanan Obat
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('/transaksi/penerimaan') ?>" class="nav-link <?= $menu == 'tr_penerimaan' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-arrow-circle-down"></i>
        <p>
          Penerimaan Obat
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('/transaksi/pengeluaran') ?>" class="nav-link <?= $menu == 'tr_pengeluaran' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-arrow-circle-up"></i>
        <p>
          Pengeluaran Obat
        </p>
      </a>
    </li>

    <li class="nav-header">PERSEDIAAN</li>
    <li class="nav-item menu-<?= $menu == 'persediaan' ? 'open' : 'close' ?>">
      <a href="#" class="nav-link <?= $menu == 'persediaan' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-boxes"></i>
        <p>
          Persediaan
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?= base_url('/persediaan') ?>" class="nav-link <?= $submenu == 'semua_persediaan' ? 'active' : '' ?>">
            <i class="far fa-circle nav-icon"></i>
            <!-- <i class="fas fa-circle nav-icon"></i> -->
            <p>Semua Persediaan Obat</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('/persediaan/gudang') ?>" class="nav-link <?= $submenu == 'persediaan_gudang' ? 'active' : '' ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Persediaan Obat Gudang</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('/persediaan/apotek') ?>" class="nav-link  <?= $submenu == 'persediaan_apotek' ? 'active' : '' ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Persediaan Obat Apotek</p>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-header">DATA TRANSAKSI</li>
    <li class="nav-item menu-<?= $menu == 'data_transaksi' ? 'open' : 'close' ?>">
      <a href="#" class="nav-link <?= $menu == 'data_transaksi' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-book"></i>
        <p>
          Data Transaksi
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?= base_url('/pemesanan') ?>" class="nav-link <?= $submenu == 'dt_pemesanan' ? 'active' : '' ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Pemesanan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('/penerimaan') ?>" class="nav-link <?= $submenu == 'dt_penerimaan' ? 'active' : '' ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Penerimaan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('/pengeluaran') ?>" class="nav-link <?= $submenu == 'dt_pengeluaran' ? 'active' : '' ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Pengeluaran</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('/perubahan') ?>" class="nav-link <?= $submenu == 'dt_perubahan' ? 'active' : '' ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Perubahan Lokasi</p>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-header">DATA MASTER</li>
    <li class="nav-item">
      <a href="<?= base_url('/obat') ?>" class="nav-link <?= $menu == 'obat' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-pills"></i>
        <p>
          Data Obat
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('/obat/tambah') ?>" class="nav-link <?= $menu == 'tambah_obat' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-first-aid"></i>
        <p>
          Tambah Obat
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('/obat/jenisdansatuan') ?>" class="nav-link <?= $menu == 'jenis' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>
          Jenis & Satuan Obat
        </p>
      </a>
    </li>
    
    <?php if (in_groups('admin')) : ?>
    <li class="nav-item">
      <a href="<?= base_url('/ketenagaan') ?>" class="nav-link <?= $menu == 'ketenagaan' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>
          Ketenagaan
        </p>
      </a>
    </li>

    
    <li class="nav-header">MANAJEMEN PENGGUNA</li>
    <li class="nav-item">
      <a href="<?= base_url('/pengguna') ?>" class="nav-link <?= $menu == 'pengguna' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Data Pengguna
        </p>
      </a>
    </li>
    <?php endif; ?>
  </ul>
</nav>
