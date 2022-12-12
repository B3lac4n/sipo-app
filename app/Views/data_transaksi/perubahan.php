<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Perubahan Lokasi</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Data Perubahan Lokasi</li>
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
            <h5 class="m-0 card-title">Data Perubahan Lokasi Obat</h5>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#cetak-laporan">
                    <i class="fas fa-print"></i> Cetak Laporan
                  </button>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <table id="perubahan" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Perubahan</th>
                  <th>Tanggal</th>
                  <th>Lokasi Tujuan</th>
                  <th>Jumlah</th>
                  <th>Obat</th>
                  <th>Nomor Batch</th>
                  <th>Expired</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($perubahan as $key => $value) : ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $value['kd_perubahan'] ?></td>
                    <td><?= $value['tgl_perubahan'] ?></td>
                    <td><?= $value['lokasi'] ?></td>
                    <td align="right"><?= $value['qty'] ?></td>
                    <td><?= $value['nama'] ?></td>
                    <td><?= $value['no_batch'] ?></td>
                    <td><?= $value['expired'] ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Kode Perubahan</th>
                  <th>Tanggal</th>
                  <th>Lokasi Tujuan</th>
                  <th>Jumlah</th>
                  <th>Obat</th>
                  <th>Nomor Batch</th>
                  <th>Expired</th>
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
        <h4 class="modal-title">Pilih Tanggal Perubahan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('/transaksi/perubahan/laporan') ?>" method="post">
        <?= csrf_field(); ?>
        <div class="modal-body">
          <?php if (session()->getFlashdata('empty')): ?>
              <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('empty'); ?>
              </div>
          <?php endif; ?>

          <div class="form-group">
            <label for="tgl_perubahan">Tanggal Perubahan</label>
            <div class="input-group date" id="tgl_perubahan" data-target-input="nearest">
                <input type="text" class="form-control form-control-sm datetimepicker-input" name="tgl_perubahan" data-target="#tgl_perubahan" require/>
                <div class="input-group-append" data-target="#tgl_perubahan" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
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
  <?php if (session()->getFlashdata('empty')): ?>
    $('#cetak-laporan').modal('toggle');
  <?php endif; ?>

  $(function () {
    $("#perubahan").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": true,
    });
  })

  $('#tgl_perubahan').datetimepicker({
      format: 'YYYY-MM-DD',
      locale: 'id'
  });
</script>
<?= $this->endSection() ?>