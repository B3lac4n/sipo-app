<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Pemesanan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Data Pemesanan</li>
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
            <h5 class="m-0 card-title">Data Pemesanan</h5>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <!-- <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#cetak-laporan">
                    <i class="fas fa-print"></i> Cetak Laporan
                  </button> -->

                  <a
                    class="btn btn-sm btn-outline-primary"
                    href="<?= base_url('/transaksi/pemesanan') ?>"
                    >Buat Pemesanan</a
                  >
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <table id="pemesanan" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Pemesanan</th>
                  <th>Tanggal Pemesanan</th>
                  <th>Jumlah Kunjungan (Umum)</th>
                  <th>Jumlah Kunjungan (BPJS/JKN)</th>
                  <th>Jumlah Kunjungan (JAMKESDA)</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($pemesanan as $key => $value) : ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $value['kd_pemesanan'] ?></td>
                    <td><?= $value['tgl_dokumen'] ?></td>
                    <td align="right"><?= $value['umum'] ?></td>
                    <td align="right"><?= $value['bpjs'] ?></td>
                    <td align="right"><?= $value['jamkesda'] ?></td>
                    <td><?= $value['keterangan'] ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Kode Pemesanan</th>
                  <th>Tanggal Pemesanan</th>
                  <th>Jumlah Kunjungan (Umum)</th>
                  <th>Jumlah Kunjungan (BPJS/JKN)</th>
                  <th>Jumlah Kunjungan (JAMKESDA)</th>
                  <th>Keterangan</th>
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

<!-- Modal Cetak Laporan -->
<div class="modal fade" id="cetak-laporan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pilih Pemesanan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('/transaksi/pemesanan/laporan') ?>" method="post">
        <?= csrf_field(); ?>
        <div class="modal-body">
          <?php if (session()->getFlashdata('empty')): ?>
              <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('empty'); ?>
              </div>
          <?php endif; ?>

          <div class="form-group">
            <label for="kode">Kode Pemesanan</label>
            <select class="form-control form-control-sm select2-kode" style="width: 100%;" name="kode" id="kode">
              <option value="">Pilih Kode Pemesanan</option>
              <?php foreach ($pemesanan as $data) : ?>
                <option value="<?= $data['id'] ?>"><?= $data['kd_pemesanan'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Cetak</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2-kode').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $("#pemesanan").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
    });
  })
</script>
<?= $this->endSection() ?>