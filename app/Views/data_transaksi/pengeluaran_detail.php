<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Pengeluaran</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Data Pengeluaran</li>
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
      <div class="col-md-12">
        <div class="card card-outline card-success">
          <div class="card-header">
            <h5 class="m-0 card-title">Data Pengeluaran, Kode Pengeluaran: <?= $kd_pengeluaran ?></h5>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a
                    class="btn btn-sm btn-outline-primary"
                    href="<?= base_url('/transaksi/pengeluaran') ?>"
                    >Buat Pengeluaran</a
                  >
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <table id="pengeluaran" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Obat</th>
                  <th>Nama Obat</th>
                  <th>Satuan</th>
                  <th>QTY</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($pengeluaranDetail as $key => $value) : ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $value['kd_obat'] ?></td>
                    <td><?= $value['nama'] ?></td>
                    <td><?= $value['satuan'] ?></td>
                    <td><?= $value['qty_keluar'] ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Kode Obat</th>
                  <th>Nama Obat</th>
                  <th>Satuan</th>
                  <th>QTY</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  $(function () {
    $("#pengeluaran").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
    });
  })
</script>
<?= $this->endSection() ?>