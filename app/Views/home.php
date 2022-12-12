<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Beranda</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Beranda</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $count['pemesanan'] ?></h3>

            <p>Pemesanan Obat</p>
          </div>
          <div class="icon">
            <i class="fas fa-file-invoice"></i>
          </div>
          <a href="<?= base_url('/pemesanan') ?>" class="small-box-footer"
            >Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i
          ></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= $count['penerimaan'] ?></h3>

            <p>Penerimaan Obat</p>
          </div>
          <div class="icon">
            <i class="fas fa-arrow-circle-down"></i>
          </div>
          <a href="<?= base_url('/penerimaan') ?>" class="small-box-footer"
            >Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i
          ></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?= $count['pengeluaran'] ?></h3>

            <p>Pengeluaran Obat</p>
          </div>
          <div class="icon">
            <i class="fas fa-arrow-circle-up"></i>
          </div>
          <a href="<?= base_url('/pengeluaran') ?>" class="small-box-footer"
            >Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i
          ></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $count['perubahan'] ?></h3>

            <p>Perubahan Lokasi Obat</p>
          </div>
          <div class="icon">
            <i class="fas fa-arrows-alt"></i>
          </div>
          <a href="<?= base_url('/perubahan') ?>" class="small-box-footer"
            >Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i
          ></a>
        </div>
      </div>
      <!-- ./col -->
    </div>

    <div class="row">
      <div class="col-6">
        <div class="card card-outline card-warning">
          <div class="card-header">
            <h3 class="card-title">Daftar Obat Yang Akan Kadaluarsa</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Nama</th>
                  <th>Nomor Batch</th>
                  <th>Expire Date</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($persediaanExpired as $key => $value) : 
                  if ($value->selisih <= 30) :
                ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $value->nama ?></td>
                    <td><?= $value->no_batch ?></td>
                    <td>
                      ED <?= $value->expired ?> <br>
                      <?php if ($value->selisih == 0) : ?>
                        <span class="text-danger">KADALUARSA</span>
                      <?php else: ?>
                        <span class="text-danger">(<?= $value->selisih ?> hari lagi)</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php 
                    endif;
                  endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->
      </div>
    
      <div class="col-6">
        <div class="card card-outline card-warning">
          <div class="card-header">
            <h3 class="card-title">Daftar Obat Yang Akan Habis</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Kode Obat</th>
                  <th>Nama Obat</th>
                  <th>Stok</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($limitedStock as $key => $value) : ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $value->kd_obat ?></td>
                    <td><?= $value->nama ?></td>
                    <td><?= $value->total_qty ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->
      </div>
    </div>
  
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<?= $this->endSection() ?>